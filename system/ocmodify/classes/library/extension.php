<?php
final class OCMExtension extends OCMLibrary {
  public static $code = 'extension';

  public function status() {
    return true;
  }

  public function init() {
    // Initial code here
  }

  public function installMods($code, $refresh = true) {
    libxml_use_internal_errors(true);
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = true;

    foreach ($this->getMods($code) as $modification) {
      $dom->loadXml(file_get_contents($modification));

      foreach ($dom->getElementsByTagName('modification')->item(0)->getElementsByTagName('file') as $file) {
        foreach ($file->getElementsByTagName('operation') as $operation) {
          // Check operations compatibility
          if (($operation->hasAttribute('min') && version_compare(VERSION, $operation->getAttribute('min'), '<')) || ($operation->hasAttribute('max') && version_compare(VERSION, $operation->getAttribute('max'), '>='))) {
            $file->removeChild($operation);
            continue;
          }

          // Set error mode for ocmod/vqmod
          if (version_compare(VERSION, '2', '>=')) {
            $operation->removeAttribute('error');
          } else {
            $operation->setAttribute('error', 'log');
          }

          // Clean up
          $operation->removeAttribute('min');
          $operation->removeAttribute('max');
        }

        // Check files
        if (($file->getElementsByTagName('operation')->length == 0) || ($file->hasAttribute('min') && version_compare(VERSION, $file->getAttribute('min'), '<')) || ($file->hasAttribute('max') && version_compare(VERSION, $file->getAttribute('max'), '>='))) {
          $file->parentNode->removeChild($file);
          continue;
        }

        // Replace admin directory name
        if (version_compare(VERSION, '2', '>=')) {
          $file->setAttribute('path', preg_replace('#^(,|\|)?(admin/)#', '${1}' . OCM_ADMIN_FOLDER . '/', $file->getAttribute('path')));
        } else {
          if ($file->hasAttribute('path')) {
            $file->setAttribute('path', preg_replace('#^(,|\|)?(admin/)#', '${1}' . OCM_ADMIN_FOLDER . '/', $file->getAttribute('path')));
          }
          if ($file->hasAttribute('name')) {
            $file->setAttribute('name', preg_replace('#^(,|\|)?(admin/)#', '${1}' . OCM_ADMIN_FOLDER . '/', $file->getAttribute('name')));
          }
        }

        // Migrate file paths
        if (version_compare(VERSION, '2.1', '>=')) {
          if (preg_match('#\{|\}#', $file->getAttribute('path'))) {
            $file->setAttribute('path', str_replace('|', ',', $file->getAttribute('path')));
          } else {
            $file->setAttribute('path', str_replace(',', '|', $file->getAttribute('path')));
          }
        } elseif (version_compare(VERSION, '2', '>=')) {
          $file->setAttribute('path', str_replace('|', ',', $file->getAttribute('path')));
          if (preg_match('#\{|\}#', $file->getAttribute('path'))) {
            $paths = array();

            foreach ((array)glob(realpath(DIR_SYSTEM . '../') . '/' . $file->getAttribute('path'), GLOB_BRACE) as $path) {
              $paths[] = str_replace(realpath(DIR_SYSTEM . '../') . '/', '', $path);
            }

            $path = implode(',', $paths);
            if ($path) {
              $file->setAttribute('path', implode(',', $paths));
            } else {
              $file->parentNode->removeChild($file);
            }
          }
        } else {
          if (preg_match('#\{|\}#', $file->getAttribute('name'))) {
            $paths = array();

            foreach ((array)glob(realpath(DIR_SYSTEM . '../') . '/' . $file->getAttribute('name'), GLOB_BRACE) as $path) {
              $paths[] = str_replace(realpath(DIR_SYSTEM . '../') . '/', '', $path);
            }

            $path = implode(',', $paths);
            if ($path) {
              $file->setAttribute('path', implode(',', $paths));
            } else {
              $file->parentNode->removeChild($file);
            }
          }
        }

        // Clean up
        $file->removeAttribute('min');
        $file->removeAttribute('max');
      }

      if (version_compare(VERSION, '2.0.1', '>=')) {
        if (is_writable(OCM_DIR_XML)) {
          $dom->save(OCM_DIR_XML . basename($modification));
        } else {
          $this->message->add('error', sprintf($this->language->get('error_chmod_dir'), realpath(OCM_DIR_XML)));
        }
      } elseif (version_compare(VERSION, '2', '>=')) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "modification WHERE `name` = '" . $this->db->escape(basename($modification, '.ocmod.xml')) . "'");
        $this->db->query("INSERT INTO " . DB_PREFIX . "modification SET `name` = '" . $this->db->escape(basename($modification, '.ocmod.xml')) . "', `author` = '" . $this->db->escape($dom->getElementsByTagName('author')->item(0)->nodeValue) . "', `version` = '" . $this->db->escape($dom->getElementsByTagName('version')->item(0)->nodeValue) . "', `link` = '', `code` = '" . $this->db->escape(preg_replace('#&\$#', '&amp;$', $dom->saveHTML())) . "', `status` = '1', `date_added` = NOW()");
      } elseif (is_dir(OCM_DIR_XML)) {
        if (is_writable(OCM_DIR_XML)) {
          $dom->save(OCM_DIR_XML . basename($modification, '.vqmod.xml') . '.xml');
        } else {
          $this->message->add('error', sprintf($this->language->get('error_chmod_dir'), realpath(OCM_DIR_XML)));
        }
      }
    }

    if ($refresh) {
      ocmRefreshMods($this);
    }
  }

  public function getMods($code) {
    $files = array();

    if (is_dir(OCM_DIR . 'extension/')) {
      if (version_compare(VERSION, '2', '>=')) {
        $files = glob(OCM_DIR . 'extension/' . $code . '/*.ocmod.xml');
      } else {
        $files = glob(OCM_DIR . 'extension/' . $code . '/*.vqmod.xml');
      }
    }

    return $files;
  }

  public function uninstallMods($code, $refresh = true) {
    foreach ($this->getMods($code) as $file) {
      if (version_compare(VERSION, '2.0.1', '>=')) {
        if (is_file(OCM_DIR_XML . basename($file))) {
          unlink(OCM_DIR_XML . basename($file));
        }
      } elseif (version_compare(VERSION, '2', '>=')) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "modification WHERE `name` = '" . $this->db->escape(basename($file, '.ocmod.xml')) . "'");
      } else {
        if (is_file(OCM_DIR_XML . basename($file, '.vqmod.xml') . '.xml')) {
          unlink(OCM_DIR_XML . basename($file, '.vqmod.xml') . '.xml');
        }
      }
    }
    if ($refresh) {
      ocmRefreshMods($this);
    }
  }

  public function getInstalled($type, $check_files = true) {
    $extension_data = array();

    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "' ORDER BY code");

    foreach ($query->rows as $result) {
      $filename = DIR_APPLICATION . 'controller/' . ocmGetRoute('extension/payment/' . $result['code']) . '.php';
      if (is_file($filename) || !$check_files) {
        $extension_data[] = $result['code'];
      }
    }

    return $extension_data;
  }

  public function install($type, $code) {
    $this->uninstall($type, $code);
    $this->db->query("INSERT INTO " . DB_PREFIX . "extension SET `type` = '" . $this->db->escape($type) . "', `code` = '" . $this->db->escape($code) . "'");
  }

  public function uninstall($type, $code) {
    $this->db->query("DELETE FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "' AND `code` = '" . $this->db->escape($code) . "'");
  }
}
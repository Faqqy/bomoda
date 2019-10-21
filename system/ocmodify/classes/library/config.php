<?php
final class OCMConfig extends OCMLibrary {
  public static $code = 'config';
  public static $autoload = true;

  private $data = array();
  private $group_column = 'code';

  public function status() {
    return true;
  }

  public function init() {
    $this->group_column = version_compare(VERSION, '2.0.1', '>=') ? 'code' : 'group';

    // DB settings
    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `store_id` = '0' OR `store_id` = '" . OCM_STORE_ID . "' ORDER BY `store_id` ASC");
    foreach ($query->rows as $setting) {
      $key = version_compare(VERSION, '3', '>=') ? preg_replace('#^(analytics|captcha|dashboard|feed|fraud|module|openbay|payment|report|shipping|theme|total)_#', '', $setting['key']) : $setting['key'];
      if ($setting['value'] == '' && isset($this->data[$key])) {
        continue;
      }
      if (!$setting['serialized']) {
        $this->data[$key] = $setting['value'];
      } else {
        $this->data[$key] = version_compare(VERSION, '2.1.0.1', '>=') ? json_decode($setting['value'], true) : unserialize($setting['value']);
      }
    }

    // Store URL
    if (OCM_STORE_ID != 0) {
      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "store WHERE `store_id` = " . (int)OCM_STORE_ID);
      if ($query->num_rows) {
        $this->data['config_url'] = $query->row['url'];
        $this->data['config_ssl'] = $query->row['ssl'];
      } else {
        $this->data['config_url'] = HTTP_SERVER;
        $this->data['config_ssl'] = HTTPS_SERVER;
      }
    } else {
      $this->data['config_url'] = HTTP_SERVER;
      $this->data['config_ssl'] = HTTPS_SERVER;
    }

    return $this;
  }

  public function loadDefaults() {
    // Default extension configs
    foreach ((array )glob(OCM_DIR . 'extension/*', GLOB_ONLYDIR) as $directory) {
      $default_config = array('status' => $this->get(basename($directory) . '_status'));
      if (is_file($directory . '/config.php')) {
        include_once($directory . '/config.php');
      }
      if (isset($config)) {
        $default_config = array_merge($default_config, $config);
      }
      foreach ($default_config as $key => $value) {
        if (!isset($this->data[basename($directory) . '_' . $key])) {
          $this->data[basename($directory) . '_' . $key] = $value;
        }
      }
    }
  }

  public function set($key, $value) {
    $this->data[$key] = $value;
    if ($this->registry->has('config')) {
      $this->registry->get('config')->set($key, $value);
    }
  }

  public function get($key, $default = null) {
    return isset($this->data[$key]) ? $this->data[$key] : ($this->registry->has('config') && $this->registry->get('config')->has($key) ? $this->registry->get('config')->get($key) : $default);
  }

  public function setGroup($group, $data) {
    foreach ($data as $key => $value) {
      $this->set($group . '_' . $key, $value);
    }
  }

  public function save($group, $key, $value, $store_id = OCM_STORE_ID) {
    $this->data[$group . '_' . $key] = $value;

    $serialized = is_array($value) ? true : false;
    $value = is_array($value) ? (version_compare(VERSION, '2.1.0.1', '>=') ? json_encode($value) : serialize($value)) : $value;

    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE `" . $this->group_column . "` = '" . $group . "' AND `key` = '" . $group . '_' . $key . "' AND `store_id` = '" . (int)$store_id . "'");
    if ($query->num_rows) {
      $this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `value` = '" . $this->db->escape($value) . "', `serialized` = '" . (int)$serialized . "' WHERE `setting_id` = '" . (int)$query->row['setting_id'] . "'");
    } else {
      $this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET `" . $this->group_column . "` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($group . '_' . $key) . "', `value` = '" . $this->db->escape($value) . "', `store_id` = '" . (int)$store_id . "', `serialized` = '" . (int)$serialized . "'");
    }
  }

  public function saveGroup($group, $data) {
    foreach ($data as $key => $value) {
      $this->save($group, $key, $value);
    }
  }

  public function deleteGroup($group, $store_id = OCM_STORE_ID) {
    $query = $this->db->query("SELECT `key` FROM `" . DB_PREFIX . "setting` WHERE `" . $this->group_column . "` = '" . $group . "' AND `store_id` = '" . (int)$store_id . "'");
    if ($query->num_rows) {
      foreach ($query->rows as $row) {
        $this->delete($group, $row['key']);
      }
    }
  }

  public function delete($group, $key, $store_id = OCM_STORE_ID) {
    $key = $group . '_' . $key;
    $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `" . $this->group_column . "` = '" . $group . "' AND `key` = '" . $key . "' AND `store_id` = '" . (int)$store_id . "'");
    unset($this->data[$key]);
  }

  public function filter($group, $full_code = false) {
    $result = array();
    foreach ($this->data as $key => $value) {
      if (preg_match('#^' . preg_quote($group) . '#', $key)) {
        $result[($full_code ? $group . '_' : '') . substr($key, strlen($group) + 1, strlen($key))] = $value;
      }
    }

    return $result;
  }

  public function has($key) {
    return isset($this->data[$key]) ? true : ($this->registry->has('config') && $this->registry->get('config')->has($key) ? true : false);
  }

  public static function instance($ocmodify) {
    return new self($ocmodify);
  }
}
<?php
final class OCMLoad extends OCMLibrary {
  public static $code = 'load';

  public function status() {
    return true;
  }

  public function init() {
    // Initial code here
  }

  public function controller($route, &$data = array()) {
    // Cleanup route
    $route = preg_replace('#[^a-zA-Z0-9_\/]#', '', (string )ocmGetRoute($route));

    // Call instance
    if (version_compare(VERSION, '2', '>=')) {
      return $this->registry->get('load')->controller($route, $data);
    } else {
      $args = array(&$data);
      return OCMAction::instance($route)->execute($this->registry, $args, false);
    }
  }

  public function model($route) {
    // Cleanup route
    $route = preg_replace('#[^a-zA-Z0-9_\/]#', '', (string )$route);

    // Call instance
    $this->registry->get('load')->model(ocmGetRoute($route));

    // Adaptation
    if ($route != ocmgetRoute($route)) {
      $route = preg_replace('#[^a-zA-Z0-9_\/]#', '', (string )$route);
      $this->registry->set('model_' . str_replace(array('/','-','.'), array('_','',''), (string )$route), $this->registry->get('model_' . str_replace(array('/','-','.'), array('_','',''), (string )ocmgetRoute($route))));
      $this->registry->set('model_' . str_replace(array('/','-','.'), array('_','',''), (string )ocmgetRoute($route)), null);
    }
  }

  public function view($route, $data = array()) {
    $theme = version_compare(VERSION, '2.2', '>=') ? preg_replace('#^theme_#', '', $this->config->get('config_theme')) : $this->config->get('config_template');

    // Clean up trigger route
    $route = preg_replace(array('#\.(tpl|twig)$#', '#[^a-zA-Z0-9_\/]#'), '', $route);

    // Correctize trigger route for frontend
    if (!OCM_IS_ADMIN) {
      $route = preg_replace('#^' . $theme . '/template/#', '', $route);
      $route = $theme . '/template/' . $route;
    }

    // Add extension .tpl
    if (version_compare(VERSION, '2.2', '<')) {
      $route .= '.tpl';
    }

    // Set tpl directory for frontend
    if (!OCM_IS_ADMIN) {
      $this->config->set('template_directory', $theme . '/template/');
    }

    if (version_compare(VERSION, '3', '>=')) {
      if (is_file(DIR_TEMPLATE . $route . '.twig')) {
        $result = $this->registry->get('load')->view($route, $data);
      } else {
        // 3.x template engine patch start
        if (version_compare(VERSION, '3', '>=')) {
          $tpl_type = $this->config->get('template_engine');
          $this->config->set('template_engine', 'Template');
        }

        // Call instance
        $result = $this->registry->get('load')->view($route, $data);

        // 3.x template engine patch end
        if (version_compare(VERSION, '3', '>=')) {
          $this->config->set('template_engine', $tpl_type);
        }
      }
    } else {
      $result = $this->registry->get('load')->view($route, $data);
    }

    // Return output
    return $result;
  }

  public function document($filename) {
    if (OCM_IS_ADMIN) {
      $file = DIR_APPLICATION . 'view/document/' . substr($this->config->get('config_admin_language'), 0, 2) . '/' . $filename;
      if (is_file($file)) {
        return file_get_contents($file);
      }
    } elseif (isset($_GET['debug'])) {
      trigger_error('Error: Could not load document ' . $filename . '!');
    }
  }
}

<?php
class OCMLoader extends OCMOverride {
  public static $code = 'load';
  public static $sort = 0;

  public function status() {
    return true;
  }

  public function init() {}

  final public function controller($route, $data = array()) {
    return $this->instance->controller($route, $data);
  }

  final public function view($_route, $_data = array(), $controller = null) {
    $theme = version_compare(VERSION, '2.2', '>=') ? preg_replace('#^theme_#', '', $this->config->get('config_theme')) : $this->config->get('config_template');

    // Clean up trigger route
    $_route = preg_replace(array('#\.(tpl|twig)$#', '#[^a-zA-Z0-9_\/]#'), '', $_route);
    $_route = preg_replace('#^' . $theme . '/template/#', '', $_route);

    // Correctize trigger route for frontend
    if (!OCM_IS_ADMIN) {
      $_route = $theme . '/template/' . $_route;
    }

    // Default result
    $_output = null;

    // Prepare the trigger data
    $arg_data = array_merge(array('trigger' => array('type' => 'view', 'route' => &$_route, 'output' => &$_output)), array('data' => &$_data));
    $trigger = new OCMTrigger($this->registry);

    // Trigger the pre events
    if ($_result = $trigger->execute('before', 'view/' . $_route, $arg_data)) {
      return $_result;
    }

    // Get output
    if (version_compare(VERSION, '2.2', '>=')) {
      $_template = preg_replace('#^' . $theme . '/template/#', '', $_route);
      $_output = $this->instance->view($_template, $_data);
    } else {
      $_template = $_route . '.tpl';
      if (version_compare(VERSION, '2', '>=')) {
        $_output = $this->instance->view($_template, $_data);
      } else {
        if (is_file(DIR_TEMPLATE . $_template)) {
          extract($_data);
          ob_start();
          require_once(ocmGetModifiedFile(DIR_TEMPLATE . $_template));
          $_output = ob_get_contents();
          ob_end_clean();
        }
      }
    }

    // Trigger the post events
    if ($_result = $trigger->execute('after', 'view/' . $_route, $arg_data)) {
      return $_result;
    }

    return $_output;
  }

  final public function model($_route) {
    // Load by core loader
    $this->instance->model($_route);

    // Clean up route
    $_route = preg_replace('#[^a-zA-Z0-9_\/]#', '', (string )$_route);

    // Set proxy, if event registered
    if ($this->event->hasRoute($_route)) {
      $code = 'model_' . str_replace(array('/', '-', '.'), array('_', '', ''), (string )$_route);

      $proxy = new OCMProxy($this->ocmodify, $_route, $this->registry->get($code));
      $this->registry->set($code, $proxy);
    }
  }

  final public function language($_route, $_key = '') {
    // Default result
    $_output = null;

    // Prepare trigger data
    $arg_data = array_merge(array('trigger' => array('type' => 'language', 'route' => &$_route, 'output' => &$_output)));
    $trigger = new OCMTrigger($this->registry);

    // Trigger the pre events
    if ($_result = $trigger->execute('before', 'language/' . $_route, $arg_data)) {
      return $_result;
    }

    if (version_compare(VERSION, '2', '>=')) {
      $_output = $this->instance->language($_route, $_key);
    } else {
      $_output = $this->language->load($_route, $_key);
    }

    // Trigger the post events
    if ($_result = $trigger->execute('after', 'language/' . $_route, $arg_data)) {
      return $_result;
    }

    return $_output;
  }
}
<?php
// Proxy for old versions
if (!class_exists('Proxy')) {
  class Proxy {}
}

// OCM Proxy
class OCMProxyPrototype extends Proxy {
  protected $ocmodify, $route, $instance;

  public function __construct(OCMRegistry $ocmodify, $route, $instance) {
    $this->ocmodify = $ocmodify;
    $this->route = $route;
    $this->instance = $instance;
  }

  public function __call($method, $_args) {
    // Check instance for method existance
    if (!method_exists($this->instance, $method) && !method_exists($this->instance, '__call')) {
      trigger_error('Error: The object ' . get_class($this->instance) . ' does not have method ' . $method . '!');
    }

    // Detect route
    $route = $this->route . '/' . $method;

    // Referenced args
    $args = array();
    foreach ($_args as $i => $arg) {
      if ($arg instanceof Ref) {
        $args[$i] = &$_args[$i]->getRef();
      } else {
        $args[$i] = &$_args[$i];
      }
    }

    // Default result
    $result = null;

    // Prepare the trigger data
    $data = array_merge(array('trigger' => array('type' => 'model', 'route' => &$route, 'result' => &$result)), $args);
    $trigger = new OCMTrigger($this->ocmodify->registry);

    // Trigger the pre events
    if ($_result = $trigger->execute('before', 'model/' . $route, $data)) {
      return $_result;
    }

    // Call model method
    $result = call_user_func_array(array($this->instance, $method), $args);

    // Trigger the post events
    if ($_result = $trigger->execute('after', 'model/' . $route, $data)) {
      return $_result;
    }

    // Return result if not null
    if (!is_null($result)) {
      return $result;
    }
  }

  public function __get($key) {
    return $this->instance->{$key};
  }
}

// Adaptive proxy
if (version_compare(VERSION, '2.2', '>=')) {
  class OCMProxy extends OCMProxyPrototype {
    public function getTotal(&$total_data = array()) {
      return self::__call('getTotal', array(&$total_data));
    }
  }
} else {
  class OCMProxy extends OCMProxyPrototype {
    public function getTotal(&$total_data = array(), &$total = array(), &$taxes = array()) {
      return self::__call('getTotal', array(&$total_data, &$total, &$taxes));
    }
  }
}
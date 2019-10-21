<?php
final class OCMAction {
  private $id, $route;
  private $method = 'index';
  private $triggering = true;

  public function __construct($route) {
    $this->id = $route;

    $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

    // Break apart the route
    while ($parts) {
      $file = DIR_APPLICATION . 'controller/' . implode('/', $parts) . '.php';

      if (is_file($file)) {
        $this->route = implode('/', $parts);
        break;
      } else {
        $this->method = array_pop($parts);
      }
    }
  }

  public function execute(Registry $registry, Array &$_args = array(), $router = true) {
    // Stop any magical methods being called
    if (substr($this->method, 0, 2) == '__') {
      trigger_error('Error: Calls to magic methods are not allowed!');
    }

    $file = DIR_APPLICATION . 'controller/' . $this->route . '.php';
    $class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $this->route);

    if (is_file($file)) {
      // Include file
      require_once(ocmGetModifiedFile($file));

      // Check args count
      $reflectionClass = new ReflectionClass($class);
      if ($reflectionClass->hasMethod($this->method) && $reflectionClass->getMethod($this->method)->getNumberOfRequiredParameters() <= count($_args)) {
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
        $route = $this->route . '/' . $this->method;
        $data = array_merge(array('trigger' => array('type' => 'controller', 'route' => &$route, 'result' => &$result)), $args);
        $trigger = new OCMTrigger($registry);

        // Trigger the pre events
        if (defined('OCM_EXECUTED') && $this->triggering && (!OCM_IS_ADMIN || ocmIsLogged())) {
          if ($_result = $trigger->execute('before', 'controller/' . $route, $data)) {
            return $_result;
          }
        }

        // Controller's instance
        $controller = new $class($registry);

        // Execute action
        if (version_compare(VERSION, '2', '>=')) {
          $result = call_user_func_array(array($controller, $this->method), $args);
        } else {
          $reflectionMethod = $reflectionClass->getMethod($this->method);
          $reflectionMethod->setAccessible(true);

          $_result = $reflectionMethod->invokeArgs($controller, $args);
          if (!is_null($_result) && !$result instanceof Exception) {
            $result = $_result;
          }

          if (!$router) {
            $reflectionProperty = $reflectionClass->getProperty('output');
            $reflectionProperty->setAccessible(true);

            $result = $reflectionProperty->getValue($controller);
            if (!is_null($_result) && !$result instanceof Exception) {
              $result = $_result;
            }
          }
        }

        // Trigger the post events
        if (defined('OCM_EXECUTED') && $this->triggering && (!OCM_IS_ADMIN || ocmIsLogged())) {
          if ($_result = $trigger->execute('after', 'controller/' . $route, $data)) {
            return $_result;
          }
        }

        if ($result instanceof Exception) {
          return false;
        }

        return $result;
      }
    } else {
      trigger_error('Error: Could not call ' . $this->id . '!');
    }
  }

  public function setTriggering($status) {
    $this->triggering = $status;
  }

  public function getId() {
    return $this->id;
  }

  public static function instance($route) {
    return new self($route);
  }
}
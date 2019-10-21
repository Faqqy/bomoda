<?php
abstract class OCMOverride extends OCMLibrary {
  public static $sort = 0;

  public function __call($method, $args) {
    // Call next instance
    //if (method_exists($this->instance, $method) || method_exists($this->instance, '__call')) {
      return call_user_func_array(array($this->instance, $method), $args);
    //}
  }

  final public function setInstance($instance) {
    $this->instance = $instance;
  }
}
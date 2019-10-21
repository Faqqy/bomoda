<?php
final class OCMRegistry {
  private $data = array();

  public function __construct(Registry $registry) {
    // Set core registry
    $this->registry = $registry;

    // Set global static instance
    OCModify::$instance = $this;

    // Initialize temporary db
    $this->db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, defined('DB_PORT') ? DB_PORT : 3306);

    /*
    // Initialize temporary config
    $this->config = OCMConfig::instance($this)->execute();
    */

    // Register libraries
    foreach (glob(OCM_DIR . 'classes/library/*.php') as $file) {
      $class = 'OCM' . str_replace(' ', '', ucwords(str_replace('_', ' ', basename($file, '.php'))));
      $this->data[$class::$code] = new $class($this);
    }

    // Initialize libraries
    foreach ($this->data as $library) {
      if ($library instanceOf OCMLibrary && $library::$autoload) {
        if (!$library->executed) {
          $library->execute();
        }
      }
    }

    // Set registry overrides
    OCModify::ocmSetOverrides();
  }

  public function __get($code) {
    $instance = null;

    // Initialize library on first use
    if (isset($this->data[$code])) {
      if ($this->data[$code] instanceof OCMLibrary) {
        if ($this->data[$code]->status()) {
          $instance = $this->data[$code];
        }
      } else {
        $instance = $this->data[$code];
      }
    }

    // Execute library instance
    if ($instance && ($instance instanceof OCMLibrary) && !$instance->executed) {
      $this->data[$code]->execute();
    }

    // Return system class
    return $instance ? $instance : $this->registry->get($code);
  }

  public function __set($code, $instance) {
    $this->data[$code] = $instance;
  }

  public function get($code) {
    return $this->{$code};
  }

  public function set($code, $instance) {
    $this->{$code} = $instance;
  }

  public function has($code) {
    return isset($this->data[$code]);
  }
}
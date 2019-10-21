<?php
abstract class OCMLibrary {
  public static $code, $sort = 0;
  public static $autoload = false;

  protected $ocmodify, $library, $bridge, $instance;
  protected $executed = false;

  final public function __construct(OCMRegistry $ocmodify, $instance = null) {
    $this->ocmodify = $ocmodify;
    $this->instance = $instance;
  }

  final public function __get($key) {
    return $this->ocmodify->{$key};
  }

  final public function __set($key, $value) {
    $this->ocmodify->{$key} = $value;
  }

  final public function execute($library = null, $bridge = null) {
    if ($library) {
      $this->library = $library;
    }

    if ($bridge) {
      $this->bridge = $bridge;
    }

    if (!$this->executed) {
      $this->executed = true;
      $this->init();
    }
  }

  abstract protected function status();

  abstract protected function init();
}
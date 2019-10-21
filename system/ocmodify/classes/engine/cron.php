<?php
abstract class OCMCron {
  protected $ocmodify;

  final public function __construct(OCMRegistry $ocmodify) {
    $this->ocmodify = $ocmodify;
  }

  final public function __get($key) {
    return $this->ocmodify->{$key};
  }

  final public function __set($key, $value) {
    $this->ocmodify->{$key} = $value;
  }

  abstract public function execute($args, $executed);
}
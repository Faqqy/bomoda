<?php
final class OCMBridge {
  private $library;
  private $overrides = array(), $callers = array();

  public function __construct($overrides) {
    $this->overrides = array_values($overrides);
  }

  public function getLibrary() {
    return $this->library;
  }

  public function setLibrary($library) {
    $this->library = $library;
  }

  public function execute() {
    if (count($this->overrides) != count($this->callers)) {
      $this->callers = array();
      foreach ($this->overrides as $i => $override) {
        if ($override->status()) {
          $override->execute($this->library, $this);
          $this->callers[] = $override;
        }
      }
      foreach ($this->callers as $i => $caller) {
        $caller->setInstance(isset($this->callers[$i + 1]) ? $this->callers[$i + 1] : $this->library);
      }
    }
  }

  public function __call($method, $_args) {
    // Referenced args
    $args = array();
    foreach ($_args as $i => $arg) {
      if ($arg instanceof Ref) {
        $args[$i] = &$_args[$i]->getRef();
      } else {
        $args[$i] = &$_args[$i];
      }
    }

    // Call override callers
    foreach ($this->callers as $caller) {
      if (method_exists($caller, $method)) {
        return call_user_func_array(array($caller, $method), $args);
      }
    }

    // Call root library
    if (method_exists($this->library, $method) || method_exists($this->library, '__call')) {
      return call_user_func_array(array($this->library, $method), $args);
    }
  }
}
<?php
final class OCMEvent extends OCMLibrary {
  public static $code = 'event';

  private $data = array(), $replacers = array(
    '\*' => '.*',
    '\?' => '.',
    '\{' => '(',
    ',' => '|',
    '\}' => ')',
  );

  public function status() {
    return true;
  }

  public function init() {
    // Initial code here
  }

  public function register($trigger, OCMAction $action) {
    // Clean up trigger route
    $trigger = preg_replace('#/index(/\w+)$#', '${1}', $trigger);

    // Add route to triggers
    $this->data[$trigger][] = $action;
  }

  public function trigger($route, $position, &$args = array()) {
    // Clean up event route
    $event = preg_replace('#/index$#', '', $route) . '/' . $position;

    // Match triggers
    foreach ($this->data as $trigger => $actions) {
      if (preg_match('#^' . str_replace(array_keys($this->replacers), array_values($this->replacers), preg_quote($trigger, '#')) . '(/\w+)?$#', $event)) {
        foreach ($actions as $action) {
          $action->setTriggering(false);
          $result = $action->execute($this->registry, $args);
          if (!is_null($result)) {
            return $result;
          }
        }
      }
    }
  }

  public function unregister($trigger, $route = null) {
    // Clean up trigger route
    $trigger = preg_replace('#/index(/\w+)$#', '${1}', $trigger);

    // Unset matched triggers
    if ($route) {
      foreach ($this->data[$trigger] as $key => $action) {
        if ($action->getPath() == $route) {
          unset($this->data[$trigger][$key]);
        }
      }
    } else {
      unset($this->data[$trigger]);
    }
  }

  public function removeAction($trigger, $route) {
    // Clean up trigger route
    $trigger = preg_replace('#/index(/\w+)$#', '${1}', $trigger);

    // Unset matched actions
    foreach ($this->data[$trigger] as $key => $action) {
      if ($action->getPath() == $route) {
        unset($this->data[$trigger][$key]);
      }
    }
  }

  public function hasRoute($route) {
    // Match triggers
    foreach ($this->data as $trigger => $actions) {
      if (preg_match('#^' . preg_replace('#(/[^/\(\|\)]+)?(/[^/\(\|\)]+)?$#', '', str_replace(array_keys($this->replacers), array_values($this->replacers), preg_quote($trigger, '#'))) . '#', 'model/' . $route)) {
        return true;
      }
    }
  }
}
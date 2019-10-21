<?php
final class OCMTrigger {
  private $registry;

  public function __construct(Registry $registry) {
    $this->registry = $registry;
  }

  public function execute($position, $route, &$data) {
    $_result = $this->registry->get('ocmodify')->event->trigger($route, $position, $data);
    if (!is_null($_result) && !$_result instanceof Exception) {
      if ($_result instanceof OCMAction) {
        $_result->setTriggering(false);
        return $_result->execute($this->registry, $data);
      } else {
        return $_result;
      }
    }
  }
}
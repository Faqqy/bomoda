<?php
class OCMModel extends Model {
  final public function __construct(Registry $registry) {
    $this->registry = ocmStartup($registry);

    // Alternative used for keeping model in registry and does not give to create multiple copies
    $alt = 'alt_' . strtolower(get_class($this));

    // Initialize one, if there is not alternative
    if (method_exists($this, 'init') && !$registry->has($alt)) {
      $registry->set($alt, $this);
      $this->init();
    }
  }
}
<?php
final class OCModify {
  public static $instance;
  private static $overrides = array(), $classes = array();

  public static function autoload($class) {
    if (!self::$classes) {
      foreach((array)glob(OCM_DIR . 'classes/{engine/,library/,override/,}*.php', GLOB_BRACE) as $file) {
        self::$classes['OCM' . strtoupper(str_replace(' ', '', ucwords(str_replace('_', ' ', basename($file, '.php')))))] = $file;
      }
    }
    if (isset(self::$classes[strtoupper($class)])) {
      require_once(self::$classes[strtoupper($class)]);
    }
  }

  public static function ocmSetOverrides() {
    foreach ((array)glob(OCM_DIR . 'classes/override/*.php') as $file) {
      $class = 'OCM' . str_replace(' ', '', ucwords(str_replace('_', ' ', basename($file, '.php'))));
      while (isset(self::$overrides[$class::$code][$class::$sort])) {
        $class::$sort++;
      }
      self::$overrides[$class::$code][$class::$sort] = new $class(OCModify::$instance);
    }
    foreach (self::$overrides as &$item) {
      ksort($item);
    }
  }

  public static function ocmGetOverride(&$data, $code) {
    // Initialize bridge instances
    if (isset($data[$code]) && ($data[$code] instanceof OCMBridge)) {
      $data[$code]->execute();
    }

    // Return current instance
    return isset($data[$code]) ? $data[$code] : null;
  }

  public static function ocmSetOverride(&$data, $code, $instance) {
    if ($instance instanceof OCMBridge) {
      $instance = $instance->getLibrary();
    }

    if (isset(self::$overrides[$code])) {
      $data[$code] = new OCMBridge(self::$overrides[$code]);
      //unset(self::$overrides[$code]);
    } else {
      $data[$code] = $instance;
    }

    if ($data[$code] instanceof OCMBridge) {
      $data[$code]->setLibrary($instance);
    }
  }
}
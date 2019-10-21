<?php
class OCMArray {
  public static function parseString($string) {
    $data = array();

    $lines = explode('&', html_entity_decode(urldecode($string)));

    foreach ($lines as $line) {
      $row = self::parseLine($line);
      $data = array_merge_recursive($data, $row);

    }

    $data = json_decode(str_replace(array('@-', '-@'), '', json_encode($data)), true);

    return $data;
  }

  public static function parseLine($line) {
    $data = array();

    if ($line) {
      list($key, $value) = explode('=', $line);
      $root = preg_replace('#^(\w+).*#', '${1}', $key);

      if (preg_match_all('#(\[\w+\]+)#', $key, $matches)) {
        $data[$root] = self::combine($data, $matches[1], $value);
      } else {
        $data[$root][] = $value;
      }
    }

    return $data;
  }

  public static function combine($data, $keys, $value) {
    foreach ($keys as $i => $key) {
      $key = trim($key, '[]');
      if (count($keys) == 1) {
        $data[$key] = $value;
      } else {
        $keys = array_slice($keys, $i + 1, count($keys));
        $data['@-' . $key . '-@'] = self::combine($data, $keys, $value);
        break;
      }

    }
    return $data;
  }
}

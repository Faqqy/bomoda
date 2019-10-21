<?php
if (!function_exists('utf8_ucfirst')) {
  function utf8_ucfirst($str, $enc = 'utf-8') {
    return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc) . mb_substr($str, 1, mb_strlen($str, $enc), $enc);
  }
}

if (!function_exists('utf8_substr')) {
  function utf8_substr($string, $offset, $length = null) {
    if ($length === null) {
      return mb_substr($string, $offset, utf8_strlen($string));
    } else {
      return mb_substr($string, $offset, $length);
    }
  }
}
<?php
final class OCMLog extends OCMLibrary {
  public static $code = 'log';

  public function status() {
    return true;
  }

  public function init() {
    // Initial code here
  }

  public function write($message, $filename = '') {
    if ($filename) {
      $filename = preg_replace('#\.log$#', '', $filename);
      $filename .= '.log';
    } else {
      $filename = $this->config->get('config_error_filename');
    }

    if (is_file(DIR_LOGS . $filename) && is_writable(DIR_LOGS . $filename)) {
      @chmod(DIR_LOGS . $filename, 0777);
    }

    $handle = fopen(DIR_LOGS . $filename, 'a');
    fwrite($handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
    fclose($handle);

    if (is_file(DIR_LOGS . $filename) && is_writable(DIR_LOGS . $filename)) {
      @chmod(DIR_LOGS . $filename, 0777);
    }
  }
}
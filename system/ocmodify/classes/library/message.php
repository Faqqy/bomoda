<?php
final class OCMMessage extends OCMLibrary {
  public static $code = 'message';

  protected $class = array('success' => 'alert-success', 'error' => 'alert-danger', 'warning' => 'alert-warning');
  protected $icon = array('success' => 'fa-check-circle', 'error' => 'fa-exclamation-circle', 'warning' => 'fa-exclamation-triangle');

  public function status() {
    return true;
  }

  public function init() {
    // Initial code here
  }

  public function get($type = null) {
    $messages = isset($this->session->data['ocm_messages']) ? $this->session->data['ocm_messages'] : array();

    if ($type) {
      $this->session->data['ocm_messages'] = array_filter($messages, function($item) use ($type) {
        if ($item['type'] != $type) {
          return $item;
        }
      });
    } else {
      $this->session->data['ocm_messages'] = array();
    }

    if ($this->session->data['ocm_messages']) {
      $messages = array_diff($messages, $this->session->data['ocm_messages']);
    }

    return $messages;
  }

  public function add($type, $message) {
    if ($type && $message) {
      $this->session->data['ocm_messages'][md5($message)] = array(
        'type' => $type,
        'text' => $message,
        'class' => (isset($this->class[$type]) ? $this->class[$type] : ''),
        'icon' => (isset($this->icon[$type]) ? $this->icon[$type] : ''),
      );
    }
  }
}
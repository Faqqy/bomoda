<?php
final class OCMUrl extends OCMLibrary {
  public static $code = 'url';

  public function status() {
    return OCM_IS_ADMIN;
  }

  public function init() {
    // Initial code here
  }

  public function link($route, $args = '', $secure = false) {
    // Argument: token/user_token
    if (ocmIsLogged() && !preg_match('#' . ocmGetTokenKey() . '=\w+#', $args)) {
      $args .= '&' . ocmGetTokenKey() . '=' . ocmGetToken($this);
    }

    // Argument: page
    $args = preg_replace('#(\?|&)page=\d+#', '', $args);
    if (isset($this->request->get['page']) && (int)$this->request->get['page'] > 1) {
      $args .= '&page=' . $this->request->get['page'];
    }

    // Argument: store_id
    $args = preg_replace('#(\?|&)store_id=\d+#', '', $args);
    if (isset($this->request->get['store_id']) && (int)$this->request->get['store_id'] > 0) {
      $args .= '&store_id=' . OCM_STORE_ID;
    }

    // Prepare
    if ($this->registry->has('url')) {
      $link = $this->registry->get('url')->link(ocmGetRoute($route), $args, $secure);
    }

    return urldecode(htmlspecialchars_decode($link));
  }
}
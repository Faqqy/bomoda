<?php
require_once (DIR_SYSTEM . 'ocmodify/startup.php');
class ControllerExtensionModuleBreadcrumbsPlus extends OCMController {
  protected $params = array(
    'group' => 'module',
    'code' => 'breadcrumbs_plus',
    );

  public function index() {
    // Load languages
    $this->language->load('extension/module/breadcrumbs_plus');

    // Process post data
    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate('extension/module/breadcrumbs_plus')) {
      if (isset($this->request->post['breadcrumbs_plus'])) {
        $this->config->saveGroup('breadcrumbs_plus', $this->request->post['breadcrumbs_plus']);
        $this->message->add('success', $this->language->get('text_success'));
      }
      if (ocmIsAjax()) {
        $this->ajaxOutput();
      } elseif (isset($this->request->server['HTTP_REFERER'])) {
        $this->response->redirect($this->request->server['HTTP_REFERER']);
      }
    }

    $data = array();

    // Output
    $this->setOutput('extension/module/breadcrumbs_plus', $data);
  }
}
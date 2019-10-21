<?php
class OCMController extends Controller {
  protected $output;
  protected $params = array();

  final public function __construct(Registry $registry) {
    $this->registry = ocmStartup($registry);

    // Execute main controller
    if (isset($this->params['code']) && isset($this->params['group'])) {
      $this->execute();
    }

    // Initialize
    if (method_exists($this, 'init')) {
      $this->init();
    }
  }

  final public function execute() {
    $this->language->load('ocmodify');

    if (ocmIsLoggedIn()) {
      // Parse superform data
      if (isset($this->request->post['ocm-serializedData'])) {
        $this->request->post = array_merge($this->request->post, OCMArray::parseString($this->request->post['ocm-serializedData']));
        unset($this->request->post['ocm-serializedData']);
      }

      // Set page arg
      $this->request->get['page'] = isset($this->request->get['page']) ? $this->request->get['page'] : 1;

      // Fix referrer
      if (isset($this->request->server['HTTP_REFERER'])) {
        $this->request->server['HTTP_REFERER'] = str_replace('&amp;', '&', $this->request->server['HTTP_REFERER']);
      }

      // Patch post request
      if (isset($this->request->post[$this->params['code']])) {
        $this->config->saveGroup((version_compare(VERSION, '3', '>=') ? $this->params['group'] . '_' : '') . $this->params['code'], $this->request->post[$this->params['code']]);
      }
    }
  }

  final public function install() {
    if (isset($this->params['group']) && isset($this->params['code'])) {
      // Meta information
      ocmInstall($this->params['code']);

      // Import default configs
      foreach ($this->config->filter($this->params['code']) as $key => $value) {
        if (!$this->config->has($this->params['code'] . '_' . $key)) {
          $this->config->save((version_compare(VERSION, '3', '>=') ? $this->params['group'] . '_' : '') . $this->params['code'], $key, $value);
        }
      }

      // Set permissions
      $this->load->model('user/user');
      $user = $this->model_user_user->getUser($this->user->getId());

      $this->load->model('user/user_group');
      $this->model_user_user_group->addPermission($user['user_group_id'], 'access', ocmGetRoute('extension/' . $this->params['group'] . '/' . $this->params['code']));
      $this->model_user_user_group->addPermission($user['user_group_id'], 'modify', ocmGetRoute('extension/' . $this->params['group'] . '/' . $this->params['code']));

      // Message to user end
      $this->message->add('success', $this->language->get('text_success_install'));
    }
  }

  final public function uninstall() {
    if (isset($this->params['group']) && isset($this->params['code'])) {
      // Remove meta info
      ocmUninstall($this->params['code']);

      // Delete configs
      $this->config->deleteGroup((version_compare(VERSION, '3', '>=') ? $this->params['group'] . '_' : '') . $this->params['code']);
    }
  }

  final public function getOutput($template, array $input_data = array()) {
    $data = $this->language->getAll();

    if (ocmIsLoggedIn()) {
      // Check ajax post
      if ($this->request->server['REQUEST_METHOD'] == 'POST' && ocmIsAjax()) {
        $this->ajaxOutput();
      }

      // Detect route
      $route_parts = explode('/', preg_replace(array('#^extension\/#', '#(/index|/install|/uninstall)$#'), '', $this->request->get['route']));
      list($group, $code) = $route_parts;

      // Extension db config
      $data = array_merge($data, $this->config->filter($code));

      // Default actions
      if (!isset($data['action'])) {
        $data['action'] = $this->url->link((version_compare(VERSION, '2.3', '>=') ? 'extension/' : '') . $group . '/' . $code, '', 'SSL');
      }
      if (!isset($data['cancel'])) {
        $data['cancel'] = $this->url->link((version_compare(VERSION, '3', '>=') ? 'marketplace' : 'extension') . '/' . (version_compare(VERSION, '2.3', '>=') ? 'extension' : $group), (version_compare(VERSION, '2.3', '>=') ? 'type=' . $group . '&' : ''), 'SSL');
      }

      // Token arg
      $data['token'] = ocmGetToken($this);

      // Page arg
      $data['page'] = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;

      // Framework
      $data['ocmodify'] = $this->ocmodify;

      // Store list
      $data['stores'] = ocmGetStores();
    }

    // Merge data
    $data = array_merge($data, $input_data);

    // Return output
    return $this->output = $this->load->view($template, $data);
  }

  final public function setOutput($template, array $input_data = array()) {
    if (ocmIsLoggedIn()) {
      // Check ajax post
      if ($this->request->server['REQUEST_METHOD'] == 'POST' && ocmIsAjax()) {
        $this->ajaxOutput();
      }

      // Language data
      $data = $this->language->getAll();

      // Detect current route
      $route_parts = explode('/', preg_replace(array('#^extension\/#', '#(/index|/install|/uninstall)$#'), '', $this->request->get['route']));
      list($group, $code) = $route_parts;

      // Messages
      $data['messages'] = $this->message->get();

      // Heading title
      if (count($route_parts) > 2) {
        $this->document->setTitle($this->language->get('heading_title_' . end($route_parts)));
      } else {
        $this->document->setTitle($this->language->get('heading_title'));
      }

      // Extension db config
      $data = array_merge($data, $this->config->filter($code));

      // Breadcrumbs
      if (empty($data['breadcrumbs'])) {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
          'text' => $this->language->get('text_home'),
          'href' => $this->url->link((version_compare(VERSION, '2', '>=') ? 'common/dashboard' : 'common/home'), '', 'SSL'),
          'separator' => false,
        );

        $data['breadcrumbs'][] = array(
          'text' => $this->language->get('text_' . $group),
          'href' => $this->url->link((version_compare(VERSION, '3', '>=') ? 'marketplace' : 'extension') . '/' . (version_compare(VERSION, '2.3', '>=') ? 'extension' : $group), (version_compare(VERSION, '2.3', '>=') ? 'type=' . $group . '&' : ''), 'SSL'),
          'separator' => ' :: ',
        );

        $data['breadcrumbs'][] = array(
          'text' => $this->language->get('heading_title'),
          'href' => $this->url->link($group . '/' . $code, '', 'SSL'),
          'separator' => ' :: ',
        );

        for ($i = 2; $i < count($route_parts); $i++) {
          $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_' . $route_parts[$i]),
            'href' => $this->url->link($group . '/' . $code . '/' . $route_parts[$i], '', 'SSL'),
            'separator' => ' :: ',
          );
        }
      }

      // Default actions
      if (empty($data['action'])) {
        $data['action'] = $this->url->link((version_compare(VERSION, '2.3', '>=') ? 'extension/' : '') . $group . '/' . $code, '', 'SSL');
      }
      if (empty($data['cancel'])) {
        $data['cancel'] = $this->url->link((version_compare(VERSION, '3', '>=') ? 'marketplace' : 'extension') . '/' . (version_compare(VERSION, '2.3', '>=') ? 'extension' : $group), (version_compare(VERSION, '2.3', '>=') ? 'type=' . $group . '&' : ''), 'SSL');
      }

      // Token arg
      $data['token'] = ocmGetToken($this);

      // Page arg
      $data['page'] = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;

      // Framework
      $data['ocmodify'] = $this->ocmodify;

      // Store list
      $data['stores'] = ocmGetStores();

      // Documentation
      $data['help_documentation'] = $this->load->document('extension/' . $code . '/documentation.htm');
      $data['help_support'] = $this->load->document('support.htm');

      // Opencart 1.x patch
      if (version_compare(VERSION, '2', '<')) {
        // Bootstrap for opencart 1.x
        $this->document->addScript('view/assets/js/bootstrap.min.js');
        $this->document->addStyle('view/assets/css/bootstrap-ocm.min.css');

        // Font awesome
        $this->document->addStyle('view/assets/css/font-awesome.min.css');

        // CKEditor
        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
      }

      // Summernote for 2.3+
      if (version_compare(VERSION, '2.3', '>=')) {
        $this->document->addScript('view/javascript/summernote/summernote.js');
        $this->document->addScript('view/javascript/summernote/opencart.js');
        $this->document->addStyle('view/javascript/summernote/summernote.css');
      }

      // Multiselect
      $this->document->addScript('view/assets/js/bootstrap-multiselect.min.js');
      $this->document->addStyle('view/assets/css/bootstrap-multiselect.min.css');

      // Bootbox
      $this->document->addScript('view/assets/js/bootstrap-bootbox.min.js');

      // OcModify assets
      $this->document->addScript('view/assets/js/ocmodify.js');
      $this->document->addStyle('view/assets/css/ocmodify.css');

      // Columns
      if (version_compare(VERSION, '2', '>=')) {
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
      } else {
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = '';
        $data['footer'] = $this->load->controller('common/footer');
      }

      // JS language
      $data['header'] = $data['header'] . '<script type="text/javascript">var jslanguage = ' . json_encode($this->language->get('javascript')) . ';</script>';

      // Merge data
      $data = array_merge($data, $input_data);

      // Processing html
      $html = $this->load->view($template, $data);

      // Patching jquery
      if (version_compare(VERSION, '2', '<')) {
        $html = preg_replace(array(
          "#<script(.*)jquery(.*)></script>#",
          "#<script(.*)jquery(.*)ui(.*)></script>#",
          "#<link(.*)jquery(.*)ui(.*)/>#",
        ), array(
          '<script type="text/javascript" src="view/assets/js/jquery-2.1.1.min.js"></script><script type="text/javascript" src="view/assets/js/jquery-migrate-1.2.1.min.js"></script>',
          '<script type="text/javascript" src="view/assets/js/jquery-ui.min.js"></script>',
          '<link rel="stylesheet" type="text/css" href="view/assets/css/jquery-ui.min.css" />',
        ), $html, 1);
      }

      // Setting output
      $this->response->setOutput($html);
    }
  }

  final public function ajaxOutput($data = array()) {
    // Messages
    $data['messages'] = $this->message->get();

    // Token arg
    //$data['token'] = ocmGetToken($this);

    // Page arg
    //$data['page'] = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;

    // Store list
    //$data['stores'] = ocmGetStores();

    // Output
    header('Content-type: application/json');
    exit(json_encode($data));
  }
  
  final public function processRequest() {
    if (ocmIsAjax()) {
      $this->ajaxOutput();
    } elseif (isset($this->request->server['HTTP_REFERER'])) {
      $this->response->redirect($this->request->server['HTTP_REFERER']);
    } elseif (isset($this->request->get['referer'])) {
      $this->response->redirect($this->request->get['referer']);
    } elseif (isset($this->request->post['referer'])) {
      $this->response->redirect($this->request->post['referer']);
    }
  }

  final public function validate($route = null) {
    $route = $route ? $route : (!empty($this->request->get['route']) ? $this->request->get['route'] : '');
    if (ocmIsLoggedIn() && $this->user->hasPermission('modify', ocmGetRoute($route))) {
      return true;
    } elseif (!defined('OCM_IS_ADMIN') || !OCM_IS_ADMIN) {
      return true;
    } else {
      return false;
    }
  }

  final public function buildURL($args) {
    $url = '';

    foreach ($args as $key => $value) {
      $arg = is_numeric($key) ? $value : $key;
      if (isset($this->request->get[$arg])) {
        $url .= '&' . $arg . '=' . $this->request->get[$arg];
      } else {
        $this->request->get[$arg] = !is_numeric($key) ? $value : '';
      }
    }

    return $url;
  }
}
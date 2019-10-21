<?php
final class OCMLanguage extends OCMLibrary {
  public static $code = 'language';

  private $data = array(), $languages = array();

  public function status() {
    return true;
  }

  public function init() {
    // Get list
    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` ORDER BY `sort_order`, `name`");
    foreach ($query->rows as $result) {
      $this->languages[$result['code']] = array(
        'language_id' => $result['language_id'],
        'name' => $result['name'],
        'code' => $result['code'],
        'locale' => $result['locale'],
        'directory' => (version_compare(VERSION, '2.2', '>=') ? $result['code'] : $result['directory']),
        'sort_order' => $result['sort_order'],
        'status' => $result['status'],
        'image' => (version_compare(VERSION, '2.2', '>=') ? 'language/' . $result['code'] . '/' . $result['code'] . '.png' : $result['image'] = '../image/flags/' . $result['image']),
      );
    }

    // Set php locale for date/time
    if ($language_code = $this->config->get('config_admin_language', $this->config->get('config_language'))) {
      $locales = explode(',', $this->languages[$language_code]['locale']);
      setlocale(LC_TIME, preg_replace('#(\w+)(\..*)?#', '${1}.UTF-8', $locales[0]));
    }

    // Admin language patch
    if (!$this->config->has('config_admin_language')) {
      $this->config->set('config_admin_language', $this->config->get('config_language'));
    }

    // Language ID
    if (!$this->registry->get('config')->has('config_language_id')) {
      $this->config->set('config_language_id', (OCM_IS_ADMIN ? $this->languages[$this->config->get('config_admin_language')]['language_id'] : $this->languages[$this->config->get('config_language')]['language_id']));
    }

    // Load main language
    $this->load('ocmodify');
  }

  public function load($route, $override = true) {
    if ($this->instance) {
      $data = (array )$this->instance->load(ocmGetRoute($route));
    } else {
      $data = (array )$this->registry->get('language')->load(ocmGetRoute($route));
    }
    $this->data = array_merge($this->data, $override ? $data : $this->getDiff($this->data, $data));

    return $this->data;
  }

  public function getAll() {
    return (array )$this->data;
  }

  public function getDiff($current, $new) {
    foreach ($current as $key => $value) {
      unset($new[$key]);
    }

    return $new;
  }

  public function get($key) {
    if (isset($this->data[$key])) {
      return $this->data[$key];
    } elseif ($this->instance) {
      return $this->instance->get($key);
    } else {
      return $this->registry->get('language')->get($key);
    }
  }

  public function getList() {
    return $this->languages;
  }

  public function getCode() {
    return isset($this->session->data['language']) ? $this->session->data['language'] : (isset($this->request->cookie['language']) ? $this->request->cookie['language'] : (OCM_IS_ADMIN ? $this->config->get('config_admin_language') : $this->config->get('config_language')));
  }

  public function getId() {
    return isset($this->languages[$this->getCode()]) ? $this->languages[$this->getCode()]['language_id'] : $this->config->get('config_language_id');
  }

  public function getByCode($code) {
    return isset($this->languages[$code]) ? $this->languages[$code] : array();
  }

  public function getById($language_id) {
    $result = array();
    foreach ($this->languages as $language) {
      if ($language['language_id'] == $language_id) {
        $result = $language;
        break;
      }
    }

    return $result;
  }
}
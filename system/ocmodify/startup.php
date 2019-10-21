<?php
// Debug mode
if (isset($_GET['debug'])) {
  error_reporting(E_ALL);
  ini_set('display_errors', 'on');
  ini_set('display_startup_errors', 'on');
}

if (!defined('OCM_LOADED')) {
  // Exclude conflicts
  define('OCM_LOADED', true);

  // Startup definitions
  $parts = explode('/', trim(str_replace('\\', '/', DIR_APPLICATION), '/'));
  define('OCM_IS_ADMIN', ($parts[count($parts) - 1] == 'catalog' || !defined('DIR_CATALOG')) ? false : true);
  define('OCM_DIR', DIR_SYSTEM . 'ocmodify/');
  define('OCM_STORE_ID', isset($_GET['store_id']) ? (int)$_GET['store_id'] : 0);
  define('OCM_VERSION', '1.1.4');

  // Define HTTPS_CATALOG for 1.4.9/1.5.0/1.5.1
  if (OCM_IS_ADMIN && !defined('HTTPS_CATALOG')) {
    define('HTTPS_CATALOG', HTTP_CATALOG);
  }

  // Admin directory name
  if (OCM_IS_ADMIN) {
    define('OCM_ADMIN_FOLDER', basename(DIR_APPLICATION));
  } elseif (is_file(OCM_DIR . 'extension/ocmodify/admin.path')) {
    define('OCM_ADMIN_FOLDER', preg_replace('#[^\w]+#', "", file_get_contents(OCM_DIR . 'extension/ocmodify/admin.path')));
  } elseif (is_dir(DIR_APPLICATION . '../admin')) {
    define('OCM_ADMIN_FOLDER', 'admin');
  }

  // Store directory name
  if (OCM_ADMIN_FOLDER) {
    file_put_contents(OCM_DIR . 'extension/ocmodify/admin.path', OCM_ADMIN_FOLDER);
  }

  // Modification directories
  if (!defined('DEMO_STORE')) {
    if (version_compare(VERSION, '2', '>=')) {
      define('OCM_DIR_XML', DIR_SYSTEM);
      define('OCM_DIR_MOD', DIR_MODIFICATION);
    } else {
      define('OCM_DIR_XML', str_replace('\\', '/', realpath(DIR_SYSTEM . '../vqmod/xml')) . '/');
      define('OCM_DIR_MOD', str_replace('\\', '/', realpath(DIR_SYSTEM . '../vqmod')) . '/');
    }
  }

  // Put empty index.html files, if not exist
  if (version_compare(VERSION, '2', '>=')) {
    if (!is_file(DIR_MODIFICATION . 'index.html')) {
      file_put_contents(DIR_MODIFICATION . 'index.html', '<html></html>');
    }
    if (!is_file(OCM_DIR . 'storage/index.html')) {
      file_put_contents(OCM_DIR . 'storage/index.html', '<html></html>');
    }
  }

  // Include core
  require_once(OCM_DIR . 'classes/engine/ocmodify.php');

  // Include Helpers
  foreach ((array)glob(OCM_DIR . 'helper/*.php', GLOB_BRACE) as $file) {
    if (is_file($file)) {
      require_once($file);
    }
  }

  // Run Migrations
  foreach ((array)glob(OCM_DIR . 'migrate/*.php', GLOB_BRACE) as $migration) {
    if (is_file($migration)) {
      $install = ocmGetInstall(basename($migration, '.php'));
      $status = require_once($migration);
      if ($status === true) {
        unlink($migration);
      }
    }
  }

  // Register autoload
  spl_autoload_register('OcModify::autoload');

  // Check framework installation
  $install = ocmGetInstall('ocmodify');
  if (!$install || !isset($install['version']) || OCM_VERSION != $install['version']) {
    ocmInstall('ocmodify');
  }

  // Bootup
  function ocmBootup($registry) {
    if (!$registry->has('ocmodify')) {
      $registry->set('ocmodify', new OCMRegistry($registry));
    }
  }

  // Startup
  function ocmStartup($registry) {
    if (!defined('OCM_EXECUTED')) {
      // Set executed
      define('OCM_EXECUTED', true);

      // Bootup ocmodify instance
      ocmBootup($registry);

      // Get ocmodify instance
      $ocmodify = $registry->get('ocmodify');

      // Load default extension configs
      $ocmodify->config->loadDefaults();

      // Check system requirements
      ocmCheckRequirements();

      // Check installations
      ocmCheckInstalls();

      // Check modifications
      ocmCheckMods();

      // Startups
      foreach ((array)glob(OCM_DIR . 'startup/*.php') as $file) {
        require_once($file);
      }
    }

    return $registry->get('ocmodify');
  }
}
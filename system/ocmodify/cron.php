<?php
// Set cron running
define('OCM_IS_CRON', true);

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 'on');

// Parse args
if ($argc >= 2) {
  list($file, $path) = $argv;
  $args = array_slice($argv, 2, $argc - 2);
} else {
  exit('Error: invalid arguments!');
}

// OCM Helper
require_once(dirname(__file__) . '/helper/ocmodify.php');

// Detect working directory
$parts = explode('/', $path);
$route = end($parts);
if (count($parts) > 1) {
  $directory = dirname(__file__) . '/../../' . $parts[0] . '/';
} else {
  $directory = dirname(__file__) . '/../../';
}

// Load config
if (is_file($directory . '/config.php')) {
  require_once($directory . '/config.php');
}

// Check nstall
if (!defined('DIR_APPLICATION')) {
  exit('OpenCart not installed!');
}

// Error handler
function ocmCronErrorHandler($errno, $errstr, $errfile, $errline) {
  switch ($errno) {
    case E_NOTICE:
    case E_USER_NOTICE:
      $error = 'Notice';
      break;
    case E_WARNING:
    case E_USER_WARNING:
      $error = 'Warning';
      break;
    case E_ERROR:
    case E_USER_ERROR:
      $error = 'Fatal Error';
      break;
    default:
      $error = 'Unknown';
      break;
  }

  file_put_contents(DIR_LOGS . 'error.log', date('Y-m-d G:i:s') . ' - ' . 'PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline . "\n", FILE_APPEND);

  return true;
}

// Register error handler
set_error_handler('ocmCronErrorHandler');

// Parse OpenCart version
$index = file_get_contents($directory . '/index.php');
if (preg_match('#define\(\'VERSION\',\s+\'(.*)\'\);#i', $index, $matches)) {
  define('VERSION', $matches[1]);
} else {
  exit('OpenCart version detection failed!');
}

// Set server vars
$_SERVER['SERVER_PORT'] = 80;
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['REQUEST_METHOD'] = 'GET';

// Loading OpenCart engine
require_once(DIR_SYSTEM . 'startup.php');

// OpenCart core classes
if (version_compare(VERSION, '2.2', '>=')) {
  require_once(DIR_SYSTEM . 'library/cart/user.php');
  require_once(DIR_SYSTEM . 'library/cart/customer.php');
} else {
  require_once(DIR_SYSTEM . 'library/user.php');
  require_once(DIR_SYSTEM . 'library/customer.php');
}

// Loading OcModify engine
require_once(DIR_SYSTEM . 'ocmodify/startup.php');

// Registry
$registry = new Registry();

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, defined('DB_PORT') ? DB_PORT : 3306);
$registry->set('db', $db);

// Config
$config = new Config($registry);
$registry->set('config', $config);

// Cache
$cache = new Cache('file');
$registry->set('cache', $cache);

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response);

// Session
$session = new Session();
$registry->set('session', $session);

// Cache
$cache = new Cache('file', 3600);
$registry->set('cache', $cache);

// URL
$url = new Url(HTTP_SERVER, HTTPS_SERVER);
$registry->set('url', $url);

// Language
$language = new Language(version_compare(VERSION, '2.3', '>=') ? '' : 'english');
$registry->set('language', $language);

// Document
$registry->set('document', new Document());

// Event
if (version_compare(VERSION, '2', '>=')) {
  $event = new Event($registry);
  $registry->set('event', $event);
}

// Loader
$registry->set('load', new Loader($registry));

// User and customer
if (version_compare(VERSION, '2.2', '>=')) {
  $user = new \Cart\User($registry);
  $customer = new \Cart\Customer($registry);
} else {
  $user = new User($registry);
  $customer = new Customer($registry);
}
$registry->set('user', $user);
$registry->set('customer', $customer);

// OCM
$ocmodify = ocmStartup($registry);

// Shutdown function
function shutdown($ocmodify, $route) {
  echo "Cron job \"$route\" successfully executed...\n";
  $ocmodify->config->save($route, 'executed', time());
}

// Register shutdown
register_shutdown_function('shutdown', $ocmodify, $route);

// Execute cron
require_once(OCM_DIR . 'classes/cron/' . $route . '.php');

$class = preg_replace('/[^a-zA-Z0-9]/', '', $route) . 'Cron';
$cron = new $class($ocmodify);
$cron->execute($args, (int)$ocmodify->config->get($route . '_executed'));

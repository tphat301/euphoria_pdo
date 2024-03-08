<?php
ob_start();
session_start();
$coreFileNames = ['Configurations', 'Functions', 'Share', 'Database', 'Routers', 'ErrorReporting', 'Models', 'Controllers', 'Sitemap', 'Flash', 'Cart', 'Mail', 'Validate', 'Payment'];
/* Handle import all file core */
if (is_array($coreFileNames) && !empty($coreFileNames)) {
  foreach ($coreFileNames as $coreFileName) {
    $path = dirname(__FILE__) . '/core/' . $coreFileName . '.php';
    if (file_exists($path)) {
      require($path);
    }
  }
}

if (file_exists('vendor/autoload.php')) {
  require('vendor/autoload.php');
}

/* Setting Error Reporting */
if (Configurations::configurationsBase()['error-reporting'] === true) {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  set_error_handler('errorReporting');
} else {
  error_reporting(0);
}

require_once("app/routers/Web.php");
Web::init();
$d = new Database();

<?php
session_start();

// var_dump($_SESSION);

require_once('config.php');
require_once('connection.php');
require_once('models/router.php');
require_once('models/user.php');


$conn = Database::getInstance($configs);
$router = Router::getInstance($configs);
$uris = $router->parse($_SERVER['REQUEST_URI']);

if (isset($uris) && !empty($uris) && count($uris) == 2) {
  $controller = $uris[0];
  $action     = $uris[1];
} else if (isset($uris) && !empty($uris) && count($uris) == 1) {
  $controller = $uris[0];
  $action = 'index';
}else{
  $controller = 'home';
  $action     = 'index';
}

require_once('views/layout.php');
?>
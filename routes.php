<?php

// Entries for the controllers and its actions
$controllers = array(
  'admin' => ['index', 'show'],
  'login' => ['index', 'auth', 'logout'],
  'home' => ['index', 'show'],
  'pages' => ['error']
);

if (array_key_exists($controller, $controllers)) {
  if (in_array($action, $controllers[$controller])) {

    // Administrator route control
    if ($controller === 'admin' && !(isset($_SESSION['username']) && $_SESSION['isAdmin'])) {
      header('Location:home');
      die();
    }

    // Administrator login forward to admin panel if logged in
    if ($controller === 'login' && isset($_SESSION['username']) && $_SESSION['isAdmin']) {
      header('Location:admin');
      die();
    }

    call($controller, $action);
  } else {
    call('pages', 'error');
  }
} else {
  call('pages', 'error');
}

function call($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');

  // General routes
  switch($controller) {
    case 'home':
    require_once('models/home.php');
    $controller = new HomeController();
    break;
    case 'pages':
    $controller = new PagesController();
    break;
    case 'login':
    require_once('models/utils.php');
    $controller = new LoginController();
    break;
    case 'admin':
    require_once('models/admin.php');
    $controller = new AdminController();
    break;
  }
  $controller->{ $action }();
}
?>
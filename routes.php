<?php


function call($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');
  require_once('models/user.php');

  // General routes
  switch($controller) {
    case 'home':
    // we need the model to query the database later in the controller
    require_once('models/home.php');
    $controller = new HomeController();
    break;
    case 'pages':
    $controller = new PagesController();
    break;
    default:
    $controller = new HomeController();
    $action = 'index';
    break;
  }

  // Admin routes
  if (isset($user) && $user->isAdmin()) {
    switch($controller) {
      case 'admin':
      require_once('models/admin.php');
      $controller = new AdminController();
      break;
    }
  }
  $controller->{ $action }();
}

  // we're adding an entry for the new controller and its actions
$controllers = array( 'admin' => ['index', 'show'],
  'login' => ['index'],
  'home' => ['index', 'show'],
  'pages' => ['login', 'error']);

if (array_key_exists($controller, $controllers)) {
  if (in_array($action, $controllers[$controller])) {
    call($controller, $action);
  } else {
    call('pages', 'error');
  }
} else {
  call('pages', 'error');
}
?>
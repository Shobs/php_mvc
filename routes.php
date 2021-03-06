<?php
/**
 * Routing file
 * breaks down the uri into components and redirect
 * with the following logic:
 * first element is the controller to be called.
 * second element is the method from the controller.
 */
require_once('models/utils.php');
// Entries for the controllers and its actions
$controllers = array(
  'admin' => ['index', 'all', 'add', 'delete', 'show'],
  'login' => ['index', 'auth', 'logout'],
  'home' => ['index', 'upload'],
  'pages' => ['error']
);


if (array_key_exists($controller, $controllers)) {
  if (in_array($action, $controllers[$controller])) {

    // Administrator route control
    if ($controller === 'admin'){
      if (!isSessionValid()) {
        header('Location:home');
        die();
      }
    }

    // Administrator login forward to admin panel if logged in
    if ($controller === 'login' && $action !== 'logout') {
      if (isSessionValid()) {
        header('Location:admin');
        die();
      }
    }

    call($controller, $action);
  } else {
    call('pages', 'error');
  }
} else {
  call('pages', 'error');
}

/**
 * Calls desired controller, autoloads the required models
 * and finally calls desired method
 * @param  String $controller requested controller
 * @param  String $action     requested method
 * @return String             Html page or request
 */
function call($controller, $action) {
  require_once('controllers/' . $controller . '_controller.php');
  require_once('models/utils.php');
  // General routes
  switch($controller) {
    case 'home':
    require_once('models/malware.php');
    $controller = new HomeController();
    break;
    case 'pages':
    $controller = new PagesController();
    break;
    case 'login':
    $controller = new LoginController();
    break;
    case 'admin':
    require_once('models/malware.php');
    $controller = new AdminController();
    break;
  }
  $controller->{ $action }();
}

/**
 * Verify validity of session and prevents session fixation
 * @return boolean
 */
function isSessionValid(){
  // checking if check session is set
  if (!isset($_SESSION['check']) || empty($_SESSION['check'])) {
    return false;
  }

  // prevents session fixation
  if ($_SESSION['check'] != hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'])){
    Utils::destroySessionAndData();
    return false;
  }

  // finally checking username and role
  if (!isset($_SESSION['username']) || !$_SESSION['isAdmin']) {
    return false;
  }

  // prevents session fixation
  if (!isset($_SESSION['initiated']))
  {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
  }

  return true;
}
?>
<?php
include_once 'templates/header.php';

require_once('routes.php');

/*** START DEBUGGIN AREA ***/
// echo '<pre/> Debug:';
// print_r($router->parse($_SERVER['REQUEST_URI']));

// echo $router->segment(2);

// $user = User::findByEmail('jean.marcellin@sjsu.edu');

// echo $user->isAdmin();

/*** END DEBUGGIN AREA ***/

include_once 'templates/footer.php';
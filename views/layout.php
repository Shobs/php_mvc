<?php
include_once 'templates/header.php';

require_once('routes.php');

// $db = Database::getInstance($configs);
$router = Router::getInstance($configs);
echo '<pre/>';
print_r($router->parse($_SERVER['REQUEST_URI']));

echo $router->segment(2);

include_once 'templates/footer.php';
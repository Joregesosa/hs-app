<?php

use Bramus\Router\Router;
use App\Config\DB;

$router = new Router();

DB::initialize();

$router->before('POST|PUT', '/.*', function () {
    $body = file_get_contents('php://input');
    $body = json_decode($body, true);
    $_POST = $body;
});

$router->before('GET|POST|PUT|DELETE', '/.*', function () {
    header('Content-Type: application/json');
});

require 'src/Modules/User/Router.php';
require 'src/Modules/Role/Router.php';
require 'src/Modules/School/Router.php';
require 'src/Modules/Country/Router.php';
require 'src/Modules/Category/Router.php';
require 'src/Modules/Service/Router.php';

$router->run();

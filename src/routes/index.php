<?php

use Bramus\Router\Router;
use App\Config\DB;
use App\Middlewares\VerifyToken;

$router = new Router();

DB::initialize();

$router->options('/.*', function() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit;
});

$router->before('GET|POST|PUT|DELETE', '/.*', function () {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
});

$router->before('POST|PUT', '/.*', function () {
    $body = file_get_contents('php://input');
    $body = json_decode($body, true);
    $_POST = $body;
});

// Middleware to verify token for all routes except auth routes
$router->before('GET|POST|PUT|DELETE', '/(?!auth).*', function () {
    VerifyToken::handle();
});

require 'src/Modules/Auth/Router.php';
require 'src/Modules/User/Router.php';
require 'src/Modules/Role/Router.php';
require 'src/Modules/School/Router.php';
require 'src/Modules/Country/Router.php';
require 'src/Modules/Category/Router.php';
require 'src/Modules/Service/Router.php';

$router->run();

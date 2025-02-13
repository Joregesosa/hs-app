<?php

use App\Modules\Goal\Controller;

$router->get('/goals', Controller::class . '@index');
$router->get('/report', Controller::class . '@report');
$router->get('/report/{id}', Controller::class . '@report');
$router->post('/goals', Controller::class . '@store');
$router->put('/goals/{id}', Controller::class . '@update');
$router->delete('/goals/{id}', Controller::class . '@destroy');
$router->get('/compasses', Controller::class . '@listcompasses');

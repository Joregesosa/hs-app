<?php

use App\Modules\Service\Controller;


$router->get('/services', Controller::class . '@index');
$router->get('/services/{id}', Controller::class . '@show');
$router->get('/evidence/{id}',  Controller::class . '@evidence');
$router->post('/services', Controller::class . '@store');
$router->patch('/services/{id}', Controller::class . '@update');
$router->patch('/review/{id}', Controller::class . '@review');
$router->delete('/services/{id}', Controller::class . '@destroy');


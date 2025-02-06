<?php

use App\Modules\Service\Controller;


$router->get('/services', Controller::class . '@index');
$router->get('/services/{id}', Controller::class . '@show');
$router->get('/evidence/{id}',  Controller::class . '@evidence');
$router->post('/services', Controller::class . '@store');
$router->put('/services/{id}', Controller::class . '@update');
$router->delete('/services/{id}', Controller::class . '@destroy');


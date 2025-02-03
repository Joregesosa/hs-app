<?php

use App\Modules\User\Controller;


$router->get('/users', Controller::class . '@index');
$router->get('/users/{id}', Controller::class . '@show');
$router->post('/users', Controller::class . '@store');
$router->put('/users/{id}', Controller::class . '@update');
$router->delete('/users/{id}', Controller::class . '@destroy');
<?php

use App\Modules\Auth\Controller;


$router->post('/auth/login', Controller::class . '@login');
// $router->get('/users/{id}', Controller::class . '@show');
// $router->post('/users', Controller::class . '@store');
// $router->put('/users/{id}', Controller::class . '@update');
// $router->delete('/users/{id}', Controller::class . '@destroy');

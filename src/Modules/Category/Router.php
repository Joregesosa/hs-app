<?php

use App\Modules\Category\Controller;


$router->get('/categories', Controller::class . '@index');
$router->get('/categories/{id}', Controller::class . '@show');
$router->post('/categories', Controller::class . '@store');
$router->put('/categories/{id}', Controller::class . '@update');
$router->delete('/categories/{id}', Controller::class . '@destroy');

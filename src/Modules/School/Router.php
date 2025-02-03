<?php

use App\Modules\School\Controller;


$router->get('/schools', Controller::class . '@index');
$router->get('/schools/{id}', Controller::class . '@show');
$router->post('/schools', Controller::class . '@store');
$router->put('/schools/{id}', Controller::class . '@update');
$router->delete('/schools/{id}', Controller::class . '@destroy');
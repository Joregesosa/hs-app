<?php

use App\Modules\Auth\Controller;


$router->post('/auth/login', Controller::class . '@login');
$router->post('/auth/logout', Controller::class . '@logout');
$router->get('/auth/profile', Controller::class . '@profile');
$router->put('/auth/change-password', Controller::class . '@updatePassword');
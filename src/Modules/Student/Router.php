<?php

use App\Modules\Student\Controller;

$router->get('/students', Controller::class . '@index');
$router->get('/students/{id}', Controller::class . '@show');
 

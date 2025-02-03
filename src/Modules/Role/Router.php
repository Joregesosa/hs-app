<?php

use App\Modules\Role\Controller;


$router->get('/roles', Controller::class . '@index');
$router->get('/roles/{id}', Controller::class . '@show');
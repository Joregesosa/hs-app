<?php

use App\Modules\GoalCategory\Controller;

$router->get('/goal-categories', Controller::class . '@index');
$router->get('/goal-categories/{id}', Controller::class . '@show');

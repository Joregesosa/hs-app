<?php

use App\Modules\GoalSubcategory\Controller;


$router->get('/goal-categories/{id}', Controller::class . '@index');
$router->get('/goal-categories/{s_id}/id', Controller::class . '@show');

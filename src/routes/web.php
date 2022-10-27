<?php

/** @var Router $router */

use Illuminate\Support\Facades\Route;
use Laravel\Lumen\Routing\Router;

$router->get('my-achievements', 'AchievmentController@myAcheivement');

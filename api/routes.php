<?php

use app\Controllers\GetLocationController;
use app\Router;

$route = new Router();
$route->post('/api/search', [GetLocationController::class, 'searchByAddress']);

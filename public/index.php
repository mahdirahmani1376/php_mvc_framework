<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\SiteController;
use App\Core\Application;
$app = new Application(__DIR__.'/../');

$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact','contact');
$app->router->post('/contact',[SiteController::class,'handleContact']);

$app->run();
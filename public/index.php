<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";

    die();
}

$app = new Application(__DIR__.'/../');

$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact','contact');
$app->router->post('/contact',[SiteController::class,'contact']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);

//$app->router->post('/contact',function (){
//	return 'handling submitted data';
//});

$app->run();
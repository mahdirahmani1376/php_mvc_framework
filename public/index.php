<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\SiteController;
use App\Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(__DIR__.'/../',$config);

function dd(...$params)
{
    foreach ($params as $param){
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    }
    die();
}



$app->router->get('/',[SiteController::class,'home']);
$app->router->get('/contact','contact');
$app->router->post('/contact',[SiteController::class,'handleContact']);

$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->run();
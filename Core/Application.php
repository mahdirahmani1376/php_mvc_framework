<?php

namespace App\Core;
class Application
{
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    public function __construct(
        string $rootPath
    )
    {
        self::$ROOT_DIR = $rootPath;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request,$this->response);
        self::$app = $this;
    }

    public function run()
    {
        $this->router->resolve();
    }
}
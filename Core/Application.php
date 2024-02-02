<?php

namespace App\Core;
class Application
{
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public static Application $app;
    public Session $session;

    public function __construct(
        string $rootPath,
        array $config
    )
    {
        self::$ROOT_DIR = $rootPath;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request,$this->response);
        $this->db = new Database($config['db']);
        $this->session = new Session();
        self::$app = $this;
    }

    public function run()
    {
        $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
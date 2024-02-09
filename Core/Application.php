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
    public string $userClass;
    public Session $session;
    public ?DbModel $user;

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
        $this->userClass = $config['userClass'];

        /** @var DbModel $primaryValue */
        $primaryValue = $this->session->get('user');
        if ($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
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

    public function isGuest()
    {
        return ! self::$app->user;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
}
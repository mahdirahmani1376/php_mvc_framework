<?php

namespace App\Core;
class Router
{

    public function __construct(
        public Request $request,
        public Response $response
    )
    {
    }

    protected array $routes = [];
    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path,$callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (! $callback){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }

        if (is_array($callback)){
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback);
    }

    public function renderView(string $view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "views/layouts/main.php";
        return ob_get_clean();

    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}',$viewContent,$layoutContent);
    }

    protected function renderOnlyView($view,$params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "views/$view.php";
        return ob_get_clean();
    }
}
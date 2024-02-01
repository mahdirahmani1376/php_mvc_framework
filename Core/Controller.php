<?php

namespace App\Core;

class Controller
{
    public string $layout='main';
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}
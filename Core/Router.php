<?php

namespace App\Core;
class Router
{
    protected array $routes = [];
    public function get($path,$callback)
    {
        $this->routes['get'][$path] = $callback;
    }
}
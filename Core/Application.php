<?php

namespace App\Core;
class Application
{
    public function __construct(
        public Router $router
    )
    {
    }
}
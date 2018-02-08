<?php

namespace Mvc\Core;

use Mvc\Core\Routing\Router;

class App
{
    public function run()
    {
        $router = new Router();
        $router->handleRequest();
    }
}
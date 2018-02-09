<?php

namespace Mvc\Core\Routing;

use Mvc\App\Controllers;


class Router
{
    const CONTROLLERS_NAMESPACE = 'Mvc\\App\\Controllers\\';
    const PAGE_NOT_FOUND_CONTROLLER = 'Mvc\\Core\\Errors\\PageNotFound';

    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    public function handleRequest()
    {

        $pathTree = $this->helper->getPathTree();
        if(isset($pathTree[0]) && $pathTree[0] !== ''){
            if(isset($pathTree[1]) && $pathTree[1] !== ''){
                $controllerClass =  self::CONTROLLERS_NAMESPACE .ucfirst(strtolower($pathTree[0])).'\\'.ucfirst(strtolower($pathTree[1]));
            }else{
                $controllerClass =  self::CONTROLLERS_NAMESPACE.ucfirst(strtolower($pathTree[0])).'\\Index';
            }
        }else{
            $controllerClass =  self::CONTROLLERS_NAMESPACE .'Index\\Index';
        }
        if (!$this->helper->validateControllerClass($controllerClass)) {
            $controllerClass = self::PAGE_NOT_FOUND_CONTROLLER;
        }

        $controller = new $controllerClass();
        $controller->action();
    }
}

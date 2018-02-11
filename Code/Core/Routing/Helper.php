<?php

namespace Mvc\Core\Routing;

class Helper
{

    const VIEWS_NAMESPACE = 'Mvc\\App\\Views\\';
    const CONTROLLERS_NAMESPACE = 'Mvc\\App\\Controllers\\';


    public function getPathTree()
    {
        return explode('/', $this->getPath());
    }

    public function getPath()
    {
        $requestUri = $this->getRequestUri();
        $end =  (mb_strpos($requestUri, '?') !== false)  ? mb_strpos($requestUri, '?')-1 : null;
        return mb_substr($requestUri, 1, $end);

    }

    public function getParams()
    {
        $requestUri = $this->getRequestUri();
        if(mb_strpos($requestUri, '?') === false) {
            return [];
        }
        $paramsString = mb_substr($requestUri,  mb_strpos($requestUri, '?')+1);
        $params = explode('&', $paramsString);
        $paramsArray = [];
        foreach ($params as $param) {
            $key = mb_substr($param, 0, mb_strpos($param, '='));
            $value = mb_substr($param, mb_strpos($param, '=')+1);
            $paramsArray[$key] = $value;
        }

        return $paramsArray;
    }

    public function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }


    public function validateControllerClass($class)
    {
        return class_exists($class) && method_exists($class, 'action');
    }

    public function getConfig()
    {
        $rawConfig = file_get_contents(__DIR__ . '/../../../config/controllers.json');
        return json_decode($rawConfig);
    }

    public function getControllerAlias($controller)
    {
        $controllerPath = explode('\\', get_class($controller));
        if(!isset($controllerPath[3]) || !isset($controllerPath[4]))
        {
            return '';
        }

        return strtolower($controllerPath[3]) .'/'.strtolower($controllerPath[4]);
    }
}
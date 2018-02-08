<?php

namespace Mvc\Core\Routing;

class Helper
{

    public function getPathTree()
    {
        return explode('/', $this->getPath());
    }

    public function getPath()
    {
        $requestUri = $this->getRequestUri();
        return mb_substr($requestUri, 1, mb_strpos($requestUri, '?')-1);

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
}
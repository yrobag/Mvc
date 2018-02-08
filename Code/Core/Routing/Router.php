<?php

namespace Mvc\Core\Routing;

use Mvc\Core\Routing\Helper;

class Router
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper();
    }

    public function handleRequest()
    {
        var_dump($this->helper->getPathTree());
        var_dump($this->helper->getParams());die;
    }
}

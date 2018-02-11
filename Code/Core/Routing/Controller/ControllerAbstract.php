<?php

namespace Mvc\Core\Routing\Controller;

use Mvc\App\Controllers;
use Mvc\Core\Routing\Helper;
use Mvc\Core\Views\View\ViewAbstract;


abstract class ControllerAbstract
{
    protected $view;

    protected $controllersHelper;

    public function __construct()
    {
        $this->controllersHelper = new Helper();
        $this->setViewFromConfig();
    }

    public function renderView()
    {
        if($this->view instanceof ViewAbstract){
            $this->view->render();
        }
    }

    protected function setViewFromConfig()
    {
        $config = $this->controllersHelper->getConfig();
        $controllerAlias = $this->controllersHelper->getControllerAlias($this);
        if (property_exists($config, $controllerAlias) && property_exists($config->{$controllerAlias}, 'view')) {
            $this->setView($config->{$controllerAlias}->view);
            if (property_exists($config->{$controllerAlias}, 'template')) {
               $this->view->setTemplate($config->{$controllerAlias}->template);
            }
        }
    }

    protected function setView($viewName)
    {
        $viewClass = $this->controllersHelper::VIEWS_NAMESPACE . ucfirst(strtolower($viewName));
        $this->view = new $viewClass();

        return $this;
    }

}
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
               $static = $this->getStatic($controllerAlias);
               $useDefault = $this->checkIfUseDefaults($controllerAlias);
                if($useDefault){
                   $defaultStatic = $this->getStatic();

                   $static = [
                       'js' => array_merge($static['js'], $defaultStatic['js']),
                       'css'=> array_merge($static['css'], $defaultStatic['css'])
                   ];
               }
               $this->view->setStatic($static);

               $customHeader = $this->getCustom($controllerAlias, 'header');
               $customFooter = $this->getCustom($controllerAlias, 'footer');

               $header = ($useDefault && !$customHeader) ? $config->defaults->header : $customHeader;
               $footer = ($useDefault && !$customFooter) ? $config->defaults->footer : $customFooter;

               $this->view->setHeader($header);
               $this->view->setFooter($footer);
            }
        }
    }

    protected function setView($viewName)
    {
        $namespacePath = [];
        foreach (explode('/',$viewName) as $value) {
            $namespacePath[] = ucfirst(strtolower($value));
        }
        $className = implode('\\', $namespacePath);
        $viewClass = $this->controllersHelper::VIEWS_NAMESPACE . $className;
        $this->view = new $viewClass();

        return $this;
    }

    protected function getCustom($controllerAlias, $property)
    {
        $config = $this->controllersHelper->getConfig();
        if(property_exists($config->{$controllerAlias}, $property)){
            return $config->{$controllerAlias}->{$property};
        }

        return false;
    }

    protected function checkIfUseDefaults($controllerAlias)
    {
        $config = $this->controllersHelper->getConfig();
        return !property_exists($config->{$controllerAlias}, 'defaults') || !$config->{$controllerAlias}->defaults === false;
    }

    protected function getStatic($controllerAlias = 'defaults')
    {
        $config = $this->controllersHelper->getConfig();
        $css = [];
        if(property_exists($config->{$controllerAlias}, 'css') && is_array($config->{$controllerAlias}->css)){
            $css = $config->{$controllerAlias}->css;
        }
        $js = [];
        if(property_exists($config->{$controllerAlias}, 'js') && is_array($config->{$controllerAlias}->css)){
            $js = $config->{$controllerAlias}->js;
        }

        return [
            'css' => $css,
            'js' => $js,
        ];
    }



}
<?php

namespace Mvc\Core\Views\View;

use Mvc\Core\Views\Helper;


abstract class ViewAbstract
{
    protected $viewsHelper;

    protected $header;

    protected $footer;

    protected $template;

    protected $static;

    public function __construct()
    {
        $this->viewsHelper = new Helper();
    }


    public function render()
    {
        $templateFile = $this->viewsHelper->getTemplateFile($this->template);

        if($templateFile){
            $this->initHtml();
            $this->renderHead();
            $this->initBody();
            $this->renderHeader();
            include $templateFile;
            $this->renderFooter();
            $this->endHtml();
        }

    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function setStatic($static)
    {
        $this->static = $static;

        return $this;
    }


    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    public function getStatic()
    {
        return $this->static;
    }


    private function renderHead()
    {
        $static = $this->getStatic();
        $css = '';
        foreach ($static['css'] as $cssFile){
            $css .= '<link rel="stylesheet" type="text/css" href="/public/css/'.$cssFile.'">';
        }
        $js = '';
        foreach ($static['js'] as $jsFile){
            $js .= '<script src="/public/js/'.$jsFile.'"></script>';
        }
        echo "<head> $css $js </head>";
    }

    private function renderHeader()
    {
        $templateFile = $this->viewsHelper->getTemplateFile($this->header);
        if($templateFile){
            include $templateFile;
        }
    }

    private function renderFooter()
    {
        $templateFile = $this->viewsHelper->getTemplateFile($this->footer);

        if($templateFile){
            include $templateFile;
        }
    }


    private function initHtml()
    {
        echo '<!doctype html><html>';
    }
    private function initBody()
    {
        echo '<body>';
    }
    private function endHtml()
    {
        echo '</body></html>';
    }


}
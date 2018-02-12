<?php

namespace Mvc\Core\Views\View;

use Mvc\Core\Views\Helper;


abstract class ViewAbstract
{
    protected $viewsHelper;

    protected $template;

    protected $static;

    public function __construct()
    {
        $this->viewsHelper = new Helper();
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

    public function render()
    {
        $templateFile = $this->viewsHelper->getTemplateFile($this->template);


        if (!(file_exists($templateFile) && is_file($templateFile))) {
            throw new \Exception('Wrong template file!');
        }

        include $templateFile;
    }


}
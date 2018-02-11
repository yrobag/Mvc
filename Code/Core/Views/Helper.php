<?php

namespace Mvc\Core\Views;

class Helper
{

    public function getTemplateFile($template)
    {
        return  __DIR__ . '/../../../design/templates/' .$template;
    }

}
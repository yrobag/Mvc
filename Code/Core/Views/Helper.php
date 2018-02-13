<?php

namespace Mvc\Core\Views;

class Helper
{

    public function getTemplateFile($template)
    {
        if(!$template){
            return false;
        }

        $templateFile = __DIR__ . '/../../../design/templates/' .$template;

        if (!(file_exists($templateFile) && is_file($templateFile))) {
            throw new \Exception('Wrong template file!');
        }

        return $templateFile;
    }

}
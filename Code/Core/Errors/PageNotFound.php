<?php

namespace Mvc\Core\Errors;


class PageNotFound
{
    public function action()
    {
        var_dump('404: Page Not Found');die;
    }
}
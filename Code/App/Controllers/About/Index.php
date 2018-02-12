<?php

namespace Mvc\App\Controllers\About;

use Mvc\Core\Routing\Controller\ControllerAbstract;


class Index extends ControllerAbstract
{
    public function action()
    {
        $this->renderView();
    }
}
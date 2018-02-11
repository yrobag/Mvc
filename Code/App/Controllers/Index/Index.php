<?php

namespace Mvc\App\Controllers\Index;

use Mvc\Core\Routing\Controller\ControllerAbstract;


class Index extends ControllerAbstract
{
    public function action()
    {
        $this->renderView();
    }
}
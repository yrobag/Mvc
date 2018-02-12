<?php
require __DIR__ . '/vendor/autoload.php';

$app = new Mvc\Core\App();

try{
    $app->run();
}catch (Exception $exception) {
    echo $exception->getMessage();
}

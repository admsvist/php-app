<?php

namespace App\Controllers;

use App\Registry;

class Controller
{
    private Registry $reg;

    private function __construct()
    {
        $this->reg = Registry::instance();
    }

    public static function run(): void
    {
        $instance = new self();
        $instance->init();
        $instance->handleRequest();
    }

    public function init(): void
    {
        $this->reg->getApplicationHelper()->init();
    }

    public function handleRequest(): void
    {
        $request = $this->reg->getRequest();
        $controller = new AppController();
        $cmd = $controller->getCommand($request);
        $cmd->execute($request);
        $view = $controller->getView($request);
        $view->render($request);
    }
}
<?php

namespace App;

use App\Commands\CommandResolver;

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
        $resolver = new CommandResolver();
        $cmd = $resolver->getCommand($request);
        $cmd->execute($request);
    }
}
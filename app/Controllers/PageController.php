<?php

namespace App\Controllers;

use App\Registry;
use App\Requests\CliRequest;
use App\Requests\HttpRequest;
use App\Requests\Request;

abstract class PageController
{
    private Registry $reg;

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    abstract public function process(): void;

    public function init(): void
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $request = new HttpRequest();
        } else {
            $request = new CliRequest();
        }
        $this->reg->setRequest($request);
    }

    public function forward(string $resource): void
    {
        $request = $this->getRequest();
        $request->forward($resource);
    }

    public function render(string $resource, Request $request): void
    {
        include($resource);
    }

    public function getRequest(): Request
    {
        return $this->reg->getRequest();
    }
}
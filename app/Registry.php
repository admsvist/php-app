<?php

namespace App;

use app\Requests\Request;

class Registry
{
    private static ?Registry $instance = null;
    private ?Request $request = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function reset()
    {
        // TODO сброс состояния
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            throw new \Exception("Request не установлен");
        }

        return $this->request;
    }
}
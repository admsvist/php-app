<?php

namespace App\Requests;

class HttpRequest extends Request
{
    public function init(): void
    {
        $this->properties = $_REQUEST;
        $this->path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public function forward(string $path): void
    {
        header("Location: $path");
        exit;
    }
}
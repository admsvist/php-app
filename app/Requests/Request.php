<?php

namespace App\Requests;

abstract class Request
{
    protected array $properties = [];
    protected array $feedback = [];
    protected string $path = '/';

    public function __construct()
    {
        $this->init();
    }

    abstract public function init(): void;

    public function getProperty(string $key): mixed
    {
        if(isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    public function setProperty(string $key, mixed $val): void
    {
        $this->properties[$key] = $val;
    }

    public function getFeedbackString($separator = '\n'): string
    {
        return implode($separator, $this->feedback);
    }

    public function addFeedback(string $msg): void
    {
        $this->feedback[] = $msg;
    }

    abstract public function forward(string $path): void;
}
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

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getProperties(string $key): mixed
    {
        if(isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    public function setProperties(string $key, mixed $val): void
    {
        $this->properties[$key] = $val;
    }

    public function getFeedback(): array
    {
        return $this->feedback;
    }

    public function getFeedbackString($separator = '\n'): string
    {
        return implode($separator, $this->feedback);
    }

    public function addFeedback(string $msg): void
    {
        $this->feedback[] = $msg;
    }

    public function clearFeedback(): void
    {
        $this->feedback = [];
    }
}
<?php

namespace App\Requests;

use App\Commands\Command;

abstract class Request
{
    protected array $properties = [];
    protected array $feedback = [];
    protected string $path = '/';
    protected int $status = 0;

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

    abstract public function forward(string $path): void;

    public function setCmdStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCmdStatus(): int
    {
        return $this->status;
    }
}
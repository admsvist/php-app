<?php

namespace App\Requests;

use App\Registry;

class CliRequest extends Request
{
    public function init(): void
    {
        $args = $_SERVER['argv'];
        foreach ($args as $arg) {
            if (preg_match("/^path:(\S+)/", $arg, $matches)) {
                $this->path = $matches[1];
            } else {
                if (strpos($arg, '=')) {
                    list($key, $val) = explode('=', $arg);
                    $this->setProperty($key, $val);
                }
            }
        }
        $this->path = empty($this->path) ? '/' : $this->path;
    }

    public function forward(string $path): void
    {
        // Добавляет новый путь в конец аргументов,
        // Где преимущество получает последний аргумент
        $_SERVER['argv'][] = "path:$path";
        Registry::reset();
    }
}
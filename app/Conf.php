<?php

namespace App;

class Conf
{
    public function __construct(protected array $properties = [])
    {
    }

    public function get(string $key): mixed
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    public function set(string $path, ComponentDescriptor $pathobj)
    {
        $this->properties[$path] = $pathobj;
    }
}
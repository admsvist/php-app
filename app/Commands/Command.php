<?php

namespace App\Commands;

use App\Requests\Request;

abstract class Command
{
    final function __construct()
    {
    }

    public function execute(Request $request): void
    {
        $this->doExecute($request);
    }

    abstract protected function doExecute(Request $request): void;
}
<?php

namespace App\Commands;

use App\Requests\Request;

class DefaultCommand extends Command
{
    protected function doExecute(Request $request): int
    {
         return self::CMD_DEFAULT;
    }
}
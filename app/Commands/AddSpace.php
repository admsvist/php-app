<?php

namespace App\Commands;

use App\Requests\Request;

class AddSpace extends Command
{
    protected function doExecute(Request $request): int
    {
         return self::CMD_DEFAULT;
    }
}
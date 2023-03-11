<?php

namespace App\Commands;

use App\Requests\Request;

class ListVenues extends Command
{
    protected function doExecute(Request $request): int
    {
         return self::CMD_DEFAULT;
    }
}
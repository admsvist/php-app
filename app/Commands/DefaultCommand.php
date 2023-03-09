<?php

namespace App\Commands;

use App\Requests\Request;

class DefaultCommand extends Command
{
    protected function doExecute(Request $request): void
    {
        $request->addFeedback("Command not found");
        include(__DIR__ . '/../Views/404.php');
    }
}
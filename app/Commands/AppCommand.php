<?php

namespace App\Commands;

use App\Requests\Request;

class AppCommand extends Command
{
    protected function doExecute(Request $request): void
    {
        $request->addFeedback("Welcome to App");
        include(__DIR__ . '/../Views/main.php');
    }
}
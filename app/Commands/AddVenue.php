<?php

namespace App\Commands;

use App\Requests\Request;

class AddVenue extends Command
{
    protected function doExecute(Request $request): int
    {
        $name = $request->getProperty("venue_name");
        if (is_null($name)) {
            $request->addFeedback("Имя не предоставлено");
            return self::CMD_INSUFFICIENT_DATA;
        } else {
            // Некоторые действия
            $request->addFeedback("'$name' added");
            return self::CMD_OK;
        }
        // return self::CMD_DEFAULT;
    }
}
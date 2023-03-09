<?php

namespace App\Commands;

use App\Registry;
use App\Requests\Request;

class CommandResolver
{
    private static ?\ReflectionClass $refcmd = null;
    private static string $defaultCmd = DefaultCommand::class;

    public function __construct()
    {
        self::$refcmd = new \ReflectionClass(Command::class);
    }

    public function getCommand(Request $request): Command
    {
        $reg = Registry::instance();
        $commands = $reg->getCommands();
        $path = $request->getPath();
        $class = $commands->get($path);

        if (is_null($class)) {
            $request->addFeedback("Путь '$path' не годится");
            return new self::$defaultCmd();
        }
        if (!class_exists($class)) {
            $request->addFeedback("Класс '$path' не найден");
            return new self::$defaultCmd();
        }
        $refclass = new \ReflectionClass($class);
        if (!$refclass->isSubclassOf(self::$refcmd)) {
            $request->addFeedback("Команда '$refclass' не является Command");
            return new self::$defaultCmd();
        }
        return $refclass->newInstance();
    }
}
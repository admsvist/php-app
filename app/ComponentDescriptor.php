<?php

namespace App;

use App\Commands\Command;
use App\Requests\Request;
use App\Views\ViewComponent;

class ComponentDescriptor
{
    private array $views = [];

    public function __construct(
        private string $path,
        private string $cmdstr
    )
    {
    }

    public function getCommand(): Command
    {
        $class = $this->cmdstr;
        if (is_null($class)) {
            throw new \Exception("Неизвестный класс '$class'");
        }
        if (!class_exists($class)) {
            throw new \Exception("Класс '$class' не найден");
        }

        $refclass = new \ReflectionClass($class);
        if (!$refclass->isSubclassOf(Command::class)) {
            throw new \Exception("'$class' не является Command");
        }

        return $refclass->newInstance();
    }

    public function setView(int $status, ViewComponent $view): void
    {
        $this->views[$status] = $view;
    }

    public function getView(Request $request): ViewComponent
    {
        $status = $request->getCmdStatus();
        $status = is_null($status) ? 0 : $status;
        if (isset($this->views[$status])) {
            return $this->views[$status];
        }
        if (isset($this->views[0])) {
            return $this->views[0];
        }
        throw new \Exception('No View found');
    }
}
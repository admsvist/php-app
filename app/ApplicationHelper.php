<?php

namespace App;

use App\Requests\CliRequest;
use App\Requests\HttpRequest;
use App\Views\ViewComponentCompiler;

class ApplicationHelper
{
    private string $config = __DIR__ . "/../config.ini";
    private string $routes = __DIR__ . "/../routes.xml";
    private Registry $reg;

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    public function init(): void
    {
        $this->setupOptions();

        if (defined('STDIN')) {
            $request = new CliRequest();
        } else {
            $request = new HttpRequest();
        }

        $this->reg->setRequest($request);
    }

    private function setupOptions(): void
    {
        $this->setConfig();
        $this->setCommands();
    }

    private function setConfig(): void
    {
        if (!file_exists($this->config)) {
            throw new \Exception("Неизвестный фаил конфигурации $this->config'");
        }

        $options = parse_ini_file($this->config, true);
        $this->reg->setConf(new Conf($options['config']));
    }

    private function setCommands(): void
    {
        if (!file_exists($this->routes)) {
            throw new \Exception("Неизвестный фаил маршрутов $this->routes'");
        }

        $compiler = new ViewComponentCompiler();
        $commandViewData = $compiler->parseFile($this->routes);
        $this->reg->setCommands($commandViewData);
    }
}
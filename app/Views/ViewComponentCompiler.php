<?php

namespace App\Views;

use App\Commands\Command;
use App\Commands\DefaultCommand;
use App\ComponentDescriptor;
use App\Conf;

class ViewComponentCompiler
{
    private static string $defaultcmd = DefaultCommand::class;

    public function parseFile(string $file): Conf
    {
        $options = \simplexml_load_file($file);

        return $this->parse($options);
    }

    public function parse(\SimpleXMLElement $options): Conf
    {
        $conf = new Conf();

        foreach ($options->control->command as $command) {
            $path = (string)$command['path'];
            $cmdstr = (string)$command['class'];
            $path = empty($path) ? '/' : $path;
            $cmdstr = (empty($cmdstr)) ? self::$defaultcmd : $cmdstr;
            $pathobj = new ComponentDescriptor($path, $cmdstr);
            $this->processView($pathobj, 0, $command);

            if (isset($command->status) && isset($command->status['value'])) {
                foreach ($command->status as $statusel) {
                    $status = (string)$statusel['value'];
                    $statusval = constant(Command::class . '::' . $status);

                    if (is_null($statusval)) {
                        throw new \Exception("Неизвестное состояние: $status");
                    }

                    $this->processView($pathobj, $statusval, $statusel);
                }
            }

            $conf->set($path, $pathobj);
        }
        return $conf;
    }

    public function processView(ComponentDescriptor $pathobj, int $statusval, \SimpleXMLElement $el): void
    {
        if (isset($el->view) && isset($el->view['name'])) {
            $pathobj->setView($statusval, new TemplateViewComponent((string)$el->view['name']));
        }

        if (isset($el->forward) && isset($el->forward['path'])) {
            $pathobj->setView($statusval, new ForwardViewComponent((string)$el->forward['path']));
        }
    }
}
<?php

namespace App\Views;

use App\Registry;
use App\Requests\Request;

class TemplateViewComponent implements ViewComponent
{
    public function __construct(private string $name)
    {
    }

    public function render(Request $request): void
    {
        $reg = Registry::instance();
        $conf = $reg->getConf();

        $path = $conf->get('templatepath');
        if (is_null($path)) {
            throw new \Exception("Не найден каталог шаблонов");
        }

        $fullpath = __DIR__ . "/../../$path/{$this->name}.php";
        if (!file_exists($fullpath)) {
            throw new \Exception("Нет шаблона в $fullpath");
        }

        include($fullpath);

        var_dump('Debug: ', Registry::instance()->getRequest()->getFeedback());
    }
}
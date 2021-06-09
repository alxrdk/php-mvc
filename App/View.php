<?php

namespace App;

class View
{

    public static function render(string $view, array $params = []) : void
    {
        extract($params, EXTR_SKIP);

        $view = preg_replace('/\\\\/', '/', $view);
        $file = dirname(__DIR__) . "/App/Views/" . $view . ".php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

}
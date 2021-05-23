<?php

namespace App;
use \App\View;

class Controller
{

    protected function view(string $tplName, array $params)
    {
        View::render('Header');
        View::render($tplName, $params);
        View::render('Footer');
    }

}
<?php

namespace App;
use \App\View;

class Controller
{

    public function __construct()
    {
        session_start();
    }

    protected function view(string $tplName, array $params) : void
    {
        View::render('Header');
        View::render($tplName, $params);
        View::render('Footer');
    }

}
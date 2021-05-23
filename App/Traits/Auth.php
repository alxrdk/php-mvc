<?php

namespace App\Traits;

trait Auth
{

    public function __construct()
    {
        session_start();

    }

    protected function isAuthorized()
    {
        return isset($_SESSION['authorized']) && $_SESSION['authorized'];
    }


}
<?php

namespace App\Traits;

trait Auth
{

    protected function isAuthorized() : bool
    {
        return isset($_SESSION['authorized']) && $_SESSION['authorized'];
    }


}
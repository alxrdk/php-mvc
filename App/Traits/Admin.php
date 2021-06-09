<?php

namespace App\Traits;

trait Admin
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->isAuthorized()) {
            header('Location: /login');
            die();
        }
    }



}

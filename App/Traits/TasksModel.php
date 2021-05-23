<?php

namespace App\Traits;

use \App\Models\Tasks;

trait TasksModel
{

    protected function tasks()
    {
        return new Tasks();
    }

}
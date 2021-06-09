<?php

namespace App\Traits;

use \App\Models\Tasks;

trait TasksModel
{

    protected function tasks() : \App\Models\Tasks
    {
        return new Tasks();
    }

}
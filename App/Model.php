<?php

namespace App;
use \App\Database;
use \App\Config;

class Model
{

    protected static function db()
    {
        static $dbh = null;


        if ($dbh === null) {
            $dbh = new Database(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
        }

        return $dbh;
    }

}
<?php

namespace App;

use \App\Router;

class Core
{

    static function run() : void
    {

        $router = new Router();

        $router->add(Router::GET, '/', \App\Controllers\Tasks::class, 'show');
        $router->add(Router::GET, '/tasks', \App\Controllers\Tasks::class, 'show');
        $router->add(Router::POST, '/add', \App\Controllers\Tasks::class, 'add');

        $router->add(Router::GET, '/login', \App\Controllers\Admin\Login::class, 'login');
        $router->add(Router::POST, '/login', \App\Controllers\Admin\Login::class, 'login');
        $router->add(Router::GET, '/logout', \App\Controllers\Admin\Login::class, 'logout');
        $router->add(Router::POST, '/tasks/add', \App\Controllers\Admin\Tasks::class, 'add');
        $router->add(Router::GET, '/tasks/complite', \App\Controllers\Admin\Tasks::class, 'complite');
        $router->add(Router::GET, '/tasks/edit', \App\Controllers\Admin\Tasks::class, 'edit');
        $router->add(Router::POST, '/tasks/edit', \App\Controllers\Admin\Tasks::class, 'edit');
        $router->add(Router::GET, '/tasks/delete', \App\Controllers\Admin\Tasks::class, 'delete');

        $router->dispatch($_SERVER['QUERY_STRING']);

    }
}
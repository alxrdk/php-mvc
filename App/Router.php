<?php

namespace App;

class Router
{

    public const GET = 'GET';
    public const POST = 'POST';

    protected $routes = [];

    public function get()
    {
        return $this->routes ;
    }

    public function add(string $method, string $path, string $class, string $action)
    {
        $path = preg_replace('/\//', '\\/', $path);
        $path = '/^' . $path . '$/i';

        $this->routes[$method][$path] = [$class, $action];
    }

    public function dispatch(string $query)
    {

        $parts = explode('&', $query, 2);

        $uri = '/'.$parts[0];

        $params = [];
        if (sizeof($parts) > 1)
            parse_str($parts[1], $params);

        $found = false;

        $routes = $this->routes[$_SERVER['REQUEST_METHOD']];

        foreach ($routes as $route => $classAction) {
            if (preg_match($route, $uri, $matches) && !empty($matches)) {
                $found = true;
                break;
            }
        }

        if ($found) {

            [$className, $actionName] = $classAction;
            $class = new $className();
            $class->$actionName($params);

        } else {

            http_response_code(404);
            die('404 Not Found');

        }
    }

}
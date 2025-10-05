<?php

namespace App;

class Router
{
    protected $routes = [];

    public function addRoute($method, $path, $callback)
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'callback' => $callback];
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                if (is_callable($route['callback'])) {
                    call_user_func($route['callback']);
                } elseif (is_array($route['callback']) && count($route['callback']) === 2) {
                    list($controller, $action) = $route['callback'];
                    $controllerName = "App\\Controllers\\" . $controller;
                    if (class_exists($controllerName)) {
                        $controllerInstance = new $controllerName();
                        if (method_exists($controllerInstance, $action)) {
                            $controllerInstance->$action();
                            return;
                        }
                    }
                }
                return;
            }
        }

        // Handle 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}

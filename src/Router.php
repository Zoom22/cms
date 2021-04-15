<?php

namespace App;

use App\Exception\NotFoundException;

class Router
{
    private $routes = [];

    public function get($url, $callback)
    {
        $this->routes[] = new Route('GET', $url, $callback);
    }

    public function findRoute($method, $url)
    {
        foreach ($this->routes as $route) {

            if ($route->match($method, $url)) {
                return $route;
            }
        }

        return null;
    }

    public function dispatch()
    {
        $url = '/' . trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'];
        $route = $this->findRoute($method, $url);
        if (isset($route)) {
            return $route->run($url);
        } else {
            throw new NotFoundException();
        }
    }

    public function post($url, $callback)
    {
        $this->routes[] = new Route('POST', $url, $callback);
    }
}

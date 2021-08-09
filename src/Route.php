<?php

namespace App;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

    private function prepareCallback($callback)
    {
        if (is_string($callback)) {
            list($controller, $method) = explode('@', $callback);
            return [new $controller, $method];
        }
        return $callback;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function match($method, $uri): bool
    {
        return ($this->method === $method && preg_match('/^' . str_replace(['*', '/'], ['\w*', '\/?'], $this->path) . '$/', $uri));
    }

    public function run($uri)
    {
        $params = array_diff(explode('/', $uri), explode('/', $this->getPath()));
        return call_user_func_array($this->prepareCallback($this->callback), $params);
    }
}

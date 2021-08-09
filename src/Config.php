<?php

namespace App;

final class Config
{
    private static $instance;
    private $configs = [];

    public static function getInstance(): Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function get($config, $default = null)
    {
        return array_get($this->configs, $config, $default);
    }

    public function set($key, $value)
    {
        $this->configs[$key] = $value;
        return $this;
    }
}

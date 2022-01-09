<?php

namespace Hansen\system\Core;

class Route
{
    public array $route;

    public function get($url, $cb)
    {
        $this->route['get'][$url] = $cb;
    }
    public function post($url, $cb)
    {
        $this->route['post'][$url] = $cb;
    }

    public function run()
    {
        $url = $_SERVER["REQUEST_URI"];
        $method = strtolower($_SERVER["REQUEST_METHOD"]);

        $cb = $this->route[$method][$url];

        if (!$cb) {
            http_response_code(404);
            exit;
        }

        echo call_user_func($cb);
    }
}
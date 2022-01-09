<?php

namespace Hansen\system\Core;

class Request
{
    public function getBody()
    {
        $body = [];
        if (strtolower($_SERVER["REQUEST_METHOD"]) === "get") {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
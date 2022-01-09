<?php

namespace Hansen\system\Core;

class View
{
    public static function render($path, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../../app/Views/$path.php";
    }
}
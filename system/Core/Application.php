<?php

namespace Hansen\system\Core;

use Hansen\system\Database\Migrations;

class Application
{
    public static Migrations $db;

    public function __construct()
    {
        $this->db = new Migrations();
    }
}
<?php

require_once __DIR__ . "/../vendor/autoload.php";

\Dotenv\Dotenv::createImmutable(".")->load();

require_once __DIR__ . "/../routes/main.php";
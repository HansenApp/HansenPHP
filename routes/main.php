<?php

use Hansen\system\Core\Route;
use Hansen\system\Core\View;

$router = new Route();

$router->get("/", function () {
    return View::render('index');
});

$router->run();

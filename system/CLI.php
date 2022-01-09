<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('HansenPHP CLI Tool', 'v1.0.0');
$app->add(new \Hansen\system\CLI\Serve());
$app->add(new Hansen\system\CLI\db\db());
$app->add(new \Hansen\system\CLI\migrate\migrate());
$app->add(new \Hansen\system\CLI\migrate\rollback());
$app->add(new \Hansen\system\CLI\migrate\fresh());
$app->add(new \Hansen\system\CLI\make\model());

$app->run();
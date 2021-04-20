<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$controller = new App\SearchBooksController($app->getPdo(), $app->getView());
echo $controller->index($_GET);

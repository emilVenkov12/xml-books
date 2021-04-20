<?php

// use Laravel's approach for base App class maybe

//here need to open the connection to the db
// set the default path for the view

$config = [
    'pdo' => [
        'host' => 'db',
        'port' => '5432',
        'dbname' => 'xml-parser',
        'username' => 'dev',
        'password' => 'qwerty'
    ],
    'view' => [
        'basePath' => dirname(__DIR__ . '/../views')
    ]
];

$app = new App\AppContainer($config);

return $app;

<?php
require __DIR__ . '/../../vendor/autoload.php';


$app = require_once __DIR__ . '/../../bootstrap/app.php';

if (isset($argv[1])) {
    switch ($argv[1]) {
        case 'import-xml':
            $command = new App\Console\ImportXmlBooks($app->getPdo());
            $depth = 10;
            $command->importDir(__DIR__ . '/../../storage/imports', $depth);
            break;
        case 'migrate-db':
            $command = new App\Console\MigrateDb($app->getPdo());
            $command->migrate();
            break;
    }
}

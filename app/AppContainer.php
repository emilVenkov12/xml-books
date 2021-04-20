<?php

namespace App;

use Exception;
use PDO;

class AppContainer
{
    protected $pdo;
    protected $view;

    public function __construct($config)
    {
        $this->initPdo($config['pdo']);
        $this->initView($config['view']);
    }

    public function getPdo()
    {
        return $this->pdo;
    }
    public function getView()
    {
        return $this->view;
    }

    protected function initPdo($config)
    {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};";
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->pdo = new PDO($dsn, $config["username"], $config["password"], $options);
        } catch (Exception $e) {
            error_log($e->getMessage());
            var_dump($e->getMessage());
            exit('Something weird happened'); //something a user can understand
        }
    }

    protected function initView($config)
    {
        $this->view = new View($config['basePath']);
    }
}

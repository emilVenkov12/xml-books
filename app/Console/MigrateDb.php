<?php

namespace App\Console;

use PDO;

class MigrateDb
{
    /**
     * Instance of the pdo connection
     *
     * @var PDO
     */
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function migrate()
    {
        $this->pdo->prepare("DROP TABLE IF EXISTS authors;")->execute();
        $createAuthors = "
            CREATE TABLE authors (
                id        SERIAL PRIMARY KEY,
                name      CITEXT,
                CONSTRAINT author_name UNIQUE(name)
            );
        ";

        $this->pdo->prepare($createAuthors)->execute();

        $this->pdo->prepare("DROP TABLE IF EXISTS books;")->execute();
        $createBooks = "
            CREATE TABLE books (
                id        SERIAL PRIMARY KEY,
                name      CITEXT,
                author_id integer,
                CONSTRAINT book_name UNIQUE(name),
                CONSTRAINT book_author UNIQUE(author_id, name)
            );
        ";

        $this->pdo->prepare($createBooks)->execute();
    }
}

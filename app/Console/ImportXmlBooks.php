<?php

namespace App\Console;


use PDO;

class ImportXmlBooks
{
    /**
     * Instance of the pdo connection
     *
     * @var PDO
     */
    protected $pdo;

    protected $stats;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function importDir($dir, $depth = 5)
    {
        // $stats = [
        //     'successfull' => [],
        //     'failed'
        // ]
        $cdir = scandir($dir);
        foreach ($cdir as $value) {
            if (!in_array($value, array(".", "..", "processed"))) {
                $entry = $dir . DIRECTORY_SEPARATOR . $value;
                if (is_dir($entry)) {
                    $this->importDir($entry, $depth--);
                } else {
                    $this->importFile($entry);
                }
            }
        }

        return true;
    }

    public function importFile($path)
    {
        $xml = simplexml_load_string(file_get_contents($path));

        $queryAuthor = 'insert into authors(name) values (?) on conflict("name") do update set name=EXCLUDED.name returning id';
        $queryBook = 'insert into books (author_id, name) values (?, ?) on conflict do nothing';

        foreach ($xml->children() as $book) {
            $authorName = trim((string)$book->author);
            $bookName = trim((string)$book->name);

            $stmt = $this->pdo->prepare(
                $queryAuthor
            );
            $stmt->execute([$authorName]);
            $authorId = $stmt->fetchColumn();
            $stmt = null;

            $this->pdo->prepare(
                $queryBook
            )->execute([$authorId, $bookName]);
        }
    }
}

<?php

namespace App;

use PDO;

class SearchBooksController
{
    /**
     * Instance of the database connection
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Instance of the view renderer
     *
     * @var View
     */
    protected $view;

    public function __construct(PDO $pdo, View $view)
    {
        $this->pdo = $pdo;
        $this->view = $view;
    }

    public function index($params)
    {
        $data = [
            'books' => []
        ];
        $query = 'select authors.name as author_name, books.name as book_name from authors LEFT join books on books.author_id = authors.id';
        $queryParams = [];

        if (isset($params['search'])) {
            $data['search'] = $params['search'];
            $queryParams['search'] = "%{$params['search']}%";
            $query .= ' where authors.name like :search';
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($queryParams);

        $data['books'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$data['books']) {
            $data['books'] = [];
        }

        $stmt = null;

        return  $this->view->render('search-books', $data);
    }
}

<!DOCTYPE html>
<html>

<head>
    <title>Search Books</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300&display=swap" rel="stylesheet">
    <script src="js/all.js"></script>
</head>

<body class="body">
    <div class="container">
        <h2 class="text-center">Search Books</h2>
        <form method="get" class="text-center search-form">
            <input type="text" name="search" placeholder="Enter author name" value="<?php echo htmlspecialchars($data['search'] ?? '') ?>" />
            <button type="submit">Search</button>
        </form>
        <div class="results-container">
            <?php if (isset($data['books']) && !empty($data['books'])) { ?>
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Book Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['books'] as $book) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['author_name']) ?></td>
                                <td><?php echo htmlspecialchars($book['book_name']) ?></td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>

            <?php } else if (isset($data['search'])) { ?>
                <h3>No books found for this author</h3>
            <?php } ?>
        </div>
    </div>
</body>

</html>
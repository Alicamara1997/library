<?php

    // Connexion à la base de données
    $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');
    // Requête SQL pour récupérer les livres avec les noms et prénoms des auteurs
    $sql = "SELECT book.id_book, book.title, author.first_name, author.last_name
            FROM book
            LEFT JOIN author ON book.id_author = author.id_author";
    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<table border=1px>';
    echo '<tr><th>Id Book</th><th>Title</th><th>Author</th><th>Action(s)</th></tr>';
    foreach ($books as $book) {
        echo '<tr>';
        echo '<td>' . $book['id_book'] . '</td>';
        echo '<td>' . $book['title'] . '</td>';
        echo '<td>' . $book['first_name'] . ' ' . $book['last_name'] . '</td>';
        echo '<td>
            <a href="detail.php?identifiant=' . $book["id_book"] . '">Détail</a><br/>
            <a href="edit.php?identifiant=' . $book["id_book"] . '">Modifier</a><br/>
            <a href="delete.php?identifiant=' . $book["id_book"] . '">Supprimer</a>
        </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<a href="add.php">Add a book</a>';
?>

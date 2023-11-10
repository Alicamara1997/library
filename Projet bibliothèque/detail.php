<?php
$title = "Détail";


     // Connexion à la base de données
     $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');

    if (isset($_GET['identifiant'])) 
        $bookId = $_GET['identifiant'];

        $sql = "SELECT b.title, b.date_pub, a.first_name, a.last_name, a.biography, a.country, a.description 
        FROM book AS b
        LEFT JOIN author AS a ON b.id_author = a.id_author
        WHERE b.id_book = :bookId
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
        $stmt->execute();

        
            $bookDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            echo '<h1>Détails du Livre</h1>';
            echo '<table>';
            echo '<tr><th>Titre</th><td>' . $bookDetails['title'] . '</td></tr>';
            echo '<tr><th>Date de sortie</th><td>' . $bookDetails['date_pub'] . '</td></tr>';
            echo '<tr><th>Author</th><td>' . $bookDetails['first_name'] . ' ' . $bookDetails['last_name'] . '</td></tr>';
            echo '<tr><th>Biography</th><td>' . $bookDetails['biography'] . '</td></tr>';
            echo '<tr><th>Country</th><td>' . $bookDetails['country'] . '</td></tr>';
            echo '<tr><th>description </th><td>' . $bookDetails['description'] . '</td></tr>';
            echo '</table>';
        
    
 
?>

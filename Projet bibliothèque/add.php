<?php
// Connexion à la base de données
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');

// Récupérez la liste des auteurs depuis la table 'author'
$queryAuthors = $pdo->query("SELECT id_author, first_name, last_name FROM author");
$authors = $queryAuthors->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $title = $_POST['title'];
    $authorId = $_POST['author_id']; // ID de l'auteur sélectionné

    // Insérez le titre du livre et l'ID de l'auteur dans la table 'book'
    $query = $pdo->prepare("INSERT INTO book (title, id_author) VALUES (:title, :author_id)");
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':author_id', $authorId, PDO::PARAM_INT);
    $stm = $query->execute();

    if ($stm) {
        echo 'Livre ajouté avec succès.';
    } else {
        echo 'Erreur lors de l\'ajout du livre.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Livre</title>
</head>
<body>
    <h2>Ajouter de nouveaux livres</h2>
    <form action="" method="post">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="author_id">Auteur :</label>
        <select name="author_id" id="author_id" required>
            <option value="">Sélectionnez un auteur</option>
            <?php foreach ($authors as $author) : ?>
                <option value="<?= $author['id_author'] ?>">
                    <?= $author['first_name'] ?> <?= $author['last_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>

<?php
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root', '');

$bookId = isset($_GET['identifiant']) ? $_GET['identifiant'] : null;

if (!empty($_POST)) {
    $title = $_POST['title'];
    $date_pub = $_POST['date_pub'];
    $author_id = $_POST['author_id'];

    $sql = "UPDATE book SET title = :title, date_pub = :date_pub, id_author = :author_id WHERE id_book = :book_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'book_id' => $bookId,
        'title' => $title,
        'date_pub' => $date_pub,
        'author_id' => $author_id
    ]);

    header("Location: index.php?identifiant=$bookId");
    exit;
}

$bookDetails = $pdo->prepare("SELECT book.title, book.date_pub, book.id_author, author.first_name, author.last_name 
                              FROM book 
                              LEFT JOIN author ON book.id_author = author.id_author 
                              WHERE book.id_book = :bookId");
$bookDetails->execute(['bookId' => $bookId]);
$bookDetails = $bookDetails->fetch(PDO::FETCH_ASSOC);

$authors = $pdo->query("SELECT id_author, first_name, last_name FROM author")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le Livre</title>
</head>
<body>
    <h1>Modifier un Livre</h1>
    <form method="POST" action="edit.php?identifiant=<?= $bookId ?>">
        <label for="title">Titre:</label>
        <input type="text" name="title" value="<?= $bookDetails['title'] ?>" required><br>

        <label for="date_pub">Date de sortie:</label>
        <input type="date" name="date_pub" value="<?= $bookDetails['date_pub'] ?>" required><br>

        <label for="author_id">Auteur:</label>
        <select name="author_id" required>
            <?php foreach ($authors as $author): ?>
                <option value="<?= $author['id_author'] ?>" <?= $author['id_author'] == $bookDetails['id_author'] ? 'selected' : '' ?>>
                    <?= $author['first_name'] . ' ' . $author['last_name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le Livre</title>
</head>
<body>
    <h1>Modifier le Livre</h1>
    <form method="POST" action="edit.php">
        <label for="title">Titre :</label>
        <input type="text" name="title" value="" required><br>

        <label for="date_pub">Date de publication :</label>
        <input type="text" name="date_pub" value="" required><br>

        <input type="hidden" name="bookId" value="<?= $bookId ?>">
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>

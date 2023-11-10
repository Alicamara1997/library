<?php
$link = new mysqli('localhost', 'root', '', 'library');
$result = $link->query("DELETE FROM book WHERE id_book= ".$_GET['identifiant']);
header('Location: /index.php');
die;
?>
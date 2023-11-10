<?php
function connect_bd() : PDO
{
    require_once '_connec.php';
    $pdo = new \PDO(DSN, USER, PASS);
    return $pdo;
} 
function getAllRows($table)
{
    $pdo=connect_bd();
    $query = "SELECT * FROM $table";
    $statement = $pdo->query($query);
    $array = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}
?>
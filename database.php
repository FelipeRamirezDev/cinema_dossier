<?php
$host = "localhost";
$database = "cinema_dossier";
$user = "root";
$password = "";

try {

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);

} catch (PDOException $error){
    die("PDO CONECTION ERROR:" . $error->getMessage());
}

?>

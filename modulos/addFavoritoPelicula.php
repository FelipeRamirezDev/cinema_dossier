<?php
require "../database.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: ../login.php");
  exit; // Termina la ejecución del script
}

// Obtener el ID de la película de la URL
$idPelicula = isset($_GET["id_pelicula"]) ? (int)$_GET["id_pelicula"] : null;

if ($idPelicula) {
    // Insertar la película en la lista de favoritos del usuario
    $idUser = $_SESSION["user"]["id_user"];
    $statement = $conn->prepare("INSERT INTO favoritos_peliculas (id_user, id_pelicula) VALUES (:idUser, :idPelicula)");
    $statement->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $statement->bindParam(":idPelicula", $idPelicula, PDO::PARAM_INT);
    $statement->execute();
}

// Redirigir de vuelta a la página de información de la película
header("Location: ../info-pelicula.php?id_pelicula=$idPelicula");
?>

<?php
require "../database.php";

session_start();

if (!isset($_SESSION["user"])) {
  header("Location: ../login.php");
  exit; // Termina la ejecución del script
}

// Obtener el ID de la película de la URL
$idPersona = isset($_GET["id_persona"]) ? (int)$_GET["id_persona"] : null;

if ($idPersona) {
    // Insertar la película en la lista de favoritos del usuario
    $idUser = $_SESSION["user"]["id_user"];
    $statement = $conn->prepare("INSERT INTO favoritos_personas (id_user, id_persona) VALUES (:idUser, :idPersona)");
    $statement->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $statement->bindParam(":idPersona", $idPersona, PDO::PARAM_INT);
    $statement->execute();
}

// Redirigir de vuelta a la página de información de la película
header("Location: ../info-persona.php?id_persona=$idPersona");
?>

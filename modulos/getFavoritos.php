<?php

function getFavoritosPeliculas($conn, $id_user) {
    $statement = $conn->prepare("SELECT * FROM pelicula WHERE id_pelicula IN (SELECT id_pelicula FROM favoritos_peliculas WHERE id_user = :id_user)");
    $statement->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

function getFavoritosPersonas($conn, $id_user) {
    $statement = $conn->prepare("SELECT * FROM persona WHERE id_persona IN (SELECT id_persona FROM favoritos_personas WHERE id_user = :id_user)");
    $statement->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $statement->execute();
    $personas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $personas;
}

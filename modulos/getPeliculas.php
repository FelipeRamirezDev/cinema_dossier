<?php

function getPeliculasPorGenero($conn, $genero) {
    $statement = $conn->prepare("SELECT * FROM pelicula WHERE genero = :genero");
    $statement->bindParam(":genero", $genero, PDO::PARAM_STR);
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

function getPeliculasPorAno($conn, $ano) {

    $statement = $conn->prepare("SELECT * FROM pelicula WHERE ano_produccion >= :ano and ano_produccion < :ano+10");
    $statement->bindParam(":ano", $ano, PDO::PARAM_INT);
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

function getPeliculasPorRecaudacion($conn, $recaudacion) {

    $statement = $conn->prepare("SELECT * FROM pelicula ORDER BY $recaudacion DESC");
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

function getPeliculasPorNacionalidad($conn, $nacionalidad) {

    $statement = $conn->prepare("SELECT * FROM pelicula WHERE nacionalidad = :nacionalidad");
    $statement->bindParam(":nacionalidad", $nacionalidad, PDO::PARAM_STR);
    $statement->execute();
    $peliculas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $peliculas;
}

?>

<?php

function getPersonasPorSexo($conn, $sexo) {
    $statement = $conn->prepare("SELECT * FROM persona WHERE sexo = :sexo");
    $statement->bindParam(":sexo", $sexo, PDO::PARAM_STR_CHAR);
    $statement->execute();
    $personas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $personas;
}

function getPersonasPorEstado($conn, $estado) {
    $statement = $conn->prepare("SELECT * FROM persona WHERE estado = :estado");
    $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
    $statement->execute();
    $personas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $personas;
}

function getPersonasPorInicioCarrera($conn, $ano_inicio) {
    $statement = $conn->prepare("SELECT * FROM persona WHERE ano_inicio_carrera >= :ano_inicio and ano_inicio_carrera < :ano_inicio+10");
    $statement->bindParam(":ano_inicio", $ano_inicio, PDO::PARAM_INT);
    $statement->execute();
    $personas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $personas;
}

?>
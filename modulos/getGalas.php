<?php

function getGalasPorTipo($conn, $tipo) {
    $statement = $conn->prepare("SELECT * FROM gala WHERE tipo = :tipo");
    $statement->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $statement->execute();
    $galas = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $galas;
}

function getGalasPorAno($conn, $ano) {
    $anoFin = $ano + 10;
    $statement = $conn->prepare("SELECT * FROM gala WHERE ano_comienzo >= :anoInicio AND ano_comienzo < :anoFin");
    $statement->bindParam(":anoInicio", $ano, PDO::PARAM_INT);
    $statement->bindParam(":anoFin", $anoFin, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getPremiacionesPorGala($conn, $id_gala) {
    $sql = "SELECT 
                edicion_gala.ano as ano_edicion,
                premio.nombre_premio,
                premio.tipo_premio,
                nominacion.resultado,
                pelicula.titulo_espanol,
                persona.nombre_artistico
            FROM edicion_gala
            JOIN premio ON premio.id_edicion = edicion_gala.id_edicion
            JOIN nominacion ON nominacion.id_premio = premio.id_premio
            JOIN pelicula ON pelicula.id_pelicula = nominacion.id_pelicula
            JOIN persona ON persona.id_persona = nominacion.id_persona
            WHERE edicion_gala.id_gala = :id_gala
            ORDER BY edicion_gala.ano DESC, nominacion.resultado DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_gala", $id_gala, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


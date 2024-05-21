<?php

function getPremiosPorTipo($conn, $tipo_premio) {
    $sql = "SELECT premio.id_premio, premio.nombre_premio, premio.tipo_premio, edicion_gala.ano, edicion_gala.lugar_celebracion, gala.nombre_gala,
                   persona.nombre_real AS ganador
            FROM premio
            JOIN edicion_gala ON premio.id_edicion = edicion_gala.id_edicion
            JOIN gala ON edicion_gala.id_gala = gala.id_gala
            LEFT JOIN nominacion ON premio.id_premio = nominacion.id_premio AND nominacion.resultado = 'ganador'
            LEFT JOIN persona ON nominacion.id_persona = persona.id_persona
            WHERE premio.tipo_premio = :tipo_premio";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":tipo_premio", $tipo_premio, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getPremiosPorAno($conn, $ano) {
    $sql = "SELECT premio.id_premio, premio.nombre_premio, premio.tipo_premio, edicion_gala.ano, edicion_gala.lugar_celebracion, gala.nombre_gala,
                   persona.nombre_real AS ganador
            FROM premio
            JOIN edicion_gala ON premio.id_edicion = edicion_gala.id_edicion
            JOIN gala ON edicion_gala.id_gala = gala.id_gala
            LEFT JOIN nominacion ON premio.id_premio = nominacion.id_premio AND nominacion.resultado = 'ganador'
            LEFT JOIN persona ON nominacion.id_persona = persona.id_persona
            WHERE edicion_gala.ano = :ano";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":ano", $ano, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getNominadosPorPremio($conn, $id_premio) {
    $sql = "SELECT persona.nombre_real
            FROM nominacion
            JOIN persona ON nominacion.id_persona = persona.id_persona
            WHERE nominacion.id_premio = :id_premio AND nominacion.resultado = 'nominado'";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":id_premio", $id_premio, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>

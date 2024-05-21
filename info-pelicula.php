<?php
require "database.php";
require "partials/header.php"; 
session_start();

//obtener el valor del id desde la url, si no se pasa valor por default es 0
$id_pelicula = isset($_GET["id_pelicula"]) ? (int)$_GET["id_pelicula"] : 0;

$statement = $conn->prepare("SELECT * FROM pelicula WHERE id_pelicula = :id_pelicula");
$statement->bindParam(":id_pelicula", $id_pelicula);
$statement->execute();


if ($statement->rowCount() == 0){
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
}
//pedimos la pelicula con fetch y especificamos que lo queremos en formato asociativo (array)
$pelicula = $statement->fetch(PDO::FETCH_ASSOC);


?>

<main class="main-peliculas container">
    <h1 class="titulo-main-peliculas">Información de la Pelicula</h1>
    
    <div class="info-pelicula">
        <img src="img/portadas/<?= $pelicula["ruta_imagen"] ?>" alt="pelicula">
        
        <div class="texto-pelicula">
            <p><span>Titulo Original: </span><?= $pelicula["titulo_original"] ?></p>
            <p><span>Titulo en Español: </span><?= $pelicula["titulo_espanol"] ?></p>
            <p><span>Año de Producción: </span><?= $pelicula["ano_produccion"] ?></p>
            <p><span>Nacionalidad: </span><?= $pelicula["nacionalidad"] ?></p>
            <p><span>Idioma Original: </span><?= $pelicula["idioma_original"] ?></p>
            <p><span>Genero: </span><?= $pelicula["genero"] ?></p>
            <p><span>Lugar de Estreno: </span><?= $pelicula["lugar_estreno"] ?></p>
            <p><span>Sala de Exposición: </span><?= $pelicula["sala_exposicion"] ?></p>
            <p><span>Recaudacion de Primer Año: </span><?= $pelicula["recaudacion_primer_ano"] ?></p>
            <p><span>Recaudacion Total: </span>$<?= $pelicula["recaudacion_total"] ?></p>
            <p><span>Recaudacion Total: </span>$<?= $pelicula["recaudacion_total"] ?></p>
            <?php if (isset($_SESSION["user"])): ?>
                <a class="button" style="width: 50%;" href="modulos/addFavoritoPelicula.php?id_pelicula=<?= $id_pelicula ?>">Agregar a Favoritos</a>
            <?php endif ?>
        </div>

    </div>
</main>
        

<?php require "./partials/footer.php" ?>

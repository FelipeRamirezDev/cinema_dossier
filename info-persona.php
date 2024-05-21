<?php
require "database.php";
require "partials/header.php"; 

//obtener el valor del id desde la url, si no se pasa valor por default es 0
$id_persona = isset($_GET["id_persona"]) ? (int)$_GET["id_persona"] : 0;

$statement = $conn->prepare("SELECT * FROM persona WHERE id_persona = :id_persona");
$statement->bindParam(":id_persona", $id_persona);
$statement->execute();


if ($statement->rowCount() == 0){
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
}
//pedimos la pelicula con fetch y especificamos que lo queremos en formato asociativo (array)
$persona = $statement->fetch(PDO::FETCH_ASSOC);


?>

<main class="main-peliculas container">
    <h1 class="titulo-main-peliculas">Información de la Persona</h1>
    
    <div class="info-pelicula">
        <img src="img/personas/<?= $persona["ruta_imagen"] ?>" alt="persona">
        
        <div class="texto-pelicula">
            <p><span>Nombre Artistico: </span><?= $persona["nombre_artistico"] ?></p>
            <p><span>Nombre Real: </span><?= $persona["nombre_real"] ?></p>
            <p><span>Sexo: </span><?= $persona["sexo"] ?></p>
            <p><span>Año de nacimiento: </span><?= $persona["ano_nacimiento"] ?></p>
            <p><span>Pagina WEB: </span><?= $persona["pagina_web"] ?></p>
            <p><span>Año del Inicio de Carrera: </span><?= $persona["ano_inicio_carrera"] ?></p>
            <p><span>Años Trabajando: </span><?= $persona["anos_trabajando"] ?></p>
            <p><span>Estado: </span><?= $persona["estado"] ?></p>
            <?php if (isset($_SESSION["user"])): ?>
                <a class="button" style="width: 50%;" href="modulos/addFavoritoPersona.php?id_persona=<?= $id_persona ?>">Agregar a Favoritos</a>
            <?php endif ?>
        </div>
    </div>
</main>
        

<?php require "./partials/footer.php" ?>

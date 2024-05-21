<?php
require "./database.php";
require "./partials/header.php";
require "./modulos/getPeliculas.php"; 


$peliculas = []; // Inicializar la variable $peliculas como un array vacío

if(isset($_GET['q'])) {
    $busqueda = $_GET['q'];
    // Consulta SQL para buscar en ambas tablas
    $queryPeliculas = "SELECT * FROM pelicula
              WHERE titulo_original LIKE '%$busqueda%' OR titulo_espanol LIKE '%$busqueda%'";

    $queryPersonas = "SELECT * FROM persona
                    WHERE nombre_artistico LIKE '%$busqueda%' OR nombre_real LIKE '%$busqueda%'";
    
    $resultadoPeliculas = $conn->query($queryPeliculas);
    $resultadoPersonas = $conn->query($queryPersonas);
    // Verificar si hay resultados
    $encontrado = false;
    if($resultadoPeliculas->rowCount() > 0) {
        $peliculas = $resultadoPeliculas->fetchAll(); // Obtener todos los resultados como un array
        $encontrado = true;
    } 
    if($resultadoPersonas->rowCount() > 0) {
        $personas = $resultadoPersonas->fetchAll(); // Obtener todos los resultados como un array
        $encontrado = true;
    } 
    if (!$encontrado) {
        $mensaje = "No se encontraron películas o personas que coincidan con la búsqueda.";
    }
}
 ?>
        
<main class="main-peliculas container">
    <h2 class="titulo-main-peliculas">Búsqueda:</h2>

    <section class="peliculas-filtradas">
        <?php if(empty($peliculas) && empty($personas)): ?>
            <h3><?= $mensaje ?></h3>
        <?php endif ?>

        <div class="peliculas">
            <?php foreach ($peliculas as $pelicula): ?>
                <div class="pelicula">
                    <a href="info-pelicula.php?id_pelicula=<?= $pelicula["id_pelicula"] ?>">
                        <img src="./img/portadas/<?= $pelicula["ruta_imagen"] ?>" alt="<?= $pelicula["titulo_original"] ?>">
                    </a>
                    <p><?= $pelicula["titulo_original"] ?></p>
                </div>
            <?php endforeach ?>
        </div>

        <div class="personas">
            <?php foreach ($personas as $persona): ?>
                <div class="persona">
                    <a href="info-persona.php?id_persona=<?= $persona["id_persona"] ?>">
                        <?php if($persona["ruta_imagen"]): ?>
                            <img src="./img/personas/<?= $persona["ruta_imagen"] ?>" alt="<?= $persona["nombre_artistico"] ?>">
                        <?php else: ?>
                            <img src="./img/personas/default.png" alt="<?= $persona["nombre_artistico"] ?>">
                        <?php endif ?>
                    </a>
                    <p><?= $persona["nombre_artistico"] ?></p>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</main>


<?php require "./partials/footer.php" ?>

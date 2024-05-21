<?php
require "./database.php";
require "./partials/header.php";
require "./modulos/getPersonas.php";


$personasPopulares = $conn->query("SELECT * FROM persona");

if ( isset($_GET['filtro']) && $_GET['filtro'] == 'todas' ) {
    //seleccionamos todas las peliculas de la base de datos
    $personas = $conn->query("SELECT * FROM persona");

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'sexo' && isset($_GET['valor']) ) {

    $sexo = $_GET['valor']; // Capturar el valor del género desde la URL
    $personas = getPersonasPorSexo($conn, $sexo);

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'estado' && isset($_GET['valor']) ) {

    $estado = $_GET['valor']; 
    $personas = getPersonasPorEstado($conn, $estado);

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'ano_inicio' && isset($_GET['valor']) ) {

    $ano_inicio = $_GET['valor'];
    $personas = getPersonasPorInicioCarrera($conn, $ano_inicio);

} else {
    echo("Filtro invalido");
}

 ?>
        
    <main class="main-peliculas container">
        <h2 class="titulo-main-peliculas">Personas Mas Influyentes Del Mes</h2>

        <section class="peliculas swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($personasPopulares as $persona): ?>
                    <div class="pelicula swiper-slide">
                        <a href="info-persona.php?id_persona=<?= $persona["id_persona"] ?>">
                            <?php if($persona["ruta_imagen"]): ?>
                                <img src="./img/personas/<?= $persona["ruta_imagen"] ?>" alt="<?= $persona["nombre_artistico"] ?>">
                            <?php else: ?>
                                <img src="./img/personas/default.png" alt="<?= $persona["nombre_artistico"] ?>">
                            <?php endif ?>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
                <!-- Botones de Navegación -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </section>

        <div class="filters-menu">
            <h3>Filtrar Personas Por</h3>

            <div class="filter">
                <a class="filter-button button" href="?filtro=todas&valor=Todas&titulo=Todas">Todas</a>
            </div>

            <div class="filter">
                <button class="filter-button button">Sexo</button>
                <div class="filter-options">
                    <a href="?filtro=sexo&valor=F&titulo=Femenino">Femenino</a>
                    <a href="?filtro=sexo&valor=M&titulo=Masculino">Masculino</a>
                </div>
            </div>

            <div class="filter">
                <button class="filter-button button">Estado</button>
                <div class="filter-options">
                    <a href="?filtro=estado&valor=activo&titulo=Activo">Activo</a>
                    <a href="?filtro=estado&valor=retirado&titulo=Retirado">Retirado</a>
                    <a href="?filtro=estado&valor=fallecido&titulo=Fallecido">Fallecido</a>
                </div>
            </div>

            <div class="filter">
                <button class="filter-button button">Década de Inicio</button>
                <div class="filter-options">
                    <a href="?filtro=ano_inicio&valor=2020&titulo=2020s">2020s</a>
                    <a href="?filtro=ano_inicio&valor=2010&titulo=2010s">2010s</a>
                    <a href="?filtro=ano_inicio&valor=2000&titulo=2000s">2000s</a>
                    <a href="?filtro=ano_inicio&valor=1990&titulo=1990s">1990s</a>
                    <a href="?filtro=ano_inicio&valor=1980&titulo=1980s">1980s</a>
                    <a href="?filtro=ano_inicio&valor=1970&titulo=1970s">1970s</a>
                </div>
            </div>

        </div>


        <section class="personas-filtradas">
            <?php if ($_GET['titulo']): ?>
                <h2><?= $_GET['titulo'] ?></h2>
            <?php else: ?>
                <h2>Selecciona un filtro</h2>
            <?php endif ?>

            <?php if(!$peliculas): ?>
                <h3>NO hay personas para este filtro</h3>
            <?php endif ?>

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

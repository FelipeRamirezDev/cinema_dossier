<?php
require "./database.php";
require "./partials/header.php";
require "./modulos/getPeliculas.php"; 


$peliculasPopulares = $conn->query("SELECT * FROM pelicula");

if ( isset($_GET['filtro']) && $_GET['filtro'] == 'todas' ) {
    //seleccionamos todas las peliculas de la base de datos
    $peliculas = $conn->query("SELECT * FROM pelicula");

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'genero' && isset($_GET['valor']) ) {

    $genero = $_GET['valor']; // Capturar el valor del género desde la URL
    $peliculas = getPeliculasPorGenero($conn, $genero);

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'ano' && isset($_GET['valor']) ) {

    $ano = $_GET['valor']; 
    $peliculas = getPeliculasPorAno($conn, $ano);

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'mayor_recaudacion' && isset($_GET['valor']) ) {

    $recaudacion = $_GET['valor'];
    $peliculas = getPeliculasPorRecaudacion($conn, $recaudacion);

} else if ( isset($_GET['filtro']) && $_GET['filtro'] == 'nacionalidad' && isset($_GET['valor']) ) {

    $nacionalidad = $_GET['valor'];
    $peliculas = getPeliculasPorNacionalidad($conn, $nacionalidad);

} else {
    echo("Filtro invalido");
}

 ?>
        
    <main class="main-peliculas container">
        <h2 class="titulo-main-peliculas">Peliculas Populares Esta Semana</h2>

        <section class="peliculas swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($peliculasPopulares as $pelicula): ?>
                    <div class="pelicula swiper-slide">
                        <a href="info-pelicula.php?id_pelicula=<?= $pelicula["id_pelicula"] ?>">
                            <img src="./img/portadas/<?= $pelicula["ruta_imagen"] ?>" alt="<?= $pelicula["titulo_original"] ?>">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
                <!-- Botones de Navegación -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </section>

        <div class="filters-menu">
            <h3>Filtrar Por </h3>
            <div class="filter">
                <a class="filter-button button" href="?filtro=todas&valor=Todas&titulo=Todas">Todas</a>
            </div>

            <div class="filter">
                <button class="filter-button button">Género</button>
                <div class="filter-options">
                    <a href="?filtro=genero&valor=Accion&titulo=Accion">Acción</a>
                    <a href="?filtro=genero&valor=Ciencia ficción&titulo=Ciencia ficción">Ciencia ficción</a>
                    <a href="?filtro=genero&valor=Drama&titulo=Drama">Drama</a>
                    <a href="?filtro=genero&valor=Comedia&titulo=Comedia">Comedia</a>
                    <a href="?filtro=genero&valor=Terror&titulo=Terror">Terror</a>
                </div>
            </div>
            
            <div class="filter">
                <button class="filter-button button">Año</button>
                <div class="filter-options">
                    <a href="?filtro=ano&valor=2020&titulo=2020s">2020s</a>
                    <a href="?filtro=ano&valor=2010&titulo=2010s">2010s</a>
                    <a href="?filtro=ano&valor=2000&titulo=2000s">2000s</a>
                    <a href="?filtro=ano&valor=1990&titulo=1990s">1990s</a>
                    <a href="?filtro=ano&valor=1980&titulo=1980s">1980s</a>
                    <a href="?filtro=ano&valor=1970&titulo=1970s">1970s</a>
                </div>
            </div>

            <div class="filter">
                <button class="filter-button button">Mayor recaudacion</button>
                <div class="filter-options">
                    <a href="?filtro=mayor_recaudacion&valor=recaudacion_primer_ano&titulo=Mayor Recaudacion En Primer Año">Primer Año</a>
                    <a href="?filtro=mayor_recaudacion&valor=recaudacion_total&titulo=Mayor Recaudacion Total ">Recaudacion Total</a>
                </div>
            </div>
            
            <div class="filter">
                <button class="filter-button button">Nacionalidad</button>
                <div class="filter-options">
                    <a href="?filtro=nacionalidad&valor=USA&titulo=Estadounidense">Estadounidense</a>
                    <a href="?filtro=nacionalidad&valor=UK&titulo=Británica">Británica</a>
                    <a href="?filtro=nacionalidad&valor=FR&titulo=Francesa">Francesa</a>
                    <a href="?filtro=nacionalidad&valor=IT&titulo=Italiana">Italiana</a>
                    <a href="?filtro=nacionalidad&valor=JP&titulo=Japonesa">Japonesa</a>
                    <a href="?filtro=nacionalidad&valor=ES&titulo=Española">Española</a>
                    <a href="?filtro=nacionalidad&valor=MX&titulo=Mexicana">Mexicana</a>
                </div>
            </div>
            
            
        </div>

        <section class="peliculas-filtradas">
            <?php if ($_GET['titulo']): ?>
                <h2><?= $_GET['titulo'] ?></h2>
            <?php else: ?>
                <h2>Selecciona un filtro</h2>
            <?php endif ?>

            <?php if(!$peliculas): ?>
                <h3>NO hay peliculas para este filtro</h3>
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
        </section>
    </main>

<?php require "./partials/footer.php" ?>

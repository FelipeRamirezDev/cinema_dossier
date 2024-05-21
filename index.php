<?php
require "./database.php";

$peliculasPremiadas = $conn->query("SELECT DISTINCT p.*, n.id_pelicula, n.resultado 
                           FROM pelicula AS p 
                           JOIN nominacion AS n 
                           ON p.id_pelicula = n.id_pelicula 
                           Where n.resultado = 'ganador'");
?>


<?php require "partials/header.php" ?>


    <section class="container">
        <div class="hero"></div>

        <div class="hero-text">
            <h1>Explora el Mundo del Cine</h1>
            <p>Descubre la magia detrás de cada película, conoce a las estrellas que las hacen brillar y sigue los eventos más glamurosos del cine.
                <br/>No te pierdas ningún detalle de las próximas galas y premios.</p>
        </div>
    </section>

    <main class="container">
        <h2 class="titulo-main">Peliculas Premiadas</h2>
        <div class="peliculas">
            <?php foreach ($peliculasPremiadas as $pelicula): ?>
                <div class="pelicula">
                    <a href="info-pelicula.php?id_pelicula=<?= $pelicula["id_pelicula"] ?>">
                        <img src="./img/portadas/<?= $pelicula["ruta_imagen"] ?>" alt="<?= $pelicula["titulo_original"] ?>">
                    </a>
                    <p><?= $pelicula["titulo_original"] ?></p>
                </div>
            <?php endforeach ?>
    </main>

<?php require "./partials/footer.php" ?>

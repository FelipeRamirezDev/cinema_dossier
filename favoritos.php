<?php
require "database.php";
require "modulos/getFavoritos.php";

session_start();

if ( !isset($_SESSION["user"])) {
  header("Location: index.php");
  return;
}

$idUser = $_SESSION["user"]["id_user"];

$peliculas = [];
$personas = [];

if ( isset($_GET['filtro']) && $_GET['valor'] == 'Peliculas') {
    $peliculas = getFavoritosPeliculas($conn, $idUser);
} else if ( isset($_GET['filtro']) && $_GET['valor'] == 'Personas') {
    $personas = getFavoritosPersonas($conn, $idUser);

} else {
    echo("Filtro invalido");
}

 ?>
        
<?php require "partials/header.php" ?>

    <main class="main-peliculas container">

        <div class="filters-menu-favoritos">
            <div class="filter">
                <button class="filter-button button">Favoritos</button>
                <div class="filter-options">
                    <a href="?filtro=favoritos&valor=Peliculas">Peliculas</a>
                    <a href="?filtro=favoritos&valor=Personas">Personas</a>
                </div>
            </div>
        </div>


        <section class="personas-filtradas">
            <?php if ($_GET['valor']): ?>
                <h2><?= $_GET['valor'] ?></h2>
            <?php else: ?>
                <h2>Selecciona un favorito</h2>
            <?php endif ?>

            <?php if(!$peliculas && !$personas): ?>
                <h3>NO hay favoritos</h3>
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

<?php require "partials/footer.php" ?>

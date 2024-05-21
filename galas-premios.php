<?php
require "./database.php";
require "./partials/header.php";
require "./modulos/getGalas.php"; 

$galas = null;

$galasPopulares = $conn->query("SELECT * FROM gala");

if (isset($_GET['filtro'])) {
    if ($_GET['filtro'] == 'todas') {
        $galas = $conn->query("SELECT * FROM gala");
    } else if ($_GET['filtro'] == 'tipo' && isset($_GET['valor'])) {
        $tipo = $_GET['valor'];
        $galas = getGalasPorTipo($conn, $tipo);
    } else if ($_GET['filtro'] == 'ano' && isset($_GET['valor'])) {
        $ano = $_GET['valor'];
        $galas = getGalasPorAno($conn, $ano);
    } else {
        echo "Filtro inválido";
        // Aquí también podrías redirigir o manejar el error de otra manera
    }
}
?>
<main class="main-galas container">
    <h2 class="titulo-main-galas">Galas y Premiaciones Más Destacadas</h2>

    <div class="filters-menu">
        <h3>Filtrar Galas Por</h3>
        <div class="filter">
            <a class="filter-button button" href="?filtro=todas&titulo=Todas">Todas</a>
        </div>
        <div class="filter">
            <button class="filter-button button">Tipo</button>
            <div class="filter-options">
                <a href="?filtro=tipo&valor=Academia&titulo=Academia">Academia</a>
                <a href="?filtro=tipo&valor=Festival&titulo=Festival">Festival</a>
            </div>
        </div>
        <div class="filter">
            <button class="filter-button button">Año de Comienzo</button>
            <div class="filter-options">
            <a href="?filtro=ano&valor=2020&titulo=2020s">2020s</a>
                    <a href="?filtro=ano&valor=2010&titulo=2010s">2010s</a>
                    <a href="?filtro=ano&valor=2000&titulo=2000s">2000s</a>
                    <a href="?filtro=ano&valor=1990&titulo=1990s">1990s</a>
                    <a href="?filtro=ano&valor=1980&titulo=1980s">1980s</a>
                    <a href="?filtro=ano&valor=1970&titulo=1970s">1970s</a>
                    <a href="?filtro=ano&valor=1960&titulo=1960s">1960s</a>
                    <a href="?filtro=ano&valor=1950&titulo=1970s">1950s</a>
                    <a href="?filtro=ano&valor=1940&titulo=1970s">1940s</a>
            </div>
        </div>
    </div>

    

    <section class="galas-filtradas">
        <?php if (isset($_GET['titulo'])): ?>
            <h2><?= $_GET['titulo'] ?></h2>
        <?php else: ?>
            <h2>Selecciona un filtro</h2>
        <?php endif ?>

        <?php if (empty($galas)): ?>
            <h3>No hay galas para este filtro</h3>
        <?php else: ?>
            <div class="galas">
                <!-- Dentro del loop donde muestras cada gala -->
                <?php foreach ($galas as $gala): ?>
                    <div class="info-gala">
                        <h3><span>Nombre de la Gala: </span><?= htmlspecialchars($gala["nombre_gala"]) ?></h3>
                        <p><span>Tipo: </span><?= htmlspecialchars($gala["tipo"]) ?></p>
                        <p><span>Nacionalidad: </span><?= htmlspecialchars($gala["nacionalidad"]) ?></p>
                        <p><span>Año de Comienzo: </span><?= htmlspecialchars($gala["ano_comienzo"]) ?></p>
                        <?php
                            echo "<p>Premiaciones de la Gala:</p>";
                            $premiaciones = getPremiacionesPorGala($conn, $gala['id_gala']);
                            foreach ($premiaciones as $premio) {
                                echo "<div><strong>{$premio['ano_edicion']} - {$premio['nombre_premio']}:</strong> {$premio['titulo_espanol']} - {$premio['nombre_artistico']} ({$premio['resultado']})</div>";
                            }
                        ?>
                    </div>
                <?php endforeach ?>

            </div>
        <?php endif ?>

    </section>
</main>


<?php require "./partials/footer.php" ?>

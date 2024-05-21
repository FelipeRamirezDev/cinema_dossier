<?php

require "database.php";

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinémaDossier - peliculas</title>
    <link rel="icon" href="img/logo2.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- libreria de swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/peliculas.css">
    <link rel="stylesheet" href="css/galas-premios.css">
</head>
<body>
    <header >
        <div class="header-grid container">
            <div class="logo-img">
                <a href="index.php">
                    <img src="img/logo.png" alt="logo">
                </a>
            </div>

            <nav class="nav-header">
                <a href="peliculas.php">PELICULAS</a>
                <a href="personas.php">PERSONAS</a>
                <a href="galas-premios.php">GALAS Y PREMIOS</a>
                <?php if (!isset($_SESSION["user"])): ?>
                    <a href="partials/login.php">INICIAR SESION</a>
                <?php endif ?>
                
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="favoritos.php?<?= $_SESSION["user"]["id_user"] ?>">FAVORITOS</a>
                    <a href="partials/logout.php">CERRAR SESION</a>
                <?php endif ?>
            </nav>
            
            <form action="search.php" class="search-form">
                <div class="search-box">
                    <input class="search-input" type="search" name="q" placeholder="Buscar..." aria-label="Buscar">
                    <button type="submit" class="search-button">
                        <img src="./img/icons/icon-search.svg" alt="Buscar" />
                    </button>
                </div>
            </form>
                   
        </div>
    </header>
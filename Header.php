<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Sesion</title>
    <link rel="stylesheet" href="estilos/tabla.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/estiloheader.css">
    <link rel="stylesheet" href="libreria/css/bootstrap.min.css">
    <script type="text/javascript" src="libreria/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libreria/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="estilos/referencias.css">

</head>
<body>

<?php

session_start();
?>
<header>

    <section  id="menu">
        <ul>

            <form id="busqueda" method="post" action="SearchNews.php">
                <label for="bus">Buscar: <input name="busqueda" id="bus" type="text"></label>
                <button class="btn">
                    Ir.
                </button>
            </form>
        </ul>
    </section>
</header>

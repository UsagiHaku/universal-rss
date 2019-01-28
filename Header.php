<!DOCTYPE html>
<?php
$connection = new mysqli("localhost", "root", "", "UniversalDB");

$result = mysqli_query($connection, "Select * from NewsInfo");
$array = array();
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $tittle = $row['title'];
        array_push($array, $tittle);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Sesion</title>
    <link rel="stylesheet" href="estilos/tabla.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="estilos/estiloheader.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="libreria/css/bootstrap.min.css">
    <script type="text/javascript" src="libreria/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libreria/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="estilos/referencias.css">
    <script type="text/javascript" src="Validate.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            var items = [
                <?= json_encode($array); ?>
            ];
            $("#bus").autocomplete({
                source: items[0]
            });
        });
    </script>

</head>
<body>

<?php

session_start();
?>
<header>

    <section id="menu">
        <ul>

            <form id="busqueda" method="post" autocomplete="on" action="SearchNews.php">
                <label for="bus">Buscar: <input name="busqueda" id="bus" autocomplete="on" type="text"></label>
                <button class="btn" id="botonEnvio">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </ul>
    </section>

</header>

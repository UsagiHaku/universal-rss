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
    <link rel="stylesheet" href="css/Main.css">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/jquery-ui-dist/jquery-ui.min.css">

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
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
    <div class="container"></div>

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

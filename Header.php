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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

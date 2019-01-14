
<?php

if(isset($_POST['busqueda'])){
    $id = $_POST['busqueda'];
    $conexion = new mysqli("localhost", "root", "", "UniversalDB");
    $consulta = "SELECT description, title, date, link FROM NewsInfo WHERE title='$id'";
    $realizarConsulta = mysqli_query($conexion, $consulta);
    if($aValues = mysqli_fetch_array($realizarConsulta)){
        ?>
        <center>

            <p>Titulo:  <br> <?php echo $aValues["title"];?></p><br>
            <p> Descripción: <br> <?php echo $aValues["description"]; ?></p>
            <p>Contenido: <br>
                <?php echo $aValues['link']; ?> </p>
            <p> Fecha: <br> <?php echo $aValues["date"] ?></p>
            <a style="
    margin: auto;
    padding-top: 10px;
    text-decoration: none;
    font: 16px Verdana;
    padding: 10px;
      background: #5F9EA0;
    color: white;
    border-bottom: 8px solid transparent;
    -webkit-transition: border-bottom .7s;
    " id="return" href="Main.php">Regresar</a>

        </center>
        <?php
    }
}
else{
    echo "no";
}

?>
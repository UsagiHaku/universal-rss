<?php require "UpdateDB.php"; ?>
<?php require "Header.php"; ?>


<form class="container col-lg-12" style="border:0; margin-top:10px;" action="DeleteNews.php" id="tablas" method="post">


    <div class="visible-lg visible-md col-lg-11 container" id="container">
        <div class="table-responsive">

            <table class="table hidden-md" >
                <tr>
                    <td id="titulo" colspan="6"> Noticias</td>
                </tr>
                <theader id="encabezado">
                    <th>Eliminar</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                    <!---<th>Apellido</th>
                    <th>Asignatura</th>
                    <th>Calificación</th>-->
                </theader>
                <tbody>

                <?php


                $info = "";
                $mysqli = new mysqli("localhost", "root", "", "UniversalDB");

                if(!$mysqli){
                    $info = "No se pudo realizar la conexión";

                }else{
                    $sql = "SELECT id, description, title, date, link FROM NewsInfo";
                    $resultado = $mysqli->query($sql);
                    while($aValues = mysqli_fetch_assoc($resultado)){

                        echo "<tr>" . "<td><input type='radio' value='{$aValues['id']}' name='not'></td>" .
                            "<td>" . $aValues["title"] . "</td> " . "<td>". $aValues["description"] . "</td>"
                            . "<td><a href=". $aValues["link"] .">" . $aValues["link"] . "</a></td>" . "<td>" . $aValues["date"] .  "</tr>";

                    }


                    $resultado->free();
                    $mysqli->close();
                }



                ?>
                </tbody>
            </table>
        </div>
        <section class="input-group">
            <button type="submit" name="register" class="btn">Eliminar</button>
        </section>
    </div>
</form>

</body>
</html>
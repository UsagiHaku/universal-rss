<?php require "NewsController.php"; ?>
<?php require "Header.php"; ?>

<?php $controller = new NewsController(); ?>

<form class="container col-lg-12" style="border:0; margin-top:10px;" action="DeleteNews.php" id="tablas" method="post">


    <div class="visible-lg visible-md col-lg-11 container" id="container">
        <div class="table-responsive">

            <table class="table hidden-md" >
                <tr>
                    <td id="titulo" colspan="6"> Noticias</td>
                </tr>
                <theader id="encabezado">
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                </theader>
                <tbody>

                <?php

                $news = $controller->get_news();

                for($i = 0; $i<count($news); $i++) {
                    $currentNew = $news[$i];
                    echo  "<tr>"
                        . "<td>" . $currentNew->title . "</td> " . "<td>". $currentNew->description . "</td>"
                        . "<td><a href=". $currentNew->link .">" . $currentNew->link . "</a></td>" . "<td>" . $currentNew->date
                        . "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

</body>
</html>
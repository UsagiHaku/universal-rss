
<?php
 require "NewsController.php";

if(isset($_POST['busqueda'])){
    $id = $_POST['busqueda'];

    $controller = new NewsController();

    $news = $controller->get_news_by_id($id);

    if($news != null){
        echo
        "<center>".


            "<p>Titulo:<br>" . $news-> title. "</p><br>".
            "<p>Descripción: <br>". $news->description."</p>
            <p>Contenido: <br><a href=" . $news->link .">". $news->link."</a></p>
            <p> Fecha: <br>".  $news->date ."</p>"; ?>

            <a id="return" href= "Main.php" > Regresar</a>
            <?php
        echo

       "</center>";

    }
}
else{
    echo "no existe tal noticia";
}

?>
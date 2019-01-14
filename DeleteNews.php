<?php
if(isset($_POST['not'])){
    $id = $_POST['not'];
    $conexion = new  mysqli( "localhost", "root", "", "UniversalDB");

    $consulta = "delete from noticias where id='$id'";
    if(mysqli_query($conexion, $consulta)){
        echo 'dato eliminado';

    }else{
        echo 'el dato no existe';
    }

}else{
    echo 'seleccione un dato a eliminar';
}

?>
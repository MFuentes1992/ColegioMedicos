<?php
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(isset($_POST["id_usuario"])){
        $id = GetSQLValueString($conexion, $_POST["id_usuario"], "text");
        $strQuery = sprintf("UPDATE usuarios SET estatus_usuario = %s WHERE id_usuario = %s",
        2,
        $id);
        $result = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        if($result){
            header("Location:".$url."signin/");
        }else{
            header("Location:".$url);
        }
    }
?>
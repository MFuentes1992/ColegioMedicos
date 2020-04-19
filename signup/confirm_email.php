<?php
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(isset($_POST["email_usuario"])){
        $email = GetSQLValueString($conexion, $_POST["email_usuario"], "text");
        $strQuery = sprintf("UPDATE usuarios SET estatus_usuario = %s WHERE email_usuario = %s",
        2,
        $email);
        $result = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        if($result){
            header("Location:".$url."signin/");
        }else{
            header("Location:".$url);
        }
    }
?>
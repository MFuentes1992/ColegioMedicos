<?php 
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(isset($_POST["nombre_usuario"]) && isset($_POST["apellido_usuario"]) && isset($_POST["email_usuario"]) && 
        isset($_POST["tel_usuario"]) && isset($_POST["cedula_usuario"]) && isset($_POST["titulo_usuario"]) && isset($_POST["nacimiento_usuario"])){
        $srtUpdate = sprintf("UPDATE usuarios SET nombre_usuario = %s, apellido_usuario = %s, email_usuario = %s, tel_usuario = %s, cedula_usuario = %s, titulo_usuario = %s, nacimiento_usuario = %s WHERE id_usuario = %s",
        GetSQLValueString($conexion, $_POST["nombre_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["apellido_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["email_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["tel_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["cedula_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["titulo_usuario"], "text"),
        GetSQLValueString($conexion, $_POST["nacimiento_usuario"], "date"),
        GetSQLValueString($conexion, $_POST["id_usuario"], "int")
        );
        $result = mysqli_query($conexion, $srtUpdate) or die(mysqli_error($conexion));
        if($result){
            $strQuery = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s",
            GetSQLValueString($conexion, $_POST["id_usuario"], "int"));
            $raw = mysqli_query($conexion, $strQuery) or die(mysqli_query($conexion));
            session_start();
            $_SESSION["usuario"] = mysqli_fetch_assoc($raw);
            header("Location:".$url."editinfo/editsuccess/");
        }else{
            header("Location:".$url."editinfo/editfailed/");
        }
    }else{
        header("Location:".$url."editinfo/editfailed/");
    }
?>
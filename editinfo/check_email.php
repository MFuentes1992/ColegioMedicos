<?php 
        include_once('../util/DAO.php');
        include_once('../util/utilities.php');
        include_once('../util/funciones.php');
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        if(isset($_POST["email_usuario"]) && isset($_POST["id_usuario"])){
            $strQuery = sprintf("SELECT * FROM usuarios WHERE email_usuario = %s AND id_usuario = %s",
            GetSQLValueString($conexion, $_POST["email_usuario"], "text"),
            GetSQLValueString($conexion, $_POST["id_usuario"], "int"));
            $raw = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
            $foud = mysqli_fetch_assoc($raw)["email_usuario"];
            if(strlen($foud) > 0 ){
                $response = array('taken' => 1);
                echo json_encode($response, JSON_FORCE_OBJECT);
            }else{
                $response = array('taken' => 0);
                echo json_encode($response, JSON_FORCE_OBJECT);
            }
        } else echo "No params";
?>
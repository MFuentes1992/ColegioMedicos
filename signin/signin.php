<?php 
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(isset($_POST["Email"])){
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
        $strQuery = sprintf("SELECT * FROM usuarios WHERE email_usuario = %s",
        GetSQLValueString($conexion, $Email, "text"));
        $raw = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        $result = mysqli_fetch_assoc($raw);

        $_PWD = GetSQLValueString($conexion, $_POST["Password"], "text");
        $_verify = password_verify( $_PWD, mysqli_fetch_assoc($raw)["password_usuario"] );

        if( $_verify ){
            session_start();
            $_SESSION["usuario"] = $result;
            header("Location:http://localhost/ColegioMedicos/dashboard/");
        }else{
            header("Location:http://localhost/ColegioMedicos/signin/");
        }
    } else {
        header("Location:http://localhost/ColegioMedicos/signin/");
    }
?>
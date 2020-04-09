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
        $strQuery = sprintf("SELECT * FROM usuarios WHERE email_usuario = %s AND password_usuario = %s",
        GetSQLValueString($conexion, $Email, "text"),
        GetSQLValueString($conexion, $Password, "text"));
        $raw = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        $result = mysqli_fetch_assoc($raw);
        session_start();
        $_SESSION["usuario"] = $result;
        header("Location:http://localhost/ColegioMedicos/dashboard/");
    } else {
        header("Location:http://localhost/ColegioMedicos/signin/");
    }
?>
<?php 
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if(isset($_POST["FirstName"])){
        $FirstName = $_POST["FirstName"];
        $LastName = $_POST["LastName"];
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
        $Cedula = $_POST["Cedula"];
        $Titulo = $_POST["Titulo"];
        $BirthDate = $_POST["BirthDate"];
        $now = date("Y-m-d");

        $strQuery = sprintf("INSERT INTO usuarios (nombre_usuario, apellido_usuario, email_usuario,
        password_usuario, tel_usuario, cel_usuario, cedula_usuario, titulo_usuario, nacimiento_usuario, estatus_usuario, isAdmin, 
        fecha_registro, fecha_actualizacion, avatar_usuario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, NOW(), NOW(), %s)",
        GetSQLValueString($conexion, $FirstName, "text"),
        GetSQLValueString($conexion, $LastName, "text"),
        GetSQLValueString($conexion, $Email, "text"),
        GetSQLValueString($conexion, $Password, "text"),
        "'+52777'",
        "'+52777'",
        GetSQLValueString($conexion, $Cedula, "text"),
        GetSQLValueString($conexion, $Titulo, "text"),
        GetSQLValueString($conexion, $BirthDate, "date"),
        1,
        0,
        GetSQLValueString($conexion, $now, "date"),
        GetSQLValueString($conexion, $now, "date"),
        "'avatar'");
        $result = mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion));
        echo $result;
    }
?>
<?php 
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if(isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Email"]) && isset($_POST["Password"]) && isset( $_POST["Telefono"] ) 
        && isset( $_POST["Cedula"] ) && isset( $_POST["Titulo"] ) && isset( $_POST["BirthDate"] ) ){
        $FirstName = $_POST["FirstName"];
        $LastName = $_POST["LastName"];
        $Email = $_POST["Email"];
        $Password = password_hash(GetSQLValueString($conexion, $_POST["Password"], "text"), PASSWORD_DEFAULT);
        $Telefono = $_POST["Telefono"];
        $Cedula = $_POST["Cedula"];
        $Titulo = $_POST["Titulo"];
        $BirthDate = $_POST["BirthDate"];
        $now = date("Y-m-d");

        $strQuery = sprintf("INSERT INTO usuarios (nombre_usuario, apellido_usuario, email_usuario,
        password_usuario, tel_usuario, cel_usuario, cedula_usuario, titulo_usuario, nacimiento_usuario, estatus_usuario, isAdmin, 
        fecha_registro, fecha_actualizacion, avatar_usuario) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), NOW(), %s)",
        GetSQLValueString($conexion, $FirstName, "text"),
        GetSQLValueString($conexion, $LastName, "text"),
        GetSQLValueString($conexion, $Email, "text"),
        "'$Password'",
        GetSQLValueString($conexion, $Telefono, "text"),
        "'+52777'",
        GetSQLValueString($conexion, $Cedula, "text"),
        GetSQLValueString($conexion, $Titulo, "text"),
        GetSQLValueString($conexion, $BirthDate, "date"),
        1,
        0,
        GetSQLValueString($conexion, $now, "date"),
        GetSQLValueString($conexion, $now, "date"),
        "'default'");
        $result = false;

        // Search if the user is not already registered
        $strSearchForUser = sprintf("SELECT * FROM usuarios WHERE email_usuario = %s", GetSQLValueString($conexion, $Email, "text"));
        $rawDuplicate = mysqli_query($conexion, $strSearchForUser) or die(mysqli_error($conexion));
        $duplicateResult = mysqli_fetch_assoc($rawDuplicate);

        //If the user is already registered, then will not make the insert
        $result = $duplicateResult == null ? mysqli_query($conexion, $strQuery) or die(mysqli_error($conexion)) : false;
        
        if($result){            
            $strQueryUser = sprintf("SELECT * FROM usuarios WHERE email_usuario = %s",
            GetSQLValueString($conexion, $Email, "text"));
            $raw = mysqli_query($conexion, $strQueryUser) or die(mysqli_error($conexion));
            $result = mysqli_fetch_assoc($raw);
            $_PWD = GetSQLValueString($conexion, $_POST["Password"], "text");
            $_verify = password_verify( $_PWD, $result["password_usuario"] );
            echo $_verify;
            if( $_verify ){                
                session_start();
                $_SESSION["usuario"] = $result;
                $email = $Email;
                $myfile = fopen("../audit.txt", "w+") or die("Unable to open file!");
                fwrite($myfile, "New user\n");
                $userName = "Nombre:".$FirstName."|";
                fwrite($myfile, $userName);
                //////////////////////// SEND CONFIRMATION MAIL //////////////////////////
                // Varios destinatarios
                    $para = $Email;
                // título
                    $título = 'Confirmar Email';
                // mensaje
                    $mensaje = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Confirm Email</title>
                        <style>
                            .header{
                                width: 100%;
                                background-color: #212529;            
                                text-align: center;
                                color: #FFF;
                                vertical-align: middle;
                            }
                            .body{
                                position: relative;
                                width: 70%;
                                margin: auto;
                                border: 1px solid black;
                                padding: 5%;
                            }
                            table{
                                width: 100%;
                            }
                            th, td{
                                text-align: justify;
                            }
                            h1{
                                text-align: center;
                            }
                            #logoImg{
                                width: 100px;
                                height: 100px;            
                                border-radius: 50%;
                                border: 2px solid #FFF;
                            }
                            button{
                                background-color: #212529;
                                color: #FFF;
                                width: 200px;
                                height: 50px;
                                border-radius: 5px;
                                cursor: pointer;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h1>Colegio de Médicos Morelos</h1>
                            <img src="http://colegiomedicosmorelos.org/img/logo.jpg" alt="" id="logoImg">
                        </div>
                        <div class="body">
                            <form action="'.$url.'signup/confirm_email.php" method="POST">
                                <h3>¡ Gracias por registrarte !</h3>
                                <p>
                                    clic en el enlace de abajo para confirmar tu email.
                                </p>
                                <input type="hidden" name="email_usuario" value="'.$email.'">
                                <button>Confirmar Email</button>
                            </form>
                        </div>
                    </body>
                    </html>
                    ';
                
                // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";    
                    $cabeceras .= 'Reply-To: noreplay@colegiosmedicos.com'. "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                
                // Cabeceras adicionales
                    $cabeceras .= 'From: Colegio de Médicos Morelos <colegiomedicosmorelos@gmail.com>' . "\r\n";

                    // Enviarlo
                    $success = mail($para, $título, $mensaje, $cabeceras);
                    fwrite($myfile, $para);     
                    //
                    if ($success) {        
                        fwrite($myfile, "|Confirmation email Sent:1\n");
                    }else{
                        $errorMessage = error_get_last()['message'];
                        fwrite($myfile, "|Confirmation email Sent:0\n");
                    }
                    fclose($myfile);  
                    header("Location:".$url."dashboard/");
            }else{
                header("Location:".$url."signup/");
            }

        } echo "Usuario ya registrado";
    }
?>
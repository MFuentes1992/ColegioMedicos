<?php
// Varios destinatarios
    $para = "";
// título
    $título = 'Nuevo Email';
// mensaje
    $mensaje = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Colegio de Médicos Morelos</h1>
            <img src="img/logo.jpg" alt="" id="logoImg">
        </div>
        <div class="body">
            <h3>¡ Gracias por registrarte !</h3>
            <p>
                clic en el enlace de abajo para confirmar tu email.
            </p>
            <a href="'.$url.'/signup/confirm.php?id='.$id.'">confirmar email</a>
        </div>
    </body>
    </html>
    ';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";    
    $cabeceras .= 'Reply-To: noreplay@colegiosmedicos.com'. "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
    $cabeceras .= 'From: Medica Integral Sur <colegiomedicosmorelos@gmail.com>' . "\r\n";

// Enviarlo
    $success = mail($para, $título, $mensaje, $cabeceras);
    if ($success) {        
        echo json_encode(array('success' => 1));
    }else{
        $errorMessage = error_get_last()['message'];
        echo json_encode(array('success' => 0, 'message' => $errorMessage));
    }
?>
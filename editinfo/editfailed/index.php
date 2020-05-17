<?php 
    session_start();
    include_once('../../util/DAO.php');
    include_once('../../util/utilities.php');
    include_once('../../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");    
    if(!isset($_SESSION["usuario"])){
        header("Location:".$url."signin/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio de Médicos del Estado de Morelos A.C.</title>
    <link rel="stylesheet" href="../../css/master.css">    
    <link rel="stylesheet" href="../../css/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="dashboard">
    <div class="vertical-menu">
        <div class="dash-close-responsive-menu">
            <div class="cross-btn-dash" onclick="hideMenu()">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="dashboard-title">
            <h1>Colegio Médicos</h1>
        </div>
        <div class="row menu-item">
            <div class="user-img">
                <img src="" alt="">
            </div>
        </div>
        <div class="row menu-item">
            <div class="col-lg-12 col-md-12 col-sm-12 menu-element">
                <a href="../../dashboard/" class="dash-item">
                    <span><i class="fas fa-columns"></i>&nbsp;&nbsp;Dashboard</span>
                </a>
            </div>
        </div>
        <div class="row menu-item">
            <div class="col-lg-12 col-md-12 col-sm-12 menu-element">
                <a href="../dashboard/exit.php" class="dash-item">
                    <span class="dash-item"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Salir</span>
                </a>
            </div>
        </div>
    </div>
    <div class="dash-responsive-menu">
        <div class="toggle-button-container">
            <div class="toggle-button" onclick="showMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
    <div class="dashboard-panel-edit">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div style="text-align:center;"><strong><i class="fas fa-robot"></i></strong> Algo salio mal...</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="panel-info">
            <div class="card-info">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <img src="../../img/avatar/avatar.jpg" alt="Avatar medico" width="200" class="rounded mx-auto d-block">
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <form action="update.php" method="post" class="form-submit edit-info-form">
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre</label>
                                <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" value="<?=$_SESSION["usuario"]["nombre_usuario"]?>">
                                <small id="nombre_usuario_validation" class="required hidden">Por favor ingresa un Nombre.</small>
                            </div>
                            <div class="form-group">
                                <label for="apellido_usuario">Apellido</label>
                                <input type="text" id="apellido_usuario" name="apellido_usuario" class="form-control" value="<?=$_SESSION["usuario"]["apellido_usuario"]?>">
                                <small id="apellido_usuario_validation" class="required hidden">Por favor ingresa un Apellido.</small>
                            </div>
                            <div class="form-group">
                                <label for="email_usuario">Email</label>
                                <input type="text" id="email_usuario" name="email_usuario" class="form-control" value="<?=$_SESSION["usuario"]["email_usuario"]?>">
                                <small id="email_usuario_validation" class="required hidden">Por favor ingresa tu correo electrónico.</small>
                                <small id="email_usuario_taken" class="required hidden">El correo electrónico ya se ha registrado.</small>
                            </div>
                            <div class="form-group conf_email_usuario hidden">
                                <label for="con_email_usuario">Confirmar Email</label>
                                <input type="text" id="con_email_usuario" name="con_email_usuario" class="form-control" value="">
                                <small id="con_email_usuario_validation" class="required hidden">Por favor confirma tu correo electrónico.</small> 
                                <small id="con_email_usuario_no_coincidence" class="required hidden">El correo electrónico no coincide.</small>                               
                            </div>                            
                            <div class="form-group">
                                <label for="tel_usuario">Teléfono</label>
                                <input type="text" id="tel_usuario" name="tel_usuario" class="form-control" value="<?=$_SESSION["usuario"]["tel_usuario"]?>">
                                <small id="tel_usuario_validation" class="required hidden">Por favor ingresa tu teléfono.</small>
                            </div>
                            <div class="form-group">
                                <label for="cedula_usuario">Cédula</label>
                                <input type="text" id="cedula_usuario" name="cedula_usuario" class="form-control" value="<?=$_SESSION["usuario"]["cedula_usuario"]?>">
                                <small id="cedula_usuario_validation" class="required hidden">Por favor ingresa tu cédula.</small>
                            </div>
                            <div class="form-group">
                                <label for="titulo_usuario">Título</label>
                                <input type="text" id="titulo_usuario" name="titulo_usuario" class="form-control" value="<?=$_SESSION["usuario"]["titulo_usuario"]?>">
                                <small id="titulo_usuario_validation" class="required hidden">Por favor ingresa tu título.</small>
                            </div>
                            <div class="form-group">
                                <label for="nacimiento_usuario">Fecha de nacimiento</label>
                                <input type="date" id="nacimiento_usuario" name="nacimiento_usuario" class="form-control" value="<?=$_SESSION["usuario"]["nacimiento_usuario"]?>">
                                <small id="nacimiento_usuario_validation" class="required hidden">Por favor ingresa tu fecha de nacimiento.</small>
                            </div>
                            <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$_SESSION["usuario"]["id_usuario"]?>">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    var previousEmail = "";
    var flag_conf_email = false;
    $(document).ready(function(){
        previousEmail = $('#email_usuario').val();
    });

    const hideMenu = () =>{  
        $('.cross-btn-dash').css('visibility', 'hidden');      
        $('.vertical-menu').animate({
            width: "0px",
        },
        {
            duration: 300,
            easing: "linear",
            complete: function(){
                $('.vertical-menu').css('visibility', 'hidden');
            }
        });
    }
    const showMenu = () =>{
        $('.vertical-menu').css('visibility', 'visible');
        $('.cross-btn-dash').css('visibility', 'visible');
        $('.vertical-menu').animate({
            width: "100%",
        },
        {
            duration: 300,
            easing: "linear",
            complete: function(){                
            }
        });
    }
    $('.edit-info-form').submit(function(event){
        var validaNombre = false;
        var validaApellido = false;
        var validaMail = false;        
        var validaTelefono = false;
        var validaCedula = false;
        var validaTitulo = false;
        var validaBD = false;
        var validaConEmail = false;

        var _FirstName = $('#nombre_usuario').val();
        if(_FirstName == ''){
            $('#nombre_usuario').addClass('required');
            $('#nombre_usuario').removeClass('good');
            $('#nombre_usuario_validation').removeClass('hidden');
            validaNombre = false;
        } else {
            $('#nombre_usuario').removeClass('required');
            $('#nombre_usuario').addClass('good');
            $('#nombre_usuario_validation').addClass('hidden');
            validaNombre = true;
        }
        var _LastName = $('#apellido_usuario').val();
        if(_LastName == ''){
            $('#apellido_usuario').addClass('required');
            $('#apellido_usuario').removeClass('good');
            $('#apellido_usuario_validation').removeClass('hidden');
            validaApellido = false;
        } else {
            $('#apellido_usuario').removeClass('required');
            $('#apellido_usuario').addClass('good');
            $('#apellido_usuario_validation').addClass('hidden'); 
            validaApellido = true;
        }
        var _Email = $('#email_usuario').val();
        if(_Email == ''){
            $('#email_usuario').addClass('required');
            $('#email_usuario_validation').removeClass('hidden');
            $('#email_usuario_validation').css('display', 'block');
            $('#email_usuario_Taken').addClass('hidden');
            $('#email_usuario').removeClass('good');
            validaMail = false;
        } else {
            $('#email_usuario').removeClass('required');
            $('#email_usuario').addClass('good');
            $('#email_usuario_validation').addClass('hidden'); 
            validaMail = true;
        }
        var _Cedula = $('#cedula_usuario').val();
        if(_Cedula == ''){
            $('#cedula_usuario').addClass('required');
            $('#cedula_usuario').removeClass('good');
            $('#cedula_usuario_validation').removeClass('hidden');
            validaCedula = false;
        } else {
            $('#cedula_usuario').removeClass('required');
            $('#cedula_usuario').addClass('good');
            $('#cedula_usuario_validation').addClass('hidden'); 
            validaCedula = true;
        }
        var telefono = $('#tel_usuario').val();
        if(telefono == ''){
            $('#tel_usuario').addClass('required');
            $('#tel_usuario').removeClass('good');
            $('#tel_usuario_validation').removeClass('hidden');
            validaTelefono = false;
        } else {
            $('#tel_usuario').removeClass('required');
            $('#tel_usuario').addClass('good');
            $('#tel_usuario_validation').addClass('hidden'); 
            validaTelefono = true;
        }
        var _Titulo = $('#titulo_usuario').val();
        if(_Titulo == ''){
            $('#titulo_usuario').addClass('required');
            $('#titulo_usuario').removeClass('good');
            $('#titulo_usuario_validation').removeClass('hidden');
            validaTitulo = false;
        } else {
            $('#titulo_usuario').removeClass('required');
            $('#titulo_usuario').addClass('good');
            $('#titulo_usuario_validation').addClass('hidden'); 
            validaTitulo = true;
        }
        var _BirthDate = $('#nacimiento_usuario').val();
        if(_BirthDate == ''){
            $('#nacimiento_usuario').addClass('required');
            $('#nacimiento_usuario').removeClass('good');
            $('#nacimiento_usuario').removeClass('hidden');
            validaBD = false;
        } else {
            $('#nacimiento_usuario').removeClass('required');
            $('#nacimiento_usuario').addClass('good');
            $('#nacimiento_usuario_validation').addClass('hidden'); 
            validaBD = true;
        }  

        if(flag_conf_email){
            var _con_Email = $('#con_email_usuario').val();
            if(_con_Email == ''){
                $('#con_email_usuario_validation').removeClass('hidden');
                $('#con_email_usuario').addClass('required');
                $('#con_email_usuario').removeClass('good');
                validaConEmail = false;
            }else{
                $('con_email_usuario_validation').addClass('hidden');
                $('#con_email_usuario').removeClass('good');
                validaConEmail = true;
            }

            if(!validaNombre || !validaApellido || !validaMail || !validaTelefono || !validaCedula || !validaTitulo || !validaBD || !validaConEmail){
                event.preventDefault();            
            }    
        }else {
            if(!validaNombre || !validaApellido || !validaMail || !validaTelefono || !validaCedula || !validaTitulo || !validaBD ){
                event.preventDefault();            
            }    
        }
        
        $('html').animate({
            scrollTop:0            
        }, 500, function(){
        });
        if(flag_conf_email)
            return validaNombre && validaApellido && validaMail && validaTelefono && validaCedula && validaTitulo && validaBD && validaConEmail;
        else
            return validaNombre && validaApellido && validaMail && validaTelefono && validaCedula && validaTitulo && validaBD;
    });

    $('#email_usuario').blur(function(){
        const _data = {
            email_usuario: $('#email_usuario').val(),
            id_usuario: $('#id_usuario').val()
        }
        $.ajax({
            data: _data,
            method: 'POST',
            //url: 'http://localhost/ColegioMedicos/editinfo/check_email.php'
            url: 'http://colegiomedicosmorelos.org/editinfo/check_email.php'
        }).done(function(msg){            
            const obj = JSON.parse(msg);
            if(obj.taken === 0){
                if(previousEmail != $('#email_usuario').val()){
                    $('.conf_email_usuario').removeClass('hidden');
                    $('.conf_email_usuario').css('display','block');
                    $('.conf_email_usuario').css('visibility', 'visible'); 
                    $('#con_email_usuario').addClass('required');
                    flag_conf_email = true;
                } 
            }else{
                $('#email_usuario_Taken').removeClass('hidden');
            }
        });      
    });

    $('#con_email_usuario').blur(function(){  
        if( $('#con_email_usuario').val() != $('#email_usuario').val() ) {
            $('#con_email_usuario_no_coincidence').removeClass('hidden');
        }  else {
            $('#con_email_usuario_no_coincidence').addClass('hidden');
            $('#con_email_usuario').removeClass('required');
            $('#con_email_usuario').addClass('good');
        }   
    });

    $('.alert').alert();
</script>
</html>
<?php 
    session_start();
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
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
    <link rel="stylesheet" href="../css/master.css">    
    <link rel="stylesheet" href="../css/fontawesome-free-5.13.0-web/css/all.css">
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
                <a href="../editinfo/" class="dash-item">
                    <span><i class="fas fa-edit"></i>&nbsp;&nbsp;Editar informacion</span>
                </a>
            </div>
        </div>
        <div class="row menu-item">
            <div class="col-lg-12 col-md-12 col-sm-12 menu-element">
                <a href="exit.php" class="dash-item">
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
    <div class="dashboard-panel">
        <div class="panel-video">
            <div class="card-video">
                <a href="https://us04web.zoom.us/j/8904002442?pwd=QTRqb3Zvam1MNGRabk9mRnJoY1V5Zz09">
                    <img src="../img/backgrounds/zoom.png" alt="Zoom Meeting" width="400">
                </a>
                <div class="video-footer">
                    <a href="https://us04web.zoom.us/j/8904002442?pwd=QTRqb3Zvam1MNGRabk9mRnJoY1V5Zz09 " class="white no-hover">Unete a la session de zoom</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script>
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
</script>
</html>
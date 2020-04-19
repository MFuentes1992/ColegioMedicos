<?php 
    include_once('../util/DAO.php');
    include_once('../util/utilities.php');
    include_once('../util/funciones.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    session_start();
    if(!isset($_SESSION["usuario"]["email_usuario"])){
        header("Location:".$url."signin/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/master.css">    
    <link rel="stylesheet" href="../css/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="dashboard">
    <div class="vertical-menu">
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
                <span><i class="fas fa-edit"></i>&nbsp;&nbsp;Editar informacion</span>
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
    <div class="dashboard-panel">
        <div class="panel-video">
            <div class="card-video">
            <iframe width="800" height="400" src="https://www.youtube.com/embed/qM8RYN1MAh8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</body>
</html>
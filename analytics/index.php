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
    }else{
        $strQuery = sprintf("SELECT * FROM usuarios");
        $strResult = mysqli_query($conexion, $strQuery)or die(mysqli_error($conexion));        
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
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="../css/mdb.min.css">
    <!-- MDBootstrap Datatables  -->
    <link href="../css/addons/datatables.min.css" rel="stylesheet">
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
                <a href="../dashboard/" class="dash-item">
                    <span><i class="fas fa-columns"></i>&nbsp;&nbsp;Dashboard</span>
                </a>
            </div>
        </div>
        <div class="row menu-item">
            <div class="col-lg-12 col-md-12 col-sm-12 menu-element">
                <a href="../editinfo/" class="dash-item">
                    <span><i class="fas fa-edit"></i>&nbsp;&nbsp;Editar informacion</span>
                </a>
            </div>
        </div>
        <?php if($_SESSION["usuario"]["isAdmin"] == 1){ ?>
        <div class="row menu-item">
            <div class="col-lg-12 col-md-12 col-sm-12 menu-element">
                <a href="../analytics/" class="dash-item">
                <i class="fas fa-chart-bar"></i>&nbsp;&nbsp;Analytics</span>
                </a>
            </div>
        </div>  
        <?php }?>      
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
    <div class="dashboard-panel">
        <div class="panel-analytics">
            <div class="card-analytics">
                <h2>
                    Analytics
                </h2>
                <table class="analytics-table table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>                            
                            <th>Telefono</th>
                            <th>Celular</th>
                            <th>Cedula</th>
                            <th>Titulo</th>
                            <th>Fecha nacimiento</th>
                            <th>Estatus</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($strResult)){
                            echo '<tr>';
                            echo '<td>'.$row["id_usuario"].'</td>';
                            echo '<td>'.$row["nombre_usuario"].'</td>';
                            echo '<td>'.$row["apellido_usuario"].'</td>';
                            echo '<td>'.$row["email_usuario"].'</td>';                            
                            echo '<td>'.$row["tel_usuario"].'</td>';
                            echo '<td>'.$row["cel_usuario"].'</td>';
                            echo '<td>'.$row["cedula_usuario"].'</td>';
                            echo '<td>'.$row["titulo_usuario"].'</td>';
                            echo '<td>'.$row["nacimiento_usuario"].'</td>';
                            echo '<td>'.$row["estatus_usuario"].'</td>';
                            echo '</tr>';
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
    <!-- jQuery -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="../js/addons/datatables.min.js"></script>
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

    $(document).ready(function () {
        $('.analytics-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
</html>
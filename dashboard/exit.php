<?php 
    include_once('../util/utilities.php');
    session_start();
    session_unset();

    // destroy the session
    session_destroy();
    if(!isset($_SESSION['usuario'])){
        header("Location:".$url."signin/");
    }
?>
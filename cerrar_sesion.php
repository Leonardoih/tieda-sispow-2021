<?php

        require_once "control/CtlrSesiones.php";
        $ctrlsesion = new CtlrSesiones();
        $fecha = date("d/ m/ Y");
        $hora = date("g:i:s A");
        $sesion = $ctrlsesion->sesionFin($fecha,$hora);


        echo $fecha.$hora."<br>";
        echo $sesion;
        
        session_start();
        unset($_SESSION["login"]);
        session_destroy($_SESSION["login"]);
        header("location:index.php");
?>
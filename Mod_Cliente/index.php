<?php

        global $rutaHtml;
        $rutaHtml = "";

    require "inclu/header.php";

    if(isset($_SESSION['Nivel'])){

        if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){

        //echo "<h3>COMPROBANDO LA CONEXIÓN BASICA A LA BBDD ".$db_name."</h3>";
            require "inclu/indexCuerpo.php";

        }else{
            require 'inclu/table_permisos.php';
        }
    }else{
        require 'inclu/table_permisos.php';
    }

    require "inclu/footer.php"

?>
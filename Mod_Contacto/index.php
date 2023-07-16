<?php
session_start();
 
    global $ruta;
    $ruta = "";
    require "inclu/head.php";

?>

    <!-- -->
    <script src="miJs/comentCount.js"></script>
    <!--  -->
    <script src="miJs/modificaCount.js"></script>

<?php
    
    if(isset($_SESSION['Nivel'])){

        if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){
                            
            //echo "<h3>COMPROBANDO LA CONEXIÓN BASICA A LA BBDD ".$db_name."</h3>";
            require "www/tablesHead.php";
            require "www/formModif.php";
            require "www/formContacto.php";

        }else{
            require 'inclu/table_permisos.php';
        }
    }else{
        require 'inclu/table_permisos.php';
    }

?>

    <script>
        var rut = "www/";
    </script>
    <script src="miJS/datos.js"></script>

<?php

    require "inclu/footer.php"

?>
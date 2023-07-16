<?php

function retornarConexion(){

  global $conexion;   global $db; global $ruta;

    if(file_exists($ruta."../Mod_Admin/Conections/conection.php")){
          require $ruta."../Mod_Admin/Conections/conection.php";
          require $ruta."../Mod_Admin/Conections/conect.php";
          require $ruta."../Mod_Admin/Inclu/my_bbdd_clave.php";
          $conexion = $db;
    } elseif(!file_exists($ruta."../Mod_Admin/Conections/conection.php")) { 
            $db_host = "localhost";
            $db_user = "juancho";
            $db_pass = "juancho";
            $db_name = "mod_contacto";
          $conexion = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Problemas con la Conexion");
          mysqli_set_charset($conexion, 'utf8');
    } else { }

    return $conexion;

  } // FIN FUNCTION

?>

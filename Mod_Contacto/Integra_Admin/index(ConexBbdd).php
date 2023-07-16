
<?php

    // COMPROBACION DE LA BBDD

    global $db_host;
    global $db_user;
    global $db_pass;
    global $db_name;

    $db_host = "127.0.0.1";
    $db_user = "juancho";
    $db_pass = "juancho";
    $db_name = "mod_contacto";

    global $db;
    $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if(!$db){ 
        die ("Es imposible conectar con la base de datos ".$db_name."</br>".mysqli_connect_error()."<br>");
    } else { print(" Se ha conectado a la bbdd ".$db_name."<br>");}

?>
<?php

    header('Content-Type: application/json');

    global $ruta;
    $ruta = "../";
    require("conexion.php");
    global $conexion;
    $conexion = retornarConexion();

    global $contacto;
    global $contactofeed;

    if(file_exists("../../Mod_Admin/Inclu/my_bbdd_clave.php")){
            require "../../Mod_Admin/Inclu/my_bbdd_clave.php";
            $contacto = $_SESSION['clave']."contacto";
            $contactofeed = $_SESSION['clave']."contactofeed";
    } else { 
        $contacto = "contacto";
        $contactofeed = "contactofeed";
    }

    switch ($_GET['accion']) {
        case 'listarFeedback':
            $datos = mysqli_query($conexion, "SELECT * FROM $contactofeed");
            $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
            echo json_encode($resultado);
            break;
        
        case 'borrarFeedback':
            $respuesta = mysqli_query($conexion, "DELETE FROM $contactofeed WHERE id=$_GET[id]");
            echo json_encode($respuesta);

            break;

        case 'recuperarFeedback':
            $respuesta = mysqli_query($conexion, "DELETE FROM $contactofeed WHERE id=$_GET[id]");
            echo json_encode($respuesta);

            $respuesta2 = mysqli_query($conexion, "INSERT INTO $contacto (dni_cliente, nombre, apellido, mail, telf, interes, nComen, nMesas, fecha, hora, coment, leido, confirmado, leeme) VALUES ('$_GET[dni_cliente]','$_GET[nombre]', '$_GET[apellido]', '$_GET[mail]', '$_GET[telf]', '$_GET[interes]', '$_GET[nComen]', '$_GET[nMesas]', '$_GET[fecha]', '$_GET[hora]', '$_GET[coment]', '$_GET[leido]', '$_GET[confirmado]', '$_GET[leeme]')");
            //echo json_encode($respuesta2);
            if(!$respuesta2){}else{}

            break;

        case 'consultar':
            $datos = mysqli_query($conexion, "SELECT * FROM $contacto WHERE id=$_GET[id]");
            $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
            echo json_encode($resultado);
            break;

    }


?>
<?php

    global $id_clientePost;
    if(isset($_POST["id_cliente"])){
        $id_clientePost = '<p>Id Cliente: '.$_POST["id_cliente"].'</p>';
    }else{
        $id_clientePost = "";
    }
    global $formHead;
    print(''.$formHead.'<hr>
        '.$id_clientePost.'
        <p>Nombre: '.$_POST["nombre"].'</p>
        <p>Apellido: '.$_POST["apellido"].'</p>
        <p>DNI: '.$_POST["dni"].'</p>
        <p>Letra DNI: '.$_POST["lDni"].'</p>
        <p>Email: '.$_POST["mail"].'</p>
        <p>Fecha: '.$_POST["fecha"].'</p>
        <p>Tel&eacute;fono: '.$_POST["telf"].'</p>
        <p>Nick: '.$_POST["nick"].'</p>
        <p>Nick 2: '.$_POST["nick2"].'</p>
        <p>Password: '.$_POST["passw"].'</p>
        <p>Password 2: '.$_POST["passw2"].'</p>
        <p>Condiciones: '.$_POST["check"].'</p>
        <p>Direccion: '.$_POST["direccion"].'</p>');

?>
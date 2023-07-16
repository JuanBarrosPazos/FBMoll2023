<?php

    global $texto;      global $action;     global $formHead;   global $idImpt;

    print(''.$formHead.'
        <form action="'.$action.'" id="retorno" name="retorno" method="post">
                <input type="hidden" id="nombre" name="nombre" value="'.$_POST["nombre"].'" autofocus>
                <input type="hidden" id="apellido" name="apellido" value="'.$_POST["apellido"].'">
                <input type="hidden" id="telf" name="telf" value="'.$_POST["telf"].'">
                <input type="hidden" id="dni" name="dni" value="'.$_POST["dni"].'">
                <input type="hidden" id="lDni" name="lDni" value="'.$_POST["lDni"].'">
                <input type="hidden" id="mail" name="mail" value="'.$_POST["mail"].'">
                <input type="hidden" id="fecha" name="fecha" value="'.$_POST["fecha"].'">
                <input type="hidden" id="nick" name="nick" value="'.$_POST["nick"].'">
                <input type="hidden" id="nick2" name="nick2" value="'.$_POST["nick2"].'">
                <input type="hidden" id="passw" name="passw" value="'.$_POST["passw"].'">
                <input type="hidden" id="passw2" name="passw2" value="'.$_POST["passw2"].'">
                <input type="hidden" id="check" name="check" value="'.$_POST["check"].'">
                <input type="hidden" id="direccion" name="direccion" value="'.$_POST["direccion"].'">
            <input type="submit" id="finForm" name="finForm" value="'.$texto.'" class="botonVerde">
            <input type="hidden" id="'.$idImpt.'" name="ocultoUser" value="1">
        </form>'); 

?>
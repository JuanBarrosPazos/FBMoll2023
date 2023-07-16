<?php

    global $texto;      global $action;     global $formHead;   global $idImpt;
 
    print(''.$formHead.'
        <form action="'.$action.'" id="retorno" name="retorno" method="post">
                <input id="dni_cliente" name="dni_cliente" type="hidden" value="'.@$_POST["dni_cliente"].'">
                <input id="nombre" name="nombre" type="hidden" value="'.$_POST["nombre"].'">
                <input id="apellido" name="apellido" type="hidden" value="'.$_POST["apellido"].'">
                <input id="mail" name="mail" type="hidden" value="'.$_POST["mail"].'">
                <input id="telf" name="telf" type="hidden" value="'.$_POST["telf"].'">
                <input id="interes" name="interes" type="hidden" value="'.$_POST["interes"].'">
                <input id="nComen" name="nComen" type="hidden" value="'.$_POST["nComen"].'">
                <input id="nMesas" name="nMesas" type="hidden" value="'.$_POST["nMesas"].'">
                <input id="fecha" name="fecha" type="hidden" value="'.$_POST["fecha"].'">
                <input id="hora" name="hora" type="hidden" value="'.$_POST["hora"].'">
                <input id="coment" name="coment" type="hidden" value="'.$_POST["coment"].'">
                <input id="check" name="check" type="hidden" value="'.$_POST["check"].'">
            <input type="submit" id="finForm" name="finForm" value="'.$texto.'" class="botonVerde">
            <input type="hidden" id="'.$idImpt.'" name="ocultoR" value="1">
        </form>');

?>
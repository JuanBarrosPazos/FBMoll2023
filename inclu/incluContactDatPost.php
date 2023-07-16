<?php
 
    global $formHead;
    print(''.$formHead.'<hr>
        <p>Nombre: '.$_POST["nombre"].' '.$_POST["apellido"].'</p>
        <p>Email: '.$_POST["mail"].' || Tel&eacute;fono: '.$_POST["telf"].'</p>
        <p>Inter&eacute;s: '.$_POST["interes"].'</p>
        <p>N&ordm; Personas: '.$_POST["nComen"].' || N&ordm; Mesas: '.$_POST["nMesas"].'</p>
        <p>Fecha: '.$_POST["fecha"].' || Time: '.$_POST["hora"].'</p>
        <p>Comentarios: <br>'.$_POST["coment"].'</p>');
        
        //<p>Condiciones: '.$_POST["check"].'</p>
        //<p>Dni_Cliente: '.$_POST["dni_cliente"].'</p>

?>
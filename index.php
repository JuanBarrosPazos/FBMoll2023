<?php session_start(); ?>

<?php
    /*
        ESTE INDEX ESTA PREPARADO PARA AUTO REDIRECCIÓN CON .HTACCESS
        COMO UNICO PUNTO DE ACCESO Y LLAMADA A LA URI $_SERVER['REQUEST_URI']
    */

    //echo $_SERVER['REQUEST_URI'];

    global $uri;
 
    require 'inclu/header.php';

    switch (true) {
        case (preg_match('/^index$/', $uri)):
        //case ($uri == "index"):
            require 'inclu/cuerpoIndex.php';
            //echo "<h3>HOLA INDEX, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^carta$/', $uri)):
        //case ($uri == "carta"):
                require 'inclu/cuerpoCarta.php';
            //echo "<h3>HOLA CARTA, LA URI ES: ".$uri."</h3>";
            break; 
        case (preg_match('/^vinos$/', $uri)):
        //case ($uri == "vinos"): 
            require 'inclu/cuerpoVinos.php';
            //echo "<h3>HOLA VINOS, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^donde$/', $uri)):
        //case ($uri == "donde"):
            require 'inclu/cuerpoDonde.php';
            //echo "<h3>HOLA DONDE, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^contacto$/', $uri)):
        //case ($uri == "contacto"):
            require 'inclu/cuerpoContacto.php';  
            //echo "<h3>HOLA CONTACTO, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^contactodat$/', $uri)):
        //case ($uri == "contactoDat"):
            require 'inclu/cuerpoContactDat.php';
            //echo "<h3>HOLA CONTACTO DATOS, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^userregistro$/', $uri)):
        //case ($uri == "userRegistro"):
            require 'inclu/cuerpoUserRegistro.php';
            //echo "<h3>HOLA REGISTRO USUARIOS, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^userregistrodat$/', $uri)):
        //case ($uri == "cuerpoUserRegistroDat"):
            require 'inclu/cuerpoUserRegistroDat.php';
            //echo "<h3>HOLA REGISTRO USUARIOS DATOS, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^somos$/', $uri)):
        //case ($uri == "somos"):
            require 'inclu/cuerpoSomos.php';
            //echo "<h3>HOLA SOMOS, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^useraccesspopup$/', $uri)): 
        //case ($uri == "userAccessPopUp"):
            require 'inclu/cuerpoPopUp.php';
            //echo "<h3>HOLA POPUP, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^claves$/', $uri)): 
        //case ($uri == "claves"):
            require 'inclu/cuerpoPopUp.php';
            //echo "<h3>HOLA POPUP, LA URI ES: ".$uri."</h3>";
            break;
        case (preg_match('/^usermisdatos$/', $uri)):
        //case ($uri == "usermisdatos"):
            require 'inclu/cuerpoMisDatos.php';
            //echo "<h3>HOLA POPUP, LA URI ES: ".$uri."</h3>";
            break;
        default:
            //$rutaJsRedir = "/JuanBarros/ProyectoJuanBarros/index"; // RUTA CLASE
            $rutaJsRedir = $rutaProyecto."index"; //RUTA CASA
            global $redirphp;
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',10);
                        </script>";
            echo ($redirphp);
            //require 'inclu/cuerpoIndex.php';
            //echo "<h3>ALGO NO VA, LA URI ES: ".$uri."</h3>";
            break;
        }

    require 'inclu/footer.php';

?>
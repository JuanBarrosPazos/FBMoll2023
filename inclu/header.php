<?php
    //@session_start();
     
    global $ruta;
    $ruta = "";

    //require 'Mod_Cliente/conect/conectBbdd.php';
    require $ruta.'error_hidden.php';
    require $ruta.'Mod_Admin/Conections/conection.php';
    require $ruta.'Mod_Admin/Conections/conect.php';
    require $ruta.'Mod_Admin/Inclu/my_bbdd_clave.php';


    require $ruta.'headerLogica.php';

    /*
        ESTE HEADER ESTA PREPARADO PARA AUTO REDIRECCIÓN CON .HTACCESS
        COMO UNICO PUNTO DE ACCESO Y LLAMADA A LA URI $_SERVER['REQUEST_URI']
    

    global $rutaProyecto;
    //$rutaProyecto = "/JuanBarros/ProyectoJuanBarros/";//CLASE
    $rutaProyecto = "/ProyectoJuanBarros/";//CASA

    global $baseName;
    $baseName = basename($_SERVER['PHP_SELF']);
    //$baseName = str_replace('.php',"",$baseName);
    //echo '<br>'.$baseName;
    global $uri;
    $uri = $_SERVER['REQUEST_URI'];
    // str_replace("Lo que quiero sustituir","por lo que lo sustituyo","en qué lo sustituyo");
    $uri = str_replace($rutaProyecto,"",$uri);
    $uri = str_replace('juanbarros.test',"",$uri);
    $uri = str_replace('/',"",$uri);
    $uri = str_replace('.php',"",$uri);
    $uri = strtolower($uri);
    //echo '<br>'.$uri;

    
    global $logoLink;       global $titulo;     global $plusFooter;     $plusFooter = "";
    global $plusHeader;     $plusHeader = "";   global $plusBody;       $plusBody = "";
    global $plusAcceso;     $plusAcceso = "";   global $plusLogo;       $plusLogo = "";
    global $estiloDatosForm; $estiloDatosForm = "";

    global $menuLinks;
    
    */
    
    function menu(){
        global $linkIndex;      global $linkCarta;      global $linkVinos;
        global $linkDonde;      global $linkContato;    global $linkSomos;
        $linkIndex = '<a href="index"><button class="botonVerde">INCIO</button></a>';
        $linkCarta = '<a href="carta"><button class="botonVerde">CARTA</button></a>';
        $linkVinos = '<a href="vinos"><button class="botonVerde">VINOS</button></a>';
        $linkDonde = '<a href="donde"><button class="botonVerde">DONDE</button></a>';
        $linkContato = '<a href="contacto"><button class="botonVerde">CONTACTO</button></a>';
        $linkSomos = '<a href="somos"><button class="botonVerde">NOSOTROS</button></a>';
             }

    if($uri == "index"){
        $titulo = "LA PERLA RESTAURANTE";
        menu();
        $menuLinks = $linkCarta.$linkVinos.$linkDonde.$linkContato.$linkSomos;
        require $ruta.'extraAcceso.php';
    }else{ 
        $logoLink = "index";
        if($uri == "carta"){
            $titulo = "LA PERLA CARTA";
            menu();
            $menuLinks = $linkIndex.$linkVinos.$linkDonde.$linkContato.$linkSomos;
            require $ruta.'extraAcceso.php';
        }elseif($uri == "vinos"){
            $titulo = "LA PERLA VINOS";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkDonde.$linkContato.$linkSomos;
            require $ruta.'extraAcceso.php';
        }elseif($uri == "donde"){
            $titulo = "LA PERLA DONDE";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkContato.$linkSomos;
            require $ruta.'extraAcceso.php';
        }elseif(($uri == "contacto")||($uri == "contactodat")){
            ($uri == "contactodat")?$estiloDatosForm = "contedatosform":$estiloDatosForm = "";
            $titulo = "LA PERLA CONTACTO";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkDonde.$linkSomos;
            require $ruta.'extraContacto.php';
            require $ruta.'extraAcceso.php';
            global $plusFooter;
            $plusFooter = '<script src="'.$ruta.'js/script.js"></script>
                           <script src="'.$ruta.'js/scriptUserAcess.js"></script>';
        }elseif(($uri == "userregistro")||($uri == "userregistrodat")){
            ($uri == "userregistrodat")?$estiloDatosForm = "contedatosform":$estiloDatosForm = "";
            $titulo = "REGISTRO DE USUARIOS";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkDonde.$linkContato;
            global $plusHeader;
            $plusHeader = '<!-- FUNCION DE LA HORA JS -->
                           <script src="'.$ruta.'js/hora.js"></script>';
            global $plusBody;
            $plusBody = 'onload="hora()"';
            require $ruta.'extraAcceso.php';
            global $plusFooter;
            $plusFooter = '<script src="'.$ruta.'js/scriptUserReg.js"></script>';
        }elseif($uri == "useraccesspopup"){
            global $titulo;
            $titulo = "LA PERLA ACCESO USUARIOS";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkDonde.$linkContato;
            global $plusHeader;
            $plusHeader = '<script src="'.$ruta.'js/hora.js"></script>';
            global $plusBody;
            $plusBody = 'onload="hora()"';
            global $AccesoPage; $AccesoPage = 1;
            require $ruta.'extraAcceso.php';
            global $plusFooter;
            $plusFooter = '<script src="'.$ruta.'js/scriptUserAcess.js"></script>';
        }elseif($uri == "claves"){
            global $titulo;
            $titulo = "LA PERLA CLAVES USUARIO";
            global $plusFooter;
            $plusFooter = '<script src="'.$ruta.'js/scriptUserAcess.js"></script>';
        }elseif($uri == "somos"){
            $titulo = "LA PERLA NOSOTROS";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkDonde.$linkContato;
            require $ruta.'extraAcceso.php';
        }elseif($uri == "usermisdatos"){
            global $plusHeader;
            $plusHeader = '<!-- FUNCION DE LA HORA JS -->
                           <script src="'.$ruta.'js/hora.js"></script>';
            global $plusBody;
            $plusBody = 'onload="hora()"';
            $titulo = "LA PERLA MIS DATOS";
            menu();
            $menuLinks = $linkIndex.$linkCarta.$linkVinos.$linkDonde.$linkContato;
            require $ruta.'extraAcceso.php';
        }else{
            $titulo = "LA PERLA RESTAURANTE";
            menu();
            $menuLinks = $linkCarta.$linkVinos.$linkDonde.$linkContato.$linkSomos;
            require $ruta.'extraAcceso.php';
        }
    } // FIN ELSE 

    print('<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="copyright" content="Juan Manuel Barr&oacute;s Pazos © 2006 MDC">
                <meta name="description" content="Resturante en Palma de Mallorca, Ocimax">
                <meta name="keywords" content="Palma de Mallorca, Ocimax, Restaurante, Comidas, Cenas">
                <meta name="author" content="Juan Manuel Barr&oacute;s Pazos">
                <meta name="robots" content="all, index, follow" />
                <meta name="audience" content="All" />

                <title>'.$titulo.'</title>

                <link href="'.$ruta.'img/Logos/logo.png" type="image/ico" rel="shortcut icon" />
                <link href="'.$ruta.'css/style.css" rel="stylesheet" type="text/css" media="screen">

                <script src="'.$ruta.'jquery/jquery-3.6.0.min.js"></script>
                <script src="'.$ruta.'js/func.js"></script>
                '.$plusHeader.'
            </head>
 
            <body '.$plusBody.'>
                    <div class="header">
                        <a href="'.$logoLink.'">
                            <img class="logo" src="'.$ruta.'img/Logos/logo.png" id="logo" alt="logo" '.$plusLogo.'/>
                        </a>
                        <h1>'.$titulo.'</h1>
                    </div>
                    '.$plusAcceso.'
                    <div class="menu">'.$menuLinks.'</div>
                <div class="conte '.$estiloDatosForm.'">');

?>
<?php
session_start();

    global $rutaHtml;

    require $rutaHtml.'../Mod_Admin/Conections/conection.php';
    require $rutaHtml.'../Mod_Admin/Conections/conect.php';
    require $rutaHtml.'../Mod_Admin/Inclu/my_bbdd_clave.php';


    /* 
    global $baseName;
    $baseName = basename($_SERVER['PHP_SELF']);
    //$baseName = str_replace('.php',"",$baseName);
    //echo '<br>'.$baseName;
    global $uri;
    $uri = $_SERVER['REQUEST_URI'];
    // str_replace("Lo que quiero sustituir","por lo que lo sustituyo","en qué lo sustituyo");
    $uri = str_replace('/JuanBarros/ProyectoJuanBarros/',"",$uri);
    $uri = str_replace('juanbarros.test',"",$uri);
    $uri = str_replace('/',"",$uri);
    $uri = str_replace('.php',"",$uri);
    $uri = strtolower($uri);
    //echo '<br>'.$uri;
    */

    // ASIGNO LA RUTAHTML DIRECTAMENTE EN LA PAGINA ANTES DEL HEADER.PHP
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

                <title>INDEX BACK END</title>

                <link href="'.$rutaHtml.'img/logo.png" type="image/ico" rel="shortcut icon" />
                <link rel="stylesheet" type="text/css" href="'.$rutaHtml.'css/styleBack.css" media="screen">

                <script src="'.$rutaHtml.'js/hora.js"></script>
                <script src="'.$rutaHtml.'js/scriptUserReg.js"></script>
                
            </head>

            <body onload="hora()">
                    <div class="header">
                        <a href="#">
                            <img class="logo" src="'.$rutaHtml.'img/logo.png" id="logo" alt="logo" />
                        </a>
                        <h1>LA PERLA BACKEND</h1>
                    </div>
                <div class="conte">');

?>
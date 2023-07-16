<?php

    global $ruta;   global $texto;    global $action;    global $formHead;  
    
    if(isset($_POST['ocultoR'])){ 
        process_bbdd();
        unset($_SESSION['LogTemp']);
        unset($_SESSION['contacto']);
    }else if(isset($_POST['oculto1'])){
        $formHead = '<h5 id="hora">000000</h5><h3>FORMULARIO CONTACTO</h3>';
        process_form();
        $texto = "MODIFICAR ESTOS DATOS";
        //$action = "contacto.php"; // PARA BASE NAME
        $action = "contacto"; // PARA URI
        $idImpt = "ocultoR";
        $formHead = '';
        show_form();
        $texto = "PROCESAR LA PETICION";
        //$action = "$_SERVER[PHP_SELF]"; // PARA BASE NAME
        $action = 'contactoDat'; // PARA (LA URI) PROCESAR LOS DATOS EN LA BBDD
        $idImpt = "ocultoR";
        $formHead = '';
        show_form();
    }else{
        $texto = "REGRESAR AL INICIO";
        //$action = "contacto.php"; // PARA BASE NAME
        $action = "contacto"; // PARA URI
        show_form();
    }

    function process_form(){ // RECIBE LOS DATOS DEL FORMULARIO CONTACTO
        global $ruta;
        require $ruta.'incluContactDatPost.php';

    } // FIN PROCESS FORM

    function process_bbdd(){// PROCESAMOS LOS DATOS EN LA BBDD
        
        global $dni_cliente;
        if((strlen(trim($_POST['dni_cliente'])) == 0)&&(!isset($_SESSION['nivel']))){
            $dni_cliente = 99999999; // ANONIMO POR DEFECTO
        }else if(isset($_SESSION['nivel'])){
            $dni_cliente = $_SESSION['dni_cliente'];
        }else{
            $dni_cliente = $_POST['dni_cliente'];
        }
        global $db;     global $db_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."contacto`";
        
        global $procesoDat;
        $procesoDat = "INSERT INTO `$db_name`.$table_name(`dni_cliente`, `nombre`, `apellido`, `mail`, `telf`, `interes`, `nComen`, `nMesas`, `fecha`, `hora`, `coment`) VALUES ('$dni_cliente','$_POST[nombre]','$_POST[apellido]','$_POST[mail]','$_POST[telf]','$_POST[interes]','$_POST[nComen]','$_POST[nMesas]','$_POST[fecha]','$_POST[hora]','$_POST[coment]')";

        global $formHead; global $texto; global $action; global $idImpt;
        mysqli_report(MYSQLI_REPORT_OFF);
        if(mysqli_query($db, $procesoDat)){
            $formHead = '<h5 id="hora">000000</h5><h3>SE HAN REGISTRADO LOS DATOS EN LA BBDD</h3>';
            global $ruta;
            $_SESSION['contacto'] = 1;
            if(!isset($_SESSION['nivel'])){ $_SESSION['LogTemp'] = $dni_cliente; }else{ }

                global $UserActionLog;  
                $UserActionLog = "\t* RESERVA CLIENTE ".$_POST['nombre']." ".$_POST['apellido']." || DNI: ".$dni_cliente.PHP_EOL."\t* INTERES: ".$_POST['interes'].PHP_EOL."\t* COMENSALES: ".$_POST['nComen'].PHP_EOL."\t* MESAS: ".$_POST['nMesas'].PHP_EOL."\t* FECHA: ".$_POST['fecha'].PHP_EOL."\t* HORA: ".$_POST['hora'].PHP_EOL."\t* COMENTARIOS: ".$_POST['coment'];
                global $ruta;
                require $ruta.'writeUserLog.php';

                require $ruta.'incluContactDatPost.php';
                $rutaJsRedir = "index.php";
                global $redirphp;
                $redirphp ="<script type='text/javascript'>
                                function redir(){
                                    window.location.href='".$rutaJsRedir."';
                                } setTimeout('redir()',3000);
                            </script>";
                echo ($redirphp);
                
        }else{
            echo "ERROR L.51 ".mysqli_error($db);
            $formHead = '<h5 id="hora">000000</h5><h3>ERROR EN EL REGISTRO DE SUS DATOS</h3>';
            $texto = "REGRESAR AL INICIO";
            // $action = "contacto.php"; // PARA BASE NAME
            $action = "contacto"; // PARA URI
            $idImpt = "oculto2";
            show_form();
    
            //show_form_borrar();
        }

    } // FIN PROCESS BBDD
 
    function show_form(){ // PROCESA LA PETICION O RETORNA AL FORMULARIO CONTACTO
        global $ruta;
        require $ruta.'incluContacDatFormInputHidden.php';
    } // FIN SHOW FORM


?>
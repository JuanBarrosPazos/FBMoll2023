<?php

    global $ruta;   global $texto;    global $action;   global $idImpt;    global $formHead;     

    if(isset($_POST['ocultoUser'])){ 
        process_bbdd();
    }elseif(isset($_POST['oculto1'])){
 
    $formHead = '<h5 id="hora">000000</h5><h3>FORMULARIO REGISTRO SUS DATOS</h3>';
    //process_form();

    /* INICIO VERIFICACIÓN DE DATOS USER SI NO ESTA INICIADA SESION */
    if(!isset($_SESSION['nivel'])){

        global $db;     global $db_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_name WHERE `dni` = '$_POST[dni]' OR `Email` = '$_POST[mail]' OR `Tlf`= '$_POST[telf]' OR `Usuario`='$_POST[nick]' OR `Pass`='$_POST[passw]' LIMIT 1 ";

        global $sqlUserQry;     $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr;     $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        global $sqlUserCount;   $sqlUserCount = mysqli_num_rows($sqlUserQry);

            if(!$sqlUser){ 
                echo "ERROR L.21: ".mysqli_error($db);
                process_form();
            }elseif($sqlUserCount>0){
                if($sqlUserArr['dni']==$_POST['dni']){
                    echo "<hr><h3 style='color:#ff0000;'>YA EXISTE ESTE DNI.<br>MODIFIQUE LOS DATOS</h3><hr>";
                }elseif($sqlUserArr['Email']==$_POST['mail']){
                    echo "<hr><h3 style='color:#ff0000;'>YA EXISTE ESTE EMAIL.<br>MODIFIQUE LOS DATOS</h3><hr>";
                }elseif($sqlUserArr['Tlf']==$_POST['telf']){
                    echo "<hr><h3 style='color:#ff0000;'>YA EXISTE ESTE TELEFONO.<br>MODIFIQUE LOS DATOS</h3><hr>";
                }else{
                    echo "<hr><h3 style='color:#ff0000;'>YA EXISTE ESTE USUARIO.<br>MODIFIQUE LOS DATOS</h3><hr>";
                }
                process_form();
            }else{ /* NO COINCIDEN DATOS DEL USUARIO */
                process_form();
                $texto = "PROCESAR LOS DATOS";
                //$action = "$_SERVER[PHP_SELF]"; // PARA BASE NAME
                $action = "userRegistroDat"; // PARA LA URI
                $idImpt = "ocultoUser";
                $formHead = '';
                show_form();
            }
        } /* FIN SI NO ESTA INICIADA SESION */
        else{ /* SI ESTA INICIADA SESION */
            process_form();
            $texto = "PROCESAR LOS DATOS";
            //$action = "$_SERVER[PHP_SELF]"; // PARA BASE NAME
            $action = "userRegistroDat"; // PARA LA URI
            $idImpt = "ocultoUser";
            $formHead = '';
            show_form();
        }
        /* SIEMPRE */
        $texto = "MODIFICAR FORMULARIO";
        //$action = "userRegistro.php"; // PARA BASE NAME
        $action = "userRegistro"; // PARA URI
        $idImpt = "ocultoUser";
        $formHead = '';
        show_form();

    }/* FIN oculto1 */
    else{
        $texto = "REGRESAR AL INICIO";
        //$action = "userRegistro.php"; // PARA BASE NAME
        $action = "userRegistro"; // PARA URI
        $idImpt = "oculto2";
        show_form();
    }

    
    function process_form(){
        
        global $ruta;
        require $ruta.'incluRegistroDatPost.php';
    } // FIN PROCESS FORM

    function process_bbdd(){

        global $db;         global $db_name;    global $regUser;     global $ruta;
        global $formHead;   global $texto;      global $action;      global $idImpt; 
        global $redirphp;   global $UserActionLog; 

        if(isset($_SESSION['modifDat'])){
            global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";
            mysqli_report(MYSQLI_REPORT_OFF);
            $regUser = "UPDATE `$db_name`.$table_name SET `Nombre`='$_POST[nombre]',`Apellidos`='$_POST[apellido]',`dni`='$_POST[dni]',`ldni`='$_POST[lDni]',`Email`='$_POST[mail]',`DateNac`='$_POST[fecha]',`Tlf`='$_POST[telf]',`Usuario`='$_POST[nick]',`Pass`='$_POST[passw]',`Direccion`='$_POST[direccion]' WHERE $table_name.`id_cliente` = $_SESSION[id_cliente] AND $table_name.`dni` = '$_SESSION[dni_cliente]'  LIMIT 1 ";
            $formHead = '<h5 id="hora">000000</h5><h3>SE HAN MODIFICADO LOS DATOS CORRECTAMENTE</h3>';
            //$rutaJsRedir = "userMisDatos.php";
            $rutaJsRedir = "usermisdatos";
 
            $UserActionLog = "\t* MODIFICA DATOS ".$_SESSION['nombre']." ".$_SESSION['apellidos']." || DNI: ".$_SESSION['dni_cliente'].$_SESSION['ldni'].PHP_EOL;
    
        }else{
            mysqli_report(MYSQLI_REPORT_OFF);
            global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

            $regUser = "INSERT INTO `$db_name`.$table_name(`Nombre`, `Apellidos`, `dni`, `ldni`, `Email`, `DateNac`, `Tlf`, `Usuario`, `Pass`, `Direccion`) VALUES ('$_POST[nombre]','$_POST[apellido]','$_POST[dni]','$_POST[lDni]','$_POST[mail]','$_POST[fecha]','$_POST[telf]','$_POST[nick]','$_POST[passw]','$_POST[direccion]')";
            $formHead = '<h5 id="hora">000000</h5><h3>SE HAN REGISTRADO LOS DATOS CORRECTAMENTE</h3>';
            //$rutaJsRedir = "index.php";
            $rutaJsRedir = "index";

            $UserActionLog = "\t* CREA NUEVO USUARIO: ".$_POST['nombre']." ".$_POST['apellido']." || DNI: ".$_POST['dni'].$_POST['lDni'].PHP_EOL;
        }

        if(mysqli_query($db, $regUser)){

            require $ruta.'incluRegistroDatPost.php';

            if(isset($_SESSION['modifDat'])){
                    $_SESSION['nombre'] = $_POST["nombre"];
                    $_SESSION['apellidos'] = $_POST["apellido"];
                    $_SESSION['dni_cliente'] = $_POST["dni"];
                    $_SESSION['ldni'] = $_POST["lDni"];
                    $_SESSION['email'] = $_POST["mail"];
                    $_SESSION['dateNac'] = $_POST["fecha"];
                    $_SESSION['tlf'] = $_POST["telf"];
                    $_SESSION['usuario'] = $_POST["nick"];
                    $_SESSION['pass'] = $_POST["passw"];
                    $_SESSION['direccion'] = $_POST["direccion"];
            }else{ 
                session_destroy();
            }
 
            global $ruta;
            require $ruta.'writeUserLog.php';
            
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',4000);
                        </script>";
            echo ($redirphp);
            
        }else{
            $formHead = '<h5 id="hora">000000</h5><h3>ERROR EN EL REGISTRO DE SUS DATOS</h3>';
            echo "ERROR L.91/104: ".mysqli_error($db)." ".$table_name."<br>";
            $texto = "REGRESAR AL INICIO REGISTRO";
            // $action = "userRegistro.php"; // PARA BASE NAME
            $action = "userRegistro"; // PARA URI
            $idImpt = "oculto2";
            show_form();
        }

    } // FIN PROCESS BBDD

    function show_form(){
        global $idImpt;
        $idImpt = "ocultoUser";
        global $ruta;
        require $ruta.'incluRegistroDatFormInputHidden.php';
    } // FIN SHOW FORM


?>
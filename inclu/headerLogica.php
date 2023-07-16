<?php
 
    global $rutaProyecto;
    //$rutaProyecto = "/"; //DESDE LA RAIZ DEL DOMINIO
    $rutaProyecto = "/JuanBarros/ProyectoJuanBarros/";//DESDE OTRA RUTA NO RAIZ
    //$rutaProyecto = "/BorjaMoll2023/";//RUTA DE PROYECTO CASA

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
    
    global $logoLink;        global $titulo;     global $plusFooter;     $plusFooter = "";
    global $plusHeader;      $plusHeader = "";   global $plusBody;       $plusBody = "";
    global $plusAcceso;      $plusAcceso = "";   global $plusLogo;       $plusLogo = "";
    global $estiloDatosForm; $estiloDatosForm = "";

    global $menuLinks;      global $dni_cliente;
    
    //$_SESSION['nivel'] = 'cliente'; $_SESSION['dni_cliente'] = 88888888;// PARA PRUEBAS

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    if(isset($_POST['iniSession'])){
            openSession();
            // LLAMO A LAS FUNCIONES DE ACCESO Y NUMERO DE ACCESOS
            user_entrada();
            unset($_SESSION['LogTemp']);
            unset($_SESSION['contacto']);

    }elseif(isset($_POST['closeSession'])){
        
        // LLAMO A LAS FUNCIONES DE CIERRE DE SESION 
        user_salida();
        closeSession();
        
    }elseif(isset($_SESSION['nivel'])){
        if(($_SESSION['nivel'] == 'admin')||($_SESSION['nivel'] == 'cliente')){ 
            $dni_cliente = $_SESSION['dni_cliente'];
        }else{ echo "<h3>ACCESO RESTRINGIDO</h3>"; }
    }elseif(!isset($_SESSION['nivel'])){ $dni_cliente = 99999999;
    }else{ }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    function openSession(){ // ABRE SESION Y CREA LAS SUPERGLOBALES

        global $db;
        global $db_name;
        
        global $table_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";
    
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_name WHERE `Usuario` = '$_POST[nombreUsr]' AND `Pass` = '$_POST[pass]' LIMIT 1";
        global $sqlUserQry; $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr; $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        global $sqlUserCount; $sqlUserCount = mysqli_num_rows($sqlUserQry);
        if(!$sqlUser){ echo "ERROR L.54: ".mysqli_error($db);
        }else{ }
    
        // VALIDO EL FORMULARIO
        global $UserAccess; global $UserError;
        $UserAccess = ""; $UserError = "";
        if ((isset($_POST['nombreUsr']))&&(isset($_POST['pass']))){

            if ((strlen(trim($_POST['nombreUsr'])) == 0)||(strlen(trim($_POST['pass'])) == 0)){
                $UserError = "<p class='errorD' style='font-size: 70.0% !important;'>CAMPOS OBLIGATORIOS</p>";
            }elseif ((strlen(trim($_POST['nombreUsr'])) < 3)||(strlen(trim($_POST['pass'])) < 3)){
                $UserError = "<p class='errorD' style='font-size: inherit 68.0%;'>CARACTERES NO VALIDOS</p>";
            }elseif((!preg_match('/^[a-z A-Z 0-9 \s]+$/',$_POST['nombreUsr']))||(!preg_match('/^[a-z A-Z 0-9 !?\*\+]+$/',$_POST['pass']))){
                $UserError = "<p class='errorD' style='font-size: 70.0% !important;'>CARACTERES NO PERMITIDOS</p>";
            }elseif($sqlUserCount < 1){
                $UserAccess = '<p class="errorD" style="font-size: 78.0% !important;">ACCESO DENEGADO</p>
                                <p class="errorD" style="font-size: inherit !important;">
            <a style="cursor:pointer" onclick="window.open(\'claves\',\'_blank\', \'width=480px,height=560px,\')">
                            HE PERDIDO MIS CLAVES
                </a></p>';
            }else{ 
                // CREO LAS VARIABLES DE SESION PARA EL USUARIO
                $_SESSION['id_cliente'] = $sqlUserArr['id_cliente'];
                $_SESSION['nivel'] = $sqlUserArr['Nivel'];
                $_SESSION['nombre'] = $sqlUserArr['Nombre'];
                $_SESSION['apellidos'] = $sqlUserArr['Apellidos'];
                $_SESSION['dni_cliente'] = $sqlUserArr['dni'];
                $_SESSION['ldni'] = $sqlUserArr['ldni'];
                $_SESSION['email'] = $sqlUserArr['Email'];
                $_SESSION['dateNac'] = $sqlUserArr['DateNac'];
                $_SESSION['tlf'] = $sqlUserArr['Tlf'];
                $_SESSION['usuario'] = $sqlUserArr['Usuario'];
                $_SESSION['pass'] = $sqlUserArr['Pass'];
                $_SESSION['direccion'] = $sqlUserArr['Direccion'];
                $_SESSION['img'] = $sqlUserArr['img'];
                $_SESSION['visitadmin'] = $sqlUserArr['visitadmin']; 
                
                global $dni_cliente;
                $dni_cliente = $_SESSION['dni_cliente'];
            
    global $UserActionLog;  
    $UserActionLog = "\t* INICIO DE SESION ".$sqlUserArr['Nombre']." ".$sqlUserArr['Apellidos']." || DNI: ".$sqlUserArr['dni'].PHP_EOL;
    global $ruta;
    require $ruta.'writeUserLog.php';
 
                global $rutaProyecto;
            /*
                //$rutaJsRedir = $rutaProyecto."contacto.php";
                $rutaJsRedir = $rutaProyecto."contacto";
                global $redirphp;
                $redirphp ="<script type='text/javascript'>
                                function redir(){
                                    window.location.href='".$rutaJsRedir."';
                                } setTimeout('redir()',10); <!--EN MICROSEGUNDOS-->
                            </script>";
                echo ($redirphp);
            */

        header("Location: ".$rutaProyecto."contacto");
        
            } // FIN ABRO SESION

        }elseif ((!isset($_POST['nombreUsr']))&&(!isset($_POST['pass']))){
            $UserError = "<p class='errorD' style='font-size: inherit !important;'>CAMPOS OBLIGATORIOS</p>";
        }else{ } // FIN VALIDACION

    } // FIN FUNCTION openSession()

    function closeSession(){ // CIERRA SESION Y MATA SUPERGLOBALES

        global $dni_cliente;
        $dni_cliente = 99999999;

        // MATO LA SESION Y LAS VARIABLES DE SESION
        //session_destroy();

        unset($_SESSION['id_cliente']);
        unset($_SESSION['nivel']);
        unset($_SESSION['nombre']);
        unset($_SESSION['apellidos']);
        unset($_SESSION['dni_cliente']);
        unset($_SESSION['ldni']);
        unset($_SESSION['email']);
        unset($_SESSION['dateNac']);
        unset($_SESSION['tlf']);
        unset($_SESSION['usuario']);
        unset($_SESSION['pass']);
        unset($_SESSION['visitadmin']);

        unset($_SESSION['modifDat']);
        unset($_SESSION['smyimg']);

        unset($_SESSION['LogTemp']);
        unset($_SESSION['contacto']);

        global $rutaProyecto;
        /*
        //$rutaJsRedir = $rutaProyecto."index.php";
        $rutaJsRedir = $rutaProyecto."index";
        global $redirphp;
        $redirphp ="<script type='text/javascript'>
                        function redir(){
                            window.location.href='".$rutaJsRedir."';
                        } setTimeout('redir()',10); <!--EN MICROSEGUNDOS-->
                    </script>";
        echo ($redirphp);
        */

        header("Location: ".$rutaProyecto."index.php");

    } // FIN FUNCITON closeSession()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function user_entrada(){

	global $db;         global $db_name;    global $userid;     global $uservisita;   
	global $datein;         $datein = date('Y-m-d H:i:s');

    if(isset($_SESSION['nivel'])){
        $userid = $_SESSION['id_cliente'];
        $uservisita = $_SESSION['visitadmin'];

    }else{ }

	global $total;          $total = $uservisita + 1;
	global $table_name;   $table_name = "`".$_SESSION['clave']."cliente`";

	$sqladin = "UPDATE `$db_name`.$table_name SET `lastin` = '$datein', `visitadmin` = '$total' WHERE $table_name.`id_cliente` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladin)){
			// print("* ");
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
							}

	} // FIN function user_entrada()

    function user_salida(){

        global $UserActionLog;  
        $UserActionLog = "\t* CIERRE DE SESION ".$_SESSION['nombre']." ".$_SESSION['apellidos']." || DNI: ".$_SESSION['dni_cliente'].PHP_EOL;
        global $ruta;
        require $ruta.'writeUserLog.php';

        global $db;     global $db_name;    
        global $userid;       $userid = $_SESSION['id_cliente'];
        global $dateadout;    $dateadout = date('Y-m-d H:i:s');
        global $table_name;   $table_name = "`".$_SESSION['clave']."cliente`";
    
        $sqladout = "UPDATE `$db_name`.$table_name SET `lastout` = '$dateadout' WHERE $table_name.`id_cliente` = '$userid' LIMIT 1 ";
            
        if(mysqli_query($db, $sqladout)){

        } else { 
            print("</br><font color='#FF0000'>* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."</br>";
                }
    } // FIN user_salida()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	// SI EXISTE EL RESPALDO CORRESPONDIENTE A HOY NO HACER NADA.
        global $date; $date = date('Y-m-d');
        global $backup_file_name;
        $backup_file_name = 'Mod_Admin/upbbdd/bbdd_export_tot/'.$db_name.'_backup_'.$date.'.sql';
        //echo $backup_file_name;

        global $dt; $dt = date('d');
        global $dh; $dh = date('H');
        if(file_exists($backup_file_name)){ 
            //echo "<h5>YA EXISTO</h5>";
        // DE LO CONTRARIO HACER EL RESPALDO.
        }elseif(!file_exists($backup_file_name)){
            if((($dt%2) != 0)&&($dh > 16)){ 
                process_backup();
            } else { //echo " ".$dh; 
                        }
        } // Fin del condicional que realiza el respaldo

    function process_backup(){

        global $db;     global $db_name;

        $tables=array();
        $sql="SHOW TABLES";
        $result=mysqli_query($db,$sql);
        
        while($row=mysqli_fetch_row($result)){ $tables[]=$row[0]; }
        
        $backupSQL="";
        foreach($tables as $table){

            $nrow = "SELECT * FROM $table";
            $nrowqr = mysqli_query($db, $nrow);
            $numrow = mysqli_num_rows($nrowqr);

            $query="SHOW CREATE TABLE $table";
            $result=mysqli_query($db,$query);

            $row= mysqli_fetch_row($result);

            $row=str_replace("CREATE TABLE","CREATE TABLE IF NOT EXISTS",$row);

            $backupSQL .="\n".$row[1].";\n";

            $query="SELECT * FROM $table";
            $result=mysqli_query($db,$query);
            
            $columnCount=mysqli_num_fields($result);

            if($numrow>0){ $backupSQL.="INSERT INTO $table VALUES "; }else{ }
        
            global $n;      $n=1;
            for($i=0;$i<$columnCount;$i++){ 

                while($row=mysqli_fetch_row($result)){
                        $backupSQL.="(";
                        for($j=0;$j<$columnCount;$j++){
                            $row[$j]=$row[$j];
                            if(isset($row[$j])){
                            $backupSQL.='"'.$row[$j].'"';
                            }else{
                            $backupSQL.='""';
                            }
                        if($j<($columnCount-1)){ $backupSQL.=','; }
                        }
                    if($n<$numrow){ $backupSQL.="),\n"; }elseif($n=$numrow){ $backupSQL.=");\n"; }else{ }
                    $n++;
                } // FIN WHILE
            
            } // FIN FOR
                $backupSQL.="\n";
        } // FIN FOREACH
        
        if(!empty($backupSQL)){
            global $date; $date = date('Y-m-d');
            $backup_file_name = 'Mod_Admin/upbbdd/bbdd_export_tot/'.$db_name.'_backup_'.$date.'.sql';
            $fileHandler=fopen($backup_file_name,'ab+');
            fwrite($fileHandler,$backupSQL);
            fclose($fileHandler);
        }

    } // FIN FUNCTION process_backup()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


?>
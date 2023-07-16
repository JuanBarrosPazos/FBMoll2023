<?php

    /* LOGICA DE EJECUCION */

    if(isset($_POST['borrando'])){
        borrarDat();
        closeSession();
        header("Location: index.php");
    }
    elseif(isset($_POST['borrar'])){
        global $cancelar;
        if(isset($_SESSION['nivel'])){ $cancelar = "userMisDatos";}else{ $cancelar = "index.php";}
        echo '<section>
                <form id="del" name="del" method="POST" action="userMisDatos">
            <input id="id_cliente" name="id_cliente" type="hidden" value="'.$_POST['id_cliente'].'">
            <input id="send" name="send" type="submit" value="CONFIRME EL BORRADO DEFINITIVO DE SUS DATOS" tabindex="2" class="botonRojo" style="min-width: max-content;">
            <input id="borrando" name="borrando" type="hidden" value=1>
                </form>
            <button class="botonAzul" tabindex="3" >
                <a href="'.$cancelar.'">CANCELAR Y VOLVER</a>
            </button></section>';
    }
    elseif (isset($_POST['modifImg'])){ 
                show_form_img();
    } elseif(isset($_POST['imagenmodif'])){
        if($form_errors = validate_form_img()){ 
            show_form_img($form_errors); 
        } else { process_form_img(); }
    } elseif(isset($_POST['modifDat'])){
        //echo "<h3>HE PULSADO MODIFICAR</h3>";
        show_datos();
    } else {
        //unset($_SESSION['smyimg']);
        show_datos();
    }

    /* FIN LOGICA DE EJECUCION */

                       ////////////////////				   ////////////////////
    ////////////////////				////////////////////				////////////////////
                     ////////////////////				  ///////////////////

    function borrarDat(){

        global $db;     global $db_name;         global $ruta;

        global $table_nameU;    $table_nameU = "`".$_SESSION['clave']."cliente`";
        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_nameU WHERE `id_cliente` = $_POST[id_cliente] LIMIT 1";
        global $sqlUserQry; $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr; $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        if(!$sqlUser){ 
            // NO SE CUMPLE LA CONSULTA DEL USUARIO
            echo "ERROR L.50: ".mysqli_error($db);
        }else{ 
            // SE CUMPLE LA CONSULTA DEL USUARIO Y GRABO DATOS EN FEEDBACK
            global $dateFeed;    $dateFeed = date('Y-m-d H:i:s');
            global $table_namef; $table_namef = "`".$_SESSION['clave']."clientefeed`";
            mysqli_report(MYSQLI_REPORT_OFF);
            global $userFeed;      
            $userFeed ="INSERT INTO `$db_name`.$table_namef(`Nivel`,`Nombre`, `Apellidos`, `dni`, `ldni`, `Email`, `DateNac`, `Tlf`, `Usuario`, `Pass`, `Direccion`, `img`, `datereg`, `delete`, `lastin`, `lastout`, `visitadmin`) VALUES ('$sqlUserArr[Nivel]','$sqlUserArr[Nombre]','$sqlUserArr[Apellidos]','$sqlUserArr[dni]','$sqlUserArr[ldni]','$sqlUserArr[Email]','$sqlUserArr[DateNac]','$sqlUserArr[Tlf]','$sqlUserArr[Usuario]','$sqlUserArr[Pass]','$sqlUserArr[Direccion]','$sqlUserArr[img]','$sqlUserArr[datereg]','$dateFeed','$sqlUserArr[lastin]','$sqlUserArr[lastout]','$sqlUserArr[visitadmin]')";
            global $userFeedQry; $userFeedQry = mysqli_query($db, $userFeed);
            if(!$userFeedQry){
                // NO SE CUMPLE EL QUERY
                echo "ERROR L.61: ".mysqli_error($db);
            }else{
                global $UserActionLog;  
                $UserActionLog = "\t* GRABA LOS DATOS EN FEEDBACK CLIENTE ".$_SESSION['nombre']." ".$_SESSION['apellidos']." || DNI: ".$_SESSION['dni_cliente'].PHP_EOL."\t* FECHA FEEDBACK: ".$dateFeed;
                global $ruta;
                require $ruta.'writeUserLog.php';
        
                // SE CUMPLE EL QUERY Y BORRO EL USUARIO DEL LA TABLA CLIENTES.
                global $table_name;     $table_name = "`".$_SESSION['clave']."cliente`";
                mysqli_report(MYSQLI_REPORT_OFF);
                global $borrarDatos;
                $borrarDatos = "DELETE FROM `$db_name`.$table_name WHERE $table_name.`id_cliente` = $_POST[id_cliente] LIMIT 1";
                global $borrarDatosQry;
                $borrarDatosQry = mysqli_query($db, $borrarDatos);
                if(!$borrarDatosQry){
                    echo "<h3>ERROR L.70: ".mysqli_error($db)."</h3>";
                }else{
                    global $UserActionLog;  
                    $UserActionLog = "\t* BORRA LOS DATOS EN TABLA CLIENTE ".$_SESSION['nombre']." ".$_SESSION['apellidos']." || DNI: ".$_SESSION['dni_cliente'].PHP_EOL."\t* FECHA DELETE: ".$dateFeed;
                    global $ruta;
                    require $ruta.'writeUserLog.php';
                    echo "<h3>SE HA BORRADO EL USUARIO</h3>";
                } // FIN DELETE $borrarDatos

            } // FIN INSERT $userFeed

        } // FIN CONSULTA USUARIO $sqlUser.

    } // FIN FUNCTION borrarDat()

    function show_datos(){

        global $db;     global $db_name;     global $table_name;    global $ruta;
        global $table_name;     $table_name = "`".$_SESSION['clave']."cliente`";
    
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_name WHERE `id_cliente` = '$_SESSION[id_cliente]' AND `dni` = '$_SESSION[dni_cliente]' LIMIT 1";
        global $sqlUserQry; $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr; $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        global $sqlUserCount; $sqlUserCount = mysqli_num_rows($sqlUserQry);
        if(!$sqlUser){ echo "ERROR L.54: ".mysqli_error($db);
        }else{ 
    
        print ('<section>
                    <h3>MIS DATOS</h3><h5 id="hora">000000</h5><hr>
                    <img class="imgUser" src="'.$ruta.'img/imgCliente/'.$_SESSION["img"].'">
            <!--
                <form id="modDat" name="modDat" method="POST" action="userRegistro.php">
            -->
                <form id="modDat" name="modDat" method="POST" action="userregistro">
        <input id="id_cliente" name="id_cliente" type="hidden" value="'.$sqlUserArr['id_cliente'].'"> 
                <p>Nombre: '.$sqlUserArr['Nombre'].' '.$sqlUserArr['Apellidos'].'</p>
        <input id="nombre" name="nombre" type="hidden" value="'.$sqlUserArr['Nombre'].'"> 
        <input id="apellido" name="apellido" type="hidden" value="'.$sqlUserArr['Apellidos'].'"> 
                <p>Dni: '.$sqlUserArr['dni'].' '.$sqlUserArr['ldni'].'</p>
        <input id="dni" name="dni" type="hidden" value="'.$sqlUserArr['dni'].'"> 
        <input id="lDni" name="lDni" type="hidden" value="'.$sqlUserArr['ldni'].'"> 
                <p>Email: '.$sqlUserArr['Email'].'</p>
        <input id="mail" name="mail" type="hidden" value="'.$sqlUserArr['Email'].'"> 
                <p>Fecha Nac.: '.$sqlUserArr['DateNac'].'</p>
        <input id="fecha" name="fecha" type="hidden" value="'.$sqlUserArr['DateNac'].'"> 
                <p>Telefono: '.$sqlUserArr['Tlf'].'</p>
        <input id="telf" name="telf" type="hidden" value="'.$sqlUserArr['Tlf'].'"> 
                <p>Usuario: '.$sqlUserArr['Usuario'].'</p>
        <input id="nick" name="nick" type="hidden" value="'.$sqlUserArr['Usuario'].'"> 
        <input id="nick2" name="nick2" type="hidden" value="'.$sqlUserArr['Usuario'].'"> 
                <p>Password: '.$sqlUserArr['Pass'].'</p>
        <input id="passw" name="passw" type="hidden" value="'.$sqlUserArr['Pass'].'"> 
        <input id="passw2" name="passw2" type="hidden" value="'.$sqlUserArr['Pass'].'"> 
                <p>Direccion: '.$sqlUserArr['Direccion'].'</p>
        <input id="direccion" name="direccion" type="hidden" value="'.$sqlUserArr['Direccion'].'"> 

        <input id="send" name="send" type="submit" value="MODIFICAR MIS DATOS" tabindex="1" class="botonLila">
        <input id="modifDat" name="modifDat" type="hidden" value=1> 
                </form>

            <form id="modImg" name="modImg" method="POST" action="userMisDatos">
        <input id="send" name="send" type="submit" value="MODIFICAR MI IMAGEN" tabindex="2" class="botonLila">
        <input id="modifImg" name="modifImg" type="hidden" value=1> 
            </form>
            <form id="borrar" name="borrar" method="POST" action="userMisDatos">
            <input id="id_cliente" name="id_cliente" type="hidden" value="'.$sqlUserArr['id_cliente'].'"> 
            <input id="send" name="send" type="submit" value="BORRAR MIS DATOS" tabindex="2" class="botonRojo">
        <input id="borrar" name="borrar" type="hidden" value=1>
            </form>
                
            <hr>
                <button class="botonAzul" tabindex="3" >
                    <a href="index.php">SALIR DE MIS DATOS</a>
                </button>
            </section>');
        } // FIN SI SE CUMPLE EL QUERY

    } // FIN FUNCTION show_datos()


                       ////////////////////				   ////////////////////
    ////////////////////				////////////////////				////////////////////
                     ////////////////////				  ///////////////////

    /* FUNCIONES DE MODIFICACION DE LA IMAGEN */

    function validate_form_img(){
	
        $errors = array();
    
        $limite = 500 * 1024;
        
        $ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
        $extension = substr($_FILES['myimg']['name'],-3);
        $extension = strtolower($extension);
        // print($extension);
        // $extension = end(explode('.', $_FILES['myimg']['name']) );
        global $ext_correcta;
        $ext_correcta = in_array($extension, $ext_permitidas);
    
        //$tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp|jpeg)$/', $_FILES['myimg']['type']);
    
            if($_FILES['myimg']['size'] == 0){
                $errors [] = "<h5>Ha de seleccionar una fotograf&iacute;a</h5>";
            }
            elseif((!$ext_correcta)||($extension=="psd")){
                $errors [] = "<h5>La extension no esta admitida</h5><h5>".$_FILES['myimg']['name']."</h5>";
                }
                /*
            elseif(!$tipo_correcto){
                $errors [] = "<h5>Este tipo de archivo no esta admitido</h5><h5>".$_FILES['myimg']['name']."</h5>";
                }
                */
            elseif ($_FILES['myimg']['size'] > $limite){
                    $tamanho = $_FILES['myimg']['size'] / 1024;
                    $errors [] = "<h5>El archivo".$_FILES['myimg']['name']."</h5>
                                  <h5>Es mayor de 500 KBytes. ".$tamanho." KB</h5>";
                }
            elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
                    $errors [] = "<h5>La carga del archivo se ha interrumpido</h5>";
                    }
            elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
                    $errors [] = "<h5>Es archivo no se ha cargado</h5>";
                    }
                        
            return $errors;
    
            } // FIN FUNCTION validate_form_img()
    
                       ////////////////////				   ////////////////////
    ////////////////////				////////////////////				////////////////////
                     ////////////////////				  ///////////////////
    
    function process_form_img(){
        
        global $db;
        global $safe_filename;
        
        $safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
        $safe_filename = trim(str_replace('..', '', $safe_filename));
    
        //$nombre = $_FILES['myimg']['name'];
        //$nombre_tmp = $_FILES['myimg']['tmp_name'];
        //$tipo = $_FILES['myimg']['type'];
        //$tamano = $_FILES['myimg']['size'];
              
        global $destination_file;
        $destination_file = 'img/imgCliente/'.$safe_filename;
        
        if( file_exists( 'img/imgCliente/'.$safe_filename) ){
            unlink('img/imgCliente/'.$safe_filename);
                }
        elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
            
        if((file_exists( 'img/imgCliente/'.$_SESSION['smyimg'])&&($_SESSION['smyimg']!= "default.png"))){
                unlink('img/imgCliente/'.$_SESSION['smyimg']);
            }else{ }
        
            // Renombrar el archivo:
            $extension = substr($_FILES['myimg']['name'],-3);
            // print($extension);
            // $extension = end(explode('.', $_FILES['myimg']['name']) ); // Presuntamente deprecated
            //date('H:i:s');  date('Y-m-d');
            $dt = date('is');
            global $new_name;
            $new_name = $_SESSION['dni_cliente']."_".$dt.".".$extension;
            global $rename_filename;
            $rename_filename = "img/imgCliente/".$new_name;	
            rename($destination_file, $rename_filename);
            $_SESSION['new_name'] = $new_name;
    
        global $db;     global $db_name; 
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        $sqlc = "UPDATE `$db_name`.$table_name SET `img` = '$new_name' WHERE $table_name.`id_cliente` = $_SESSION[id_cliente] LIMIT 1 ";
    
            if(mysqli_query($db, $sqlc)){
                
                if((file_exists( 'img/imgCliente/'.$_SESSION['img'])&&($_SESSION['img']!= "default.png"))){
                    unlink('img/imgCliente/'.$_SESSION['smyimg']);
                }else{ }

        $_SESSION['img'] = $new_name;
 
        global $UserActionLog;  
        $UserActionLog = "\t* MODIFICA IMAGEN ".$_SESSION['nombre']." ".$_SESSION['apellidos']." || DNI: ".$_SESSION['dni_cliente'].PHP_EOL."\t* IMAGEN OLD: ".$_SESSION['smyimg']." POR: ".$_SESSION['img'];
        global $ruta;
        require $ruta.'writeUserLog.php';
    
                $rutaJsRedir = "userMisDatos";
                global $redirphp;
                $redirphp ="<script type='text/javascript'>
                                function redir(){
                                    window.location.href='".$rutaJsRedir."';
                                } setTimeout('redir()',10); <!--EN MICROSEGUNDOS-->
                            </script>";
                echo ($redirphp);
        
                //show_datos();

            } else { print("<font color='#FF0000'><h5>* ERROR L.183: </font>".mysqli_error($db))."</h5>";
                    show_form_img();
                            }
                    // print("El archivo se ha guardado en: ".$destination_file);
            
        }else { print("No se ha podido guardar el archivo en el direcctorio img_admin/");}
    
        } // FIN FUNCTION process_form_img()

                       ////////////////////				   ////////////////////
    ////////////////////				////////////////////				////////////////////
                     ////////////////////				  ///////////////////

    function show_form_img($errors=[]){

        global $botonMisDatos;
        if(isset($_SESSION['nivel'])){
        $botonMisDatos = "<button class='botonAzul' tabindex='3'>
                            <a href='userMisDatos'>CANCELAR Y VOLVER</a>
                         </button>";
        } else {  $botonMisDatos = ""; }
    
        global $defaults;

        if(isset($_POST['modifImg'])){

            $_SESSION['smyimg'] = $_SESSION['img'];
            
            $defaults = array ( 'id_cliente' => $_SESSION['id_cliente'],
                                'myimg' => $_SESSION['smyimg']);
        
        } elseif(isset($_POST['imagenmodif'])){ 	
                $defaults = array ( 'id_cliente' => $_SESSION['id_cliente'],
                                    'myimg' =>@$_POST['myimg']);
                }
	
    echo "<section>";

	if ($errors){
            print("	<div  class='errorsimg'>
                        <font color='#FF0000'><h5>* SOLUCIONE ESTOS ERRORES</h5></font>");
            for($a=0; $c=count($errors), $a<$c; $a++){ print($errors [$a]);}
            print("</div><div style='clear:both'></div>");
		}
		
	print("<table class='imgForm'>
				<tr>
					<td colspan=2 class='BorderInf'><h5>SELECCIONE UNA NUEVA IMAGEN</h5></td>
				</tr>
				<tr>
					<td class='BorderInf'>
			<h5>IMAGEN ACTUAL DE:</h5><h5>".$_SESSION['nombre']." ".$_SESSION['apellidos']."</h5>
					</td>
					<td class='BorderInf'>
                        <img src='img/imgCliente/".$_SESSION['smyimg']."' />
					</td>
				</tr>
				<tr>
					<td colspan=2>
            <form name='form_datos' method='post' action='userMisDatos' enctype='multipart/form-data'>
                <h5>SELECCIONE UNA IMAGEN</h5>
                <input type='file' name='myimg' id='myimg' value='".$defaults['myimg']."' tabindex='1'/>
                    </td>
				</tr>
				<tr height=30px>
					<td colspan=2>
						<input type='hidden' name='id' value='".$_SESSION['id_cliente']."' />					
						<input type='hidden' name='ref' value='".$_SESSION['dni_cliente']."' />					
					<input type='submit' value='MODIFICAR IMAGEN' class='botonLila'  tabindex='2'/>
					<input type='hidden' name='imagenmodif' value=1 />
            </form>	
                    </td>																			
				</tr>
            </table>".$botonMisDatos."					
        </section>");

	} // FIN DUNCTION show_form_img

?>
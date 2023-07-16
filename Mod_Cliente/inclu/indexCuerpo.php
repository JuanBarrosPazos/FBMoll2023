<?php

    require '../Mod_Admin/Inclu/my_bbdd_clave.php';

    //require "conect/info_table_bbdd.php";

    /* LOGICA DE EJECUCIÓN */
        global $key;

    if(isset($_SESSION['Nivel'])){
    if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

        switch (true) {
            case (isset($_POST['filtrar'])):
                process_filtro();
                break;
            case (isset($_POST['newClient'])):
                show_form_NewClient();
                break;

            case (isset($_POST['regNewUser'])):
                if($form_errors = validate_newClient()){ 
                    show_form_NewClient($form_errors); 
                } else { process_newClient(); }
                break;

            case (isset($_POST['modifDat'])):
                show_form_modif_cliente();
                break;
            
            case (isset($_POST['ModifCliente'])):
                if($form_errors = validate_modif_cliente()){ 
                    show_form_modif_cliente($form_errors); 
                } else { process_form_modif_cliente(); }
                break;
            
            case (isset($_POST['modifImg'])):
                // MODIFICO LA IMAGEN USUARIO
                show_form_img();
                break;
            
            case (isset($_POST['imagenmodif'])):
                if($form_errors = validate_form_img()){ 
                    show_form_img($form_errors); 
                } else { process_form_img(); }
                break;
            
            case (isset($_POST['borrandoFeed'])):
                // BORRADO DE CLIENTE Y GRABADO EN FEEDBACK
                borrarDatFeed();
                vertodosFeed();
                break;
            
            case (isset($_POST['borrarFeed'])):
                // CONFIRMACION DEL BORRADO
                echo "<img src='../img/imgCliente/".$_POST['img']."' style='width:70px; border-radius:4px; margin-top: 0.6em;'>
                <h3>".$_POST['nombre']." ".$_POST['apellido']."</h3>";
                echo "<form id='del' name='del' method='POST' action='$_SERVER[PHP_SELF]'>
                    <input id='id_cliente' name='id_cliente' type='hidden' value='".$_POST['id_cliente']."'>
                    <input id='img' name='img' type='hidden' value='".$_POST['img']."'>
                    <input id='send' name='send' type='submit' value='FEEDBACK CLIENTE CONFIRME EL BORRADO DEFINITIVO DE LOS DATOS' tabindex='2' class='botonRojo' style='min-width: max-content;'>
                    <input id='borrandoFeed' name='borrandoFeed' type='hidden' value=1>
                    </form>
                    <form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]'>
                        <button class='botonVerde'>
                            <a href='index.php'>VER TODOS LOS USUARIOS</a>
                        </button>
                        <input id='send' name='send' type='submit' value='CANCELAR Y VOLVER A TABLA FEEDBACK' class='botonNaranja'>
                        <input id='verFeed' name='verFeed' type='hidden' value=1>
                    </form>";
                break;
            
            case (isset($_POST['borrando'])):
                // BORRADO DE CLIENTE Y GRABADO EN FEEDBACK
                borrarDat();
                vertodos();
                break;
            
            case (isset($_POST['borrar'])):
                // CONFIRMACION DEL BORRADO
                echo "<img src='../img/imgCliente/".$_POST['img']."' style='width:70px; border-radius:4px; margin-top: 0.6em;'>
                <h3>".$_POST['nombre']." ".$_POST['apellido']."</h3>";
                echo "<form id='del' name='del' method='POST' action='$_SERVER[PHP_SELF]'>
                    <input id='id_cliente' name='id_cliente' type='hidden' value='".$_POST['id_cliente']."'>
                    <input id='send' name='send' type='submit' value='CONFIRME EL BORRADO DEFINITIVO DE LOS DATOS' tabindex='2' class='botonRojo' style='min-width: max-content;'>
                    <input id='borrando' name='borrando' type='hidden' value=1>
                        </form>";
                echo "<form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]'>
                <button class='botonNaranja'>
                    <a href='index.php'>CANCELAR Y VOLVER A TODOS LOS USUARIOS</a>
                </button>
                <input id='send' name='send' type='submit' value='VER TABLA FEEDBACK' class='botonVerde'>
                <input id='verFeed' name='verFeed' type='hidden' value=1>
                        </form>";
                break;
            
            case (isset($_POST['recupClient'])):
                recuperoCliente();
                break;
            
            case (isset($_POST['verFeed'])):
                vertodosFeed();
                break;
            
            case (isset($_GET['vertodos'])):
                vertodos();
                break;
            
            case (isset($_POST['vertodos'])):
                vertodos();
                //show_form_backup();    show_form_vertodos();
                break;
            
            case (isset($_POST['backup'])):
                echo "<h3>HE PULSADO BACKUP BBDD</h3>";
                process_backup();
                show_form_backup();    show_form_vertodos();
                break;
            
            case (isset($_POST['ocultoR'])):
                process_contac_dat();
                break;

            default:
                vertodos();
                break;
        }

        }else{ // FIN ADMIN O PLUS
            require '../Mod_Admin/Inclu/table_permisos.php';
        }
    }// FIN ISSET $_SESSION['Nivel']
    else{
        require '../Mod_Admin/Inclu/table_permisos.php';
        }

    /* FIN LOGICA DE EJECUCIÓN */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    function show_form_filtro(){

        global $defaults;
        if(isset($_POST['filtrar'])){
            $defaults = array ( 'nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'dni' => $_POST['dni'],);
        }else{
            $defaults = array ( 'nombre' => '',
                                'apellido' => '',
                                'dni' => '',);
        }
        
        print ("<form id='filtro' name='filtro' method='POST' action='$_SERVER[PHP_SELF]'>
            <input autofocus type='text' name='nombre' id='nombre' size='22' maxlength='22' pattern='[a-zA-Z\s]{3,22}' placeholder='NOMBRE' value='".$defaults['nombre']."' tabindex='1'>
            <input type='text' name='apellido' id='apellido' size='22' maxlength='22' pattern='[a-zA-Z\s]{3,22}' placeholder='APELLIDO' value='".$defaults['apellido']."' tabindex='2'>
            <input type='number' name='dni' id='dni' size='22' maxlength='8' min='11111111' max='88888888'  placeholder='Nº DNI' value='".$defaults['dni']."' tabindex='3'>
                <input type='submit' name='send' value='FILTRAR USUARIOS' class='botonVerde' tabindex='4'>
                <input type='hidden' name='filtrar' id='filtrar' value='1'>
                </form>");

        } // FIN FUNCTION show_form_filtro()

    function process_filtro(){

        show_form_filtro();

        print ("<h4 id='hora'>000000</h4><h3>LA PERLA CLIENTES FILTRO
                    <form id='newClient' name='newClient' method='POST' action='$_SERVER[PHP_SELF]'>
        <input type='submit' id='send' name='send' value='CREAR UN NUEVO CLIENTE' class='botonVerde'>
        <input type='hidden' id='newClient' name='newClient' value=1>
                    </form></h3>");

        global $db;     global $db_name;
        global $table_name;     $table_name = "`".$_SESSION['clave']."cliente`";
        

    global $verfiltro;
    $verfiltro = "SELECT * FROM `$db_name`.$table_name WHERE (`dni` != '55555555' AND `dni` != '99999999') ";

        global $a;
        if($_POST['nombre']!=""){
            $a = "AND";
            $verfiltro .= " $a `Nombre` LIKE '%$_POST[nombre]%' ";
        }else{ $a=""; }
        if($_POST['apellido']!=""){
            if($a == ""){ $a = "AND"; }else{ $a = "OR";}
            $verfiltro .= " $a `Apellidos` LIKE '%$_POST[apellido]%' ";
        }else{  }
        if($_POST['dni']!=""){
            if($a == ""){ $a = "AND"; }else{ $a = "OR";}
            $verfiltro .= " $a `dni` LIKE '%$_POST[dni]%' ";
        }else{  }

        //echo $verfiltro."<br>";

        $verfiltroQry = mysqli_query($db, $verfiltro);
        $verfiltroCount = mysqli_num_rows($verfiltroQry);
        if(!$verfiltroQry){
                echo "<h3>ERROR L.60 ".mysqli_error($db)."</h3>";
        }else{
            if($verfiltroCount < 1){
                echo "<h3>NO HAY DATOS</h3>";
            }else{ // HAY DATOS Y SE IMPRIMEN
                echo "<table class='vertodos'>
                        <tr>
                    <th>ID</th><th>NIVEL</th><th>NOMBRE</th><th>DNI</th><th>IMAGEN</th>
                    <th>DATA REG</th><th colspan=4></th>
                        </tr>";
                global $row;
                while ($row = mysqli_fetch_assoc($verfiltroQry)) {
                    echo "<tr>
                            <td>".$row['id_cliente']."</td><td>".$row['Nivel']."</td>
                            <td>".$row['Nombre']." ".$row['Apellidos']."</td>
                            <td>".$row['dni'].$row['ldni']."</td>
                            <td><img src='../img/imgCliente/".$row['img']."' style='width:30px;'></td>
                            <td>".$row['datereg']."</td>
                            <td>
            <form id='detalles' name='detalles' method='POST' action='clientepop.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=440px,height=630px')\">
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row['id_cliente']."'> 
            <input type='submit' id='send' name='send' value='VER DETALLES' class='botonVerde'>
            <input type='hidden' id='detalle' name='detalle' value=1>
                    </form>
                            </td>

                            <td> 
            <form id='logs' name='logs' method='POST' action='clientepop.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=540px,height=430px')\">
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'> 
            <input type='submit' id='send' name='send' value='VER LOGS' class='botonVerde'>
            <input type='hidden' id='logcliente' name='logcliente' value=1>
                    </form>
                            </td>

                            <td>
                    <form id='modDat' name='modDat' method='POST' action='$_SERVER[PHP_SELF]'>
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row["id_cliente"]."'>
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'>
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'>
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'>
            <input type='hidden' id='lDni' name='lDni' value='".$row['ldni']."'>
            <input type='hidden' id='mail' name='mail' value='".$row['Email']."'>
            <input type='hidden' id='fecha' name='fecha' value='".$row['DateNac']."'>
            <input type='hidden' id='telf' name='telf' value='".$row['Tlf']."'>
            <input type='hidden' id='nick' name='nick' value='".$row['Usuario']."'>
            <input type='hidden' id='nick2' name='nick2' value='".$row['Usuario']."'>
            <input type='hidden' id='passw' name='passw' value='".$row['Pass']."'>
            <input type='hidden' id='passw2' name='passw2' value='".$row['Pass']."'>
            <input type='hidden' id='direccion' name='direccion' value='".$row['Direccion']."'>
            <input type='submit' id='send' name='send' value='MODIFICAR DATOS' tabindex='1' class='botonLila'>
            <input type='hidden' id='modifDat' name='modifDat' value=1>
                    </form>
                            </td>
                            <td>
                    <form id='modImg' name='modImg' method='POST' action='$_SERVER[PHP_SELF]'>
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row['id_cliente']."'> 
            <input type='hidden' id='img' name='img' value='".$row['img']."'> 
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'> 
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'> 
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'> 
            <input type='submit' id='send' name='send' value='MODIFICAR IMG' class='botonLila'>
            <input type='hidden' id='modifImg' name='modifImg' value=1>
                    </form>
                            </td>
                            <td>
                    <form id='borrar' name='borrar' method='POST' action='$_SERVER[PHP_SELF]'>
            <input id='id_cliente' name='id_cliente' type='hidden' value='".$row['id_cliente']."'> 
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'>
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'>
            <input type='hidden' id='img' name='img' value='".$row['img']."'> 
            <input type='submit' id='send' name='send' value='BORRAR' class='botonRojo'>
            <input type='hidden' id='borrar' name='borrar' value=1>
                    </form>
                </td></tr>";}
                
                echo "</table>";
            }
            } // FIN SE CUMPLE EL QUERY

         echo "<form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
            <input id='send' name='send' type='submit' value='VER TODOS LOS USUARIOS' class='botonVerde'>
            <input id='vertodos' name='vertodos' type='hidden' value=1>
                </form>
                <form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]' style='display:inline-block;'>
            <input id='send' name='send' type='submit' value='VER TABLA FEEDBACK' class='botonVerde' >
            <input id='verFeed' name='verFeed' type='hidden' value=1>
                </form>";

    } // FIN FUNCTION process_filtro()

    function vertodos(){

        show_form_filtro();

        print ("<h4 id='hora'>000000</h4><h3>LA PERLA CLIENTES
                    <form id='newClient' name='newClient' method='POST' action='$_SERVER[PHP_SELF]'>
        <input type='submit' id='send' name='send' value='CREAR UN NUEVO CLIENTE' class='botonVerde'>
        <input type='hidden' id='newClient' name='newClient' value=1>
                    </form></h3>");

        global $db;     global $db_name;
        global $table_name;     $table_name = "`".$_SESSION['clave']."cliente`";
    
        global $vertodos;
        $vertodos = "SELECT * FROM `$db_name`.$table_name WHERE `dni` != '55555555' AND `dni` != '99999999' ";
        $vertodosQry = mysqli_query($db, $vertodos);
        $vertodosCount = mysqli_num_rows($vertodosQry);
        if(!$vertodosQry){
                echo "<h3>ERROR L.60 ".mysqli_error($db)."</h3>";
        }else{
            if($vertodosCount < 1){
                echo "<h3>NO HAY DATOS</h3>";
            }else{ // HAY DATOS Y SE IMPRIMEN
                echo "<table class='vertodos'>
                        <tr>
                    <th>ID</th><th>NIVEL</th><th>NOMBRE</th><th>DNI</th><th>IMAGEN</th>
                    <th>DATA REG</th><th colspan=4></th>
                        </tr>";
                global $row;
                while ($row = mysqli_fetch_assoc($vertodosQry)) {
                    echo "<tr>
                            <td>".$row['id_cliente']."</td><td>".$row['Nivel']."</td>
                            <td>".$row['Nombre']." ".$row['Apellidos']."</td>
                            <td>".$row['dni'].$row['ldni']."</td>
                            <td><img src='../img/imgCliente/".$row['img']."' style='width:30px;'></td>
                            <td>".$row['datereg']."</td>
                            <td>
            <form id='detalles' name='detalles' method='POST' action='clientepop.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=440px,height=630px')\">
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row['id_cliente']."'> 
            <input type='submit' id='send' name='send' value='VER DETALLES' class='botonVerde'>
            <input type='hidden' id='detalle' name='detalle' value=1>
                    </form>
                            </td>

                            <td> 
            <form id='logs' name='logs' method='POST' action='clientepop.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=540px,height=430px')\">
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'> 
            <input type='submit' id='send' name='send' value='VER LOGS' class='botonVerde'>
            <input type='hidden' id='logcliente' name='logcliente' value=1>
                    </form>
                            </td>
                            
                            <td>
                    <form id='modDat' name='modDat' method='POST' action='$_SERVER[PHP_SELF]'>
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row["id_cliente"]."'>
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'>
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'>
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'>
            <input type='hidden' id='lDni' name='lDni' value='".$row['ldni']."'>
            <input type='hidden' id='mail' name='mail' value='".$row['Email']."'>
            <input type='hidden' id='fecha' name='fecha' value='".$row['DateNac']."'>
            <input type='hidden' id='telf' name='telf' value='".$row['Tlf']."'>
            <input type='hidden' id='nick' name='nick' value='".$row['Usuario']."'>
            <input type='hidden' id='nick2' name='nick2' value='".$row['Usuario']."'>
            <input type='hidden' id='passw' name='passw' value='".$row['Pass']."'>
            <input type='hidden' id='passw2' name='passw2' value='".$row['Pass']."'>
            <input type='hidden' id='direccion' name='direccion' value='".$row['Direccion']."'>
            <input type='submit' id='send' name='send' value='MODIFICAR DATOS' tabindex='1' class='botonLila'>
            <input type='hidden' id='modifDat' name='modifDat' value=1>
                    </form>
                            </td>
                            <td>
                    <form id='modImg' name='modImg' method='POST' action='$_SERVER[PHP_SELF]'>
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row['id_cliente']."'> 
            <input type='hidden' id='img' name='img' value='".$row['img']."'> 
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'> 
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'> 
            <input type='hidden' id='dni' name='dni' value='".$row['dni']."'> 
            <input type='submit' id='send' name='send' value='MODIFICAR IMG' class='botonLila'>
            <input type='hidden' id='modifImg' name='modifImg' value=1>
                    </form>
                            </td>
                            <td>
                    <form id='borrar' name='borrar' method='POST' action='$_SERVER[PHP_SELF]'>
            <input id='id_cliente' name='id_cliente' type='hidden' value='".$row['id_cliente']."'> 
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'>
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'>
            <input type='hidden' id='img' name='img' value='".$row['img']."'> 
            <input type='submit' id='send' name='send' value='BORRAR' class='botonRojo'>
            <input type='hidden' id='borrar' name='borrar' value=1>
                    </form>
                            </td>
                            </tr>";
                    }
                echo "</table>";
            }
            } // FIN SE CUMPLE EL QUERY

         echo "<form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]'>
            <button class='botonVerde'><a href='../index.php'>VOLVER AL INICIO</a></button>
            <input id='send' name='send' type='submit' value='VER TABLA FEEDBACK' class='botonVerde'>
            <input id='verFeed' name='verFeed' type='hidden' value=1>
                    </form>";

    } // FIN FUNCTION VER TODOS

    function vertodosFeed(){

        print ("<h4 id='hora'>000000</h4><h3>LA PERLA FEEDBACK CLIENTES</h3>");

            global $db;     global $db_name;
            global $table_name;     $table_name = "`".$_SESSION['clave']."clientefeed`";
    
            global $vertodos;
            $vertodos = "SELECT * FROM `$db_name`.$table_name WHERE `dni` != '55555555' AND `dni` != '99999999'";
            $vertodosQry = mysqli_query($db, $vertodos);
            $vertodosCount = mysqli_num_rows($vertodosQry);
            if(!$vertodosQry){
                echo "<h3>ERROR L.60 ".mysqli_error($db)."</h3>";
            }else{
                if($vertodosCount < 1){
                    echo "<h3>NO HAY DATOS</h3>";
                    $rutaJsRedir = "index.php";
                    $redirphp ="<script type='text/javascript'>
                                    function redir(){
                                        window.location.href='".$rutaJsRedir."';
                                    } setTimeout('redir()',4000);
                                </script>";
                    echo ($redirphp);
        
                }else{ // HAY DATOS
                echo "<table class='vertodos'>
                        <tr>
                            <th>ID</th><th>NOMBRE</th><th>DNI</th><th>IMAGEN</th><th>DATA REG</th>
                            <th>DATA DEL</th><th colspan=2></th>
                        </tr>";
                global $row;
                while ($row = mysqli_fetch_assoc($vertodosQry)) {
                    echo "<tr>
                            <td>".$row['id_cliente']."</td><td>".$row['Nombre']." ".$row['Apellidos']."</td><td>".$row['dni'].$row['ldni']."</td>
                            <td><img src='../img/imgCliente/".$row['img']."' style='width:30px;'></td>
                            <td>".$row['datereg']."</td><td>".$row['delete']."</td>
                            <td>
                <form id='detalles' name='detalles' method='POST' action='clientepop.php' target='popup' onsubmit=\"window.open('', 'popup', 'width=440px,height=630px')\">
            <input type='hidden' id='id_cliente' name='id_cliente' value='".$row['id_cliente']."'> 
            <input type='submit' id='send' name='send' value='VER DETALLES' class='botonVerde'>
            <input type='hidden' id='feed' name='feed' value=1>
                </form>
                            </td>
                            <td>
                <form id='recuDat' name='recuDat' method='POST' action='$_SERVER[PHP_SELF]'>
            <input id='id_cliente' name='id_cliente' type='hidden' value='".$row['id_cliente']."'> 
            <input id='send' name='send' type='submit' value='RECUPERAR CLIENTE' tabindex='1' class='botonLila'>
            <input id='recupClient' name='recupClient' type='hidden' value=1> 
                </form>
                            </td>
                            <td>
                    <form id='borrarFeed' name='borrarFeed' method='POST' action='$_SERVER[PHP_SELF]'>
            <input id='id_cliente' name='id_cliente' type='hidden' value='".$row['id_cliente']."'> 
            <input type='hidden' id='nombre' name='nombre' value='".$row['Nombre']."'>
            <input type='hidden' id='apellido' name='apellido' value='".$row['Apellidos']."'>
            <input type='hidden' id='img' name='img' value='".$row['img']."'> 
            <input type='submit' id='send' name='send' value='BORRAR FEEDBACK' class='botonRojo'>
            <input type='hidden' id='borrarFeed' name='borrarFeed' value=1>
                    </form></td></tr>";
                    }
                echo "</table>";
                } // FIN HAY DATOS
            } // FIN SE CUMPLE EL QUERY

        echo "<form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]'>
            <button class='botonVerde'><a href='../index.php'>VOLVER AL INICIO</a></button>
            <input id='send' name='send' type='submit' value='VER TODOS LOS USUARIOS' class='botonVerde'>
            <input id='vertodos' name='vertodos' type='hidden' value=1>
                    </form>";

    } // FIN FUNCTION CLIENTES FEED


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    function validate_modif_cliente(){

        global $db;     global $db_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_name WHERE `id_cliente`!='$_POST[id_cliente]' AND (`dni` = '$_POST[dni]' OR `Email` = '$_POST[mail]' OR `Tlf`= '$_POST[telf]' OR `Usuario`='$_POST[nick]' OR `Pass`='$_POST[passw]') LIMIT 1 ";

        global $sqlUserQry;     $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr;     $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        global $sqlUserCount;   $sqlUserCount = mysqli_num_rows($sqlUserQry);

        if(!$sqlUser){ 
            echo "ERROR L.821: ".mysqli_error($db);
        }elseif($sqlUserCount>0){
            
            $errors = array();

            if($sqlUserArr['dni']==$_POST['dni']){
                $errors [] = "<h5 style='color:#ff0000;'>YA EXISTE ESTE DNI.<br>MODIFIQUE LOS DATOS</h5>";
            }elseif($sqlUserArr['Email']==$_POST['mail']){
                $errors [] =  "<h5 style='color:#ff0000;'>YA EXISTE ESTE EMAIL.<br>MODIFIQUE LOS DATOS</h5>";
            }elseif($sqlUserArr['Tlf']==$_POST['telf']){
                $errors [] =  "<h3 style='color:#ff0000;'>YA EXISTE ESTE TELEFONO.<br>MODIFIQUE LOS DATOS</h3>";
            }else{
                $errors [] =  "<h3 style='color:#ff0000;'>YA EXISTE ESTE USUARIO.<br>MODIFIQUE LOS DATOS</h3>";
            }

            return $errors;

        }else{ /* NO COINCIDEN DATOS DEL USUARIO */
            //$action = "$_SERVER[PHP_SELF]"; // PARA BASE NAME
        }
        
    } // FIN FUNCTION validate_modif_cliente()

    function show_form_modif_cliente($errors=[]){

        global $botonMisDatos;  
        $botonMisDatos = '<button class="botonAzul">
                            <a href="index.php">CANCELAR Y VOLVER</a>
                          </button>';

        // MODIFICAR POR $DEFAULTS Y CREAR FUNCION DE VALIDACION
        global $defaults;

        if((isset($_POST['modifDat']))||(isset($_POST['ModifCliente']))){

            $defaults = array ( 'id_cliente' => $_POST['id_cliente'],
                                'nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'dni' => $_POST['dni'],
                                'lDni' => $_POST['lDni'],
                                'mail' => $_POST['mail'],
                                'telf' => $_POST['telf'],
                                'fecha' => $_POST['fecha'],
                                'nick' => $_POST['nick'],
                                'nick2' => $_POST['nick2'],
                                'passw' => $_POST['passw'],
                                'passw2' => $_POST['passw2'],
                                'check' => 'checked',
                                'direccion' => $_POST['direccion']);

            }else{ $defaults = array (  'id_cliente' => '',
                                        'nombre' => '',
                                        'apellido' => '',
                                        'dni' => '',
                                        'lDni' => '',
                                        'mail' => '',
                                        'telf' => '',
                                        'fecha' => '',
                                        'nick' => '',
                                        'nick2' => '',
                                        'passw' => '',
                                        'passw2' => '',
                                        'check' => 'checked',
                                        'direccion' => '');
                            }
    
        print ("<section><h3>MODIFICAR DATOS DE USUARIO</h3><h5 id='hora'>000000</h5><hr>");

    	if ($errors){
            print("	<div  class='errorsimg'>
                        <font color='#FF0000'><h5>* SOLUCIONE ESTOS ERRORES</h5></font>");
            for($a=0; $c=count($errors), $a<$c; $a++){ print($errors [$a]);}
            print("</div><div style='clear:both'></div>");
		}

        print("<!-- PARA URI -->
            <form id='datos' name='datos' method='post' action='$_SERVER[PHP_SELF]' onsubmit='return validateForm()'>

            <input type='hidden' id='id_cliente' name='id_cliente' value='".$defaults["id_cliente"]."'>
            <label for='nombre'>Id Cliente: </label>".$defaults["id_cliente"]."
    
                <div>
                    <label for='nombre'>Nombre: </label>
                    <input autofocus id='nombre' name='nombre' type='text' size='20' maxlength='22' tabindex='1' placeholder='Solo Letras' value='".$defaults["nombre"]."'>
                    <div id='nombreD'></div>
                </div>
    
                <div>
                    <label for='apellido'>Apellido: </label>
                    <input type='text' id='apellido' name='apellido' size='20' maxlength='22' tabindex='2' placeholder='Solo Letras' value='".$defaults["apellido"]."'>
                    <div id='apellidoD'></div>
                </div>
    
                <div>
                    <label for='dni'>DNI: </label>
                    <input type='hidden' class='inpLit' id='dni' name='dni' value='".$defaults["dni"]."'>
                    ".$defaults["dni"]."
                    <div id='dniD'></div>
                </div>
        
                <div>
                    <label for='lDni'>Letra DNI: </label>
                    <input type='hidden' class='inpLit' id='lDni' name='lDni' value='".$defaults["lDni"]."'>
                    ".$defaults["lDni"]."
                    <div id='lDniD'></div>
                </div>
    
                <div>
                    <label for='mail'>Email: </label>
                    <input id='mail' name='mail' type='text' size='20' maxlength='30' tabindex='5' placeholder='miemail@xxx.xx' value='".$defaults["mail"]."'>
                    <div id='mailD'></div>
                </div>
        
                <div>
                    <label for='telf'>Tel&eacute;fono: </label>
                    <input class='inpLit' id='telf' name='telf' type='text' size='20' maxlength='12' tabindex='6' placeholder='Solo 9 Numeros' value='".$defaults["telf"]."'>
                    <div id='telfD'></div>
                </div>
    
                <div>
                    <label for='fecha'>Fecha Nacimiento: </label>
                <input class='inpLit' id='fecha' name='fecha' type='date' size='20' tabindex='7' value='".$defaults["fecha"]."'>
                    <div id='fechaD'></div>
                </div>
    
                <div>
                    <label for='nick'>Nick: </label>
                    <input id='nick' name='nick' type='text' size='20' maxlength='22' tabindex='8' placeholder='Solo Letras' value='".$defaults["nick"]."'>
                    <div id='nickD'></div>
                </div>
                <div>
                    <label for='nick2'>Nick Confirme: </label>
                    <input id='nick2' name='nick2' type='text' size='20' maxlength='22' tabindex='9' placeholder='Solo Letras' value='".$defaults["nick2"]."'>
                    <div id='nick2D'></div>
                </div>
    
                <div>
                    <label for='passw'>Password: </label>
                    <input id='passw' name='passw' type='text' size='20' maxlength='22' tabindex='10' placeholder='Solo Letras' value='".$defaults["passw"]."'>
                    <div id='passwD'></div>
                </div>
                <div>
                    <label for='passw2'>Password Confirme: </label>
                    <input id='passw2' name='passw2' type='text' size='20' maxlength='22' tabindex='11' placeholder='Solo Letras' value='".$defaults["passw2"]."'>
                    <div id='passw2D'></div>
                </div>
    
                <div>
                    <label for='check'>Condiciones :</label>
            <input id='check' name='check' type='checkbox' tabindex='12' onchange='ejercicio()' ".$defaults['check']."> Aceptar
                    <div id='checkD'></div>
                </div>
    
                <div>
                    <label for='direccion'>Direccion: </label>
                    <input autofocus id='direccion' name='direccion' type='text' size='20' maxlength='56' tabindex='13' placeholder='Solo Letras' value='".$defaults["direccion"]."'>
                    <div id='direccionD'></div>
                </div>
    
            <div style='text-align: center;'>
                <!-- -->
                <input id='send' name='send' type='submit' value='MODIFICAR DATOS' tabindex='14' class='botonLila'> 
                <input id='ModifCliente' name='ModifCliente' type='hidden' value='1'>
            </div>
            </form>
            <div id='datosF'></div>".$botonMisDatos."</section>");
    
    } // FIN FUNCTION show_form_modif_cliente()


    function process_form_modif_cliente(){

        global $db;         global $db_name;    global $regUser;     global $ruta;
        global $formHead;   global $redirphp;   global $UserActionLog; 

        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";
        mysqli_report(MYSQLI_REPORT_OFF);
        $regUser = "UPDATE `$db_name`.$table_name SET `Nombre`='$_POST[nombre]',`Apellidos`='$_POST[apellido]',`dni`='$_POST[dni]',`ldni`='$_POST[lDni]',`Email`='$_POST[mail]',`DateNac`='$_POST[fecha]',`Tlf`='$_POST[telf]',`Usuario`='$_POST[nick]',`Pass`='$_POST[passw]',`Direccion`='$_POST[direccion]' WHERE $table_name.`id_cliente` = $_POST[id_cliente] AND $table_name.`dni` = '$_POST[dni]'  LIMIT 1 ";
           
        if(mysqli_query($db, $regUser)){

            require $ruta.'incluRegistroDatPost.php';

            /*  */
            $rutaJsRedir = "index.php";
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',6000);
                        </script>";
            echo ($redirphp);
            
            //header("Location: index.php");
            
        }else{
            $formHead = '<h3>ERROR EN EL REGISTRO DE SUS DATOS</h3>';
            echo "ERROR L.386: ".mysqli_error($db)." ".$table_name."<br>";
            $rutaJsRedir = "index.php";
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',8000);
                        </script>";
            echo ($redirphp);
        }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    } // FIN PROCESS FORM

    function recuperoCliente(){

        global $db;     global $db_name;         global $ruta;

        global $table_nameU;    $table_nameU = "`".$_SESSION['clave']."clientefeed`";
        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_nameU WHERE `id_cliente` = $_POST[id_cliente] LIMIT 1";
        global $sqlUserQry; $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr; $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        if(!$sqlUser){ 
            // NO SE CUMPLE LA CONSULTA DEL USUARIO
            echo "ERROR L.178: ".mysqli_error($db);
        }else{ 
            // SE CUMPLE LA CONSULTA DEL USUARIO Y GRABO DATOS EN FEEDBACK
            global $dateFeed;    $dateFeed = date('Y-m-d H:i:s');
            global $table_namef; $table_namef = "`".$_SESSION['clave']."cliente`";
            mysqli_report(MYSQLI_REPORT_OFF);
            global $userFeed;      
            $userFeed ="INSERT INTO `$db_name`.$table_namef(`Nivel`,`Nombre`, `Apellidos`, `dni`, `ldni`, `Email`, `DateNac`, `Tlf`, `Usuario`, `Pass`, `Direccion`, `img`, `datereg`, `lastin`, `lastout`, `visitadmin`) VALUES ('$sqlUserArr[Nivel]','$sqlUserArr[Nombre]','$sqlUserArr[Apellidos]','$sqlUserArr[dni]','$sqlUserArr[ldni]','$sqlUserArr[Email]','$sqlUserArr[DateNac]','$sqlUserArr[Tlf]','$sqlUserArr[Usuario]','$sqlUserArr[Pass]','$sqlUserArr[Direccion]','$sqlUserArr[img]','$sqlUserArr[datereg]','$sqlUserArr[lastin]','$sqlUserArr[lastout]','$sqlUserArr[visitadmin]')";
            global $userFeedQry; $userFeedQry = mysqli_query($db, $userFeed);
            if(!$userFeedQry){
                // NO SE CUMPLE EL QUERY
                echo "ERROR L.190: ".mysqli_error($db);
            }else{
                // SE CUMPLE EL QUERY Y BORRO EL USUARIO DEL LA TABLA CLIENTES.
                global $table_name;     $table_name = "`".$_SESSION['clave']."clientefeed`";
                mysqli_report(MYSQLI_REPORT_OFF);
                global $borrarDatos;
                $borrarDatos = "DELETE FROM `$db_name`.$table_name WHERE $table_name.`id_cliente` = $_POST[id_cliente] LIMIT 1";
                global $borrarDatosQry;
                $borrarDatosQry = mysqli_query($db, $borrarDatos);
                if(!$borrarDatosQry){
                    echo "<h3>ERROR L.200: ".mysqli_error($db)."</h3>";
                }else{

                    vertodosFeed();

                    echo "<h3>SE HA RECUPERADO EL FEEDBACK DEL USUARIO</h3>";

                } // FIN DELETE $borrarDatos FEEDBACK

            } // FIN INSERT $user CLIENTE

        } // FIN CONSULTA USUARIO $sqlUser FEEDBACK.

    } // FIN FUNCTION recuperoCliente()

    function borrarDat(){ 
        // BORRO CLIENTE Y LO GRABO EN FEEDBACK CLIENTE

        global $db;     global $db_name;         global $ruta;

        global $table_nameU;    $table_nameU = "`".$_SESSION['clave']."cliente`";
        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_nameU WHERE `id_cliente` = $_POST[id_cliente] LIMIT 1";
        global $sqlUserQry; $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr; $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        if(!$sqlUser){ 
            // NO SE CUMPLE LA CONSULTA DEL USUARIO
            echo "ERROR L.269: ".mysqli_error($db);
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
                echo "ERROR L.281: ".mysqli_error($db);
            }else{
                // SE CUMPLE EL QUERY Y BORRO EL USUARIO DEL LA TABLA CLIENTES.
                global $table_name;     $table_name = "`".$_SESSION['clave']."cliente`";
                mysqli_report(MYSQLI_REPORT_OFF);
                global $borrarDatos;
                $borrarDatos = "DELETE FROM `$db_name`.$table_name WHERE $table_name.`id_cliente` = $_POST[id_cliente] LIMIT 1";
                global $borrarDatosQry;
                $borrarDatosQry = mysqli_query($db, $borrarDatos);
                if(!$borrarDatosQry){
                    echo "<h3>ERROR L.291: ".mysqli_error($db)."</h3>";
                }else{
                    echo "<h3>SE HA BORRADO EL USUARIO</h3>";
                } // FIN DELETE $borrarDatos

            } // FIN INSERT $userFeed

        } // FIN CONSULTA USUARIO $sqlUser.

    } // FIN FUNCTION borrarDat()
    

    function  borrarDatFeed(){ 
        // BORRO CLIENTE FEEDBACK Y ELIMINACIÓN TOTAL DE LOS DATOS DEL SERVIDOR

        global $db;     global $db_name;         global $ruta;
 
        // SE CUMPLE EL QUERY Y BORRO EL USUARIO DEL LA TABLA CLIENTES.
        global $table_name;     $table_name = "`".$_SESSION['clave']."clientefeed`";
        mysqli_report(MYSQLI_REPORT_OFF);
        global $borrarDatos;
        $borrarDatos = "DELETE FROM `$db_name`.$table_name WHERE $table_name.`id_cliente` = $_POST[id_cliente] LIMIT 1";
        global $borrarDatosQry;
        $borrarDatosQry = mysqli_query($db, $borrarDatos);
        if(!$borrarDatosQry){
            echo "<h3>ERROR L.317: ".mysqli_error($db)."</h3>";
        }else{

            if((file_exists( '../img/imgCliente/'.$_POST['img'])&&($_POST['img']!= "default.png"))){
                    unlink('../img/imgCliente/'.$_POST['img']);
            }else{ }
            echo "<h3>SE HA ELIMINADO EL USUARIO</h3>";
        } // FIN DELETE $borrarDatos

    } // FIN FUNCTION borrarDatFeed()

    /* EL FORMULARIO DE ACCESO */
    function show_form_vertodos(){
        print("<div  align='center'>
            <form name='vertodos' action='$_SERVER[PHP_SELF]' method='post' >
                <input type='submit' value='VER TODOS LOS USUARIOS' class='botonLila' />
                <input type='hidden' name='vertodos' value=1 />
            </form></div>");
    }

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
    
        if($_FILES['myimg']['size'] == 0){
                $errors [] = "<h5>Ha de seleccionar una fotograf&iacute;a</h5>";
        }elseif((!$ext_correcta)||($extension=="psd")){
                $errors [] = "<h5>La extension no esta admitida</h5><h5>".$_FILES['myimg']['name']."</h5>";
        }elseif ($_FILES['myimg']['size'] > $limite){
                    $tamanho = $_FILES['myimg']['size'] / 1024;
                    $errors [] = "<h5>El archivo".$_FILES['myimg']['name']."</h5>
                                  <h5>Es mayor de 500 KBytes. ".$tamanho." KB</h5>";
        }elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
                    $errors [] = "<h5>La carga del archivo se ha interrumpido</h5>";
        }elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
                    $errors [] = "<h5>Es archivo no se ha cargado</h5>";
        }
                        
        return $errors;
    
            } // FIN FUNCTION validate_form_img()
    
    
    function process_form_img(){
        
        global $db;     global $safe_filename;
        
        $safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
        $safe_filename = trim(str_replace('..', '', $safe_filename));
    
        //$nombre = $_FILES['myimg']['name'];
        //$nombre_tmp = $_FILES['myimg']['tmp_name'];
        //$tipo = $_FILES['myimg']['type'];
        //$tamano = $_FILES['myimg']['size'];
              
        global $destination_file;
        $destination_file = '../img/imgCliente/'.$safe_filename;
        
        if( file_exists( '../img/imgCliente/'.$safe_filename) ){
            unlink('../img/imgCliente/'.$safe_filename);
                }
        elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
            
            // Renombrar el archivo:
            $extension = substr($_FILES['myimg']['name'],-3);
            // print($extension);
            // $extension = end(explode('.', $_FILES['myimg']['name']) ); // Presuntamente deprecated
            //date('H:i:s');  date('Y-m-d');
            $dt = date('is');
            global $new_name;
            $new_name = $_POST['dni']."_".$dt.".".$extension;
            global $rename_filename;
            $rename_filename = "../img/imgCliente/".$new_name;	
            rename($destination_file, $rename_filename);
            $_SESSION['new_name'] = $new_name;
    
        global $db;     global $db_name; 
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        $sqlc = "UPDATE `$db_name`.$table_name SET `img` = '$new_name' WHERE $table_name.`id_cliente` = $_POST[id_cliente] LIMIT 1 ";
    
        if(mysqli_query($db, $sqlc)){

            if((file_exists( '../img/imgCliente/'.$_SESSION['smyimg'])&&($_SESSION['smyimg']!= "default.png"))){
                    unlink('../img/imgCliente/'.$_SESSION['smyimg']);
            }else{ }
 
        global $UserActionLog;  
        $UserActionLog = "\t* MODIFICA IMAGEN ".$_POST['nombre']." ".$_POST['apellido']." || DNI: ".$_POST['dni'].PHP_EOL."\t* IMAGEN OLD: ".$_SESSION['smyimg']." POR: ".$new_name;

        require 'writeUserLog.php';
    
        $rutaJsRedir = "#";
        $redirphp ="<script type='text/javascript'>
                        function redir(){
                            window.location.href='".$rutaJsRedir."';
                        } setTimeout('redir()',10);
                    </script>";
        echo ($redirphp);

        //header("Location: #");

           } else { print("<font color='#FF0000'><h5>* ERROR L.183: </font>".mysqli_error($db))."</h5>";
                    show_form_img();
                            }
                    // print("El archivo se ha guardado en: ".$destination_file);
            
        }else { print("No se ha podido guardar el archivo en el direcctorio img_admin/");}
    
        } // FIN FUNCTION process_form_img()


    function show_form_img($errors=[]){
        global $defaults;
        if(isset($_POST['modifImg'])){

            $_SESSION['smyimg'] = $_POST['img'];
            
            $defaults = array ( 'id_cliente' => $_POST['id_cliente'],
                                'nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'dni' => $_POST['dni'],
                                'myimg' => $_SESSION['smyimg']);
        
        } elseif(isset($_POST['imagenmodif'])){
                $defaults = array ( 'id_cliente' => $_POST['id_cliente'],
                                    'nombre' => $_POST['nombre'],
                                    'apellido' => $_POST['apellido'],
                                    'dni' => $_POST['dni'],
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
			<h5>IMAGEN ACTUAL DE:</h5><h5>".$defaults['nombre']." ".$defaults['apellido']."</h5>
					</td>
					<td class='BorderInf'>
                        <img src='../img/imgCliente/".$_SESSION['smyimg']."' />
					</td>
				</tr>
				<tr>
					<td colspan=2>
            <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
                <h5>SELECCIONE UNA IMAGEN</h5>
                <input type='file' name='myimg' id='myimg' value='".$defaults['myimg']."' />
                    </td>
				</tr>
				<tr height=30px>
					<td colspan=2>
                    <input type='hidden' id='id_cliente' name='id_cliente' value='".$defaults['id_cliente']."'> 
                    <input type='hidden' id='nombre' name='nombre' value='".$defaults['nombre']."'> 
                    <input type='hidden' id='apellido' name='apellido' value='".$defaults['apellido']."'> 
                    <input type='hidden' id='dni' name='dni' value='".$defaults['dni']."'>
                    <input type='submit' value='MODIFICAR IMAGEN' class='botonLila'  tabindex='2'/>
					<input type='hidden' name='imagenmodif' value=1 />
            </form>	
                    </td>																			
				</tr>
                <tr>
                <td colspan=2>
            <form id='formVerFeed' name='formVerFeed' method='POST' action='$_SERVER[PHP_SELF]'>
                <input id='send' name='send' type='submit' value='VER TODOS LOS USUARIOS' class='botonVerde'>
                <input id='vertodos' name='vertodos' type='hidden' value=1>
            </form>
                </td></tr>
            </table></section>");

	} // FIN DUNCTION show_form_img
    
    /* FIN FUNCIONES MODIFICACION DE LA IMAGEN */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

            /* ******** FUNCIONES INTERACCION USUARIO ******** */

    /* INSERTO DATOS DEL FORMULARIO DE CONTACTO */

    function process_contac_dat(){

        global $id_cliente;
        if(strlen(trim($_POST['id_cliente'])) == 0){
            $id_cliente = 2;
        }else{
            $id_cliente = $_POST['id_cliente'];
        }
        global $db;     global $db_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."contacto`";

        global $procesoDat;
        $procesoDat = "INSERT INTO `$db_name`.$table_name(`id_cliente`, `nombre`, `apellido`, `mail`, `telf`, `interes`, `nComen`, `nMesas`, `fecha`, `hora`, `coment`) VALUES ('$id_cliente','$_POST[nombre]','$_POST[apellido]','$_POST[mail]','$_POST[telf]','$_POST[interes]','$_POST[nComen]','$_POST[nMesas]','$_POST[fecha]','$_POST[hora]','$_POST[coment]')";

        if(mysqli_query($db, $procesoDat)){
            echo "SE HAN PROCESADO LOS DATOS CORRECTAMENTE";
            
            $rutaJsRedir = "../index.php";
            global $redirphp;
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',3000);
                        </script>";
            echo ($redirphp);
            /*
                header("Location : ../index.php");
            */
        }else{
            echo "ERROR L.135 ".mysqli_error($db);
            //show_form_borrar();
        }

    } // FIN FUNCTION process_contac_dat()



				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    function show_form_NewClient($errors=[]){

        global $defaults;
        if(isset($_POST['regNewUser'])){

            $defaults = array ( 'nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'dni' => $_POST['dni'],
                                'lDni' => $_POST['lDni'],
                                'mail' => $_POST['mail'],
                                'telf' => $_POST['telf'],
                                'fecha' => $_POST['fecha'],
                                'nick' => $_POST['nick'],
                                'nick2' => $_POST['nick2'],
                                'passw' => $_POST['passw'],
                                'passw2' => $_POST['passw2'],
                                'check' => 'checked',
                                'direccion' => $_POST['direccion'],);
        
        } else{ $defaults = array ( 'nombre' => '',
                                    'apellido' => '',
                                    'dni' => '',
                                    'lDni' => '',
                                    'mail' => '',
                                    'telf' => '',
                                    'fecha' => '',
                                    'nick' => '',
                                    'nick2' => '',
                                    'passw' => '',
                                    'passw2' => '',
                                    'check' => '',
                                    'direccion' => '',);
                        }
	
    print ("<section><h3>FORMULARIO DE REGISTRO</h3><h5 id='hora'>000000</h5><hr>");
    
	if ($errors){
            print("	<div  class='errorsimg'>
                        <font color='#FF0000'><h5>* SOLUCIONE ESTOS ERRORES</h5></font>");
            for($a=0; $c=count($errors), $a<$c; $a++){ print($errors [$a]);}
            print("</div><div style='clear:both'></div>");
		}


        print("<!-- PARA URI -->
        <form id='datos' name='datos' method='post' action='$_SERVER[PHP_SELF]' onsubmit='return validateForm()'>

            <div>
                <label for='nombre'>Nombre: </label>
                <input autofocus id='nombre' name='nombre' type='text' size='20' maxlength='22' tabindex='1' placeholder='Solo Letras' value='".$defaults['nombre']."'>
                <div id='nombreD'></div>
            </div>

            <div>
                <label for='apellido'>Apellido: </label>
                <input id='apellido' name='apellido' type='text' size='20' maxlength='22' tabindex='2' placeholder='Solo Letras' value='".$defaults['apellido']."'>
                <div id='apellidoD'></div>
            </div>

            <div>
                <label for='dni'>DNI: </label>
                <input class='inpLit' id='dni' name='dni'  type='text' size='20' maxlength='11' tabindex='3' placeholder='Solo 8 Numeros' value='".$defaults['dni']."'>
                <div id='dniD'></div>
            </div>
    
            <div>
                <label for='lDni'>Letra DNI: </label>
                <input class='inpLit' id='lDni' name='lDni' type='text' size='20' maxlength='2' tabindex='4' placeholder='Solo 1 Letra' value='".$defaults['lDni']."' >
                <div id='lDniD'></div>
            </div>

            <div>
                <label for='mail'>Email: </label>
                <input id='mail' name='mail' type='text' size='20' maxlength='30' tabindex='5' placeholder='miemail@xxx.xx' value='".$defaults['mail']."' >
                <div id='mailD'></div>
            </div>
    
            <div>
                <label for='telf'>Tel&eacute;fono: </label>
                <input class='inpLit' id='telf' name='telf' type='text' size='20' maxlength='12' tabindex='6' placeholder='Solo 9 Numeros' value='".$defaults['telf']."' >
                <div id='telfD'></div>
            </div>

            <div>
                <label for='fecha'>Fecha Nacimiento: </label>
                <input class='inpLit' id='fecha' name='fecha' type='date' size='20' tabindex='7' value='".$defaults['fecha']."' >
                <div id='fechaD'></div>
            </div>

            <div>
                <label for='nick'>Nick: </label>
                <input id='nick' name='nick' type='text' size='20' maxlength='22' tabindex='8' placeholder='Solo Letras' value='".$defaults['nick']."' >
                <div id='nickD'></div>
            </div>
            <div>
                <label for='nick2'>Nick Confirme: </label>
                <input id='nick2' name='nick2' type='text' size='20' maxlength='22' tabindex='9' placeholder='Solo Letras' value='".$defaults['nick2']."' >
                <div id='nick2D'></div>
            </div>

            <div>
                <label for='passw'>Password: </label>
                <input id='passw' name='passw' type='text' size='20' maxlength='22' tabindex='10' placeholder='Solo Letras' value='".$defaults['passw']."' >
                <div id='passwD'></div>
            </div>
            <div>
                <label for='passw2'>Password Confirme: </label>
                <input id='passw2' name='passw2' type='text' size='20' maxlength='22' tabindex='11' placeholder='Solo Letras' value='".$defaults['passw2']."' >
                <div id='passw2D'></div>
            </div>
 
            <div>
                <label for='check'>Condiciones :</label>
                <input id='check' name='check' type='checkbox' tabindex='12' onchange='ejercicio()'  ".$defaults['check']."> Aceptar
                <div id='checkD'></div>
            </div>

            <div>
                <label for='direccion'>Direccion: </label>
                <input autofocus id='direccion' name='direccion' type='text' size='20' maxlength='56' tabindex='13' placeholder='Solo Letras' value='".$defaults['direccion']."' >
                <div id='direccionD'></div>
            </div>

        <div style='text-align: center;'>
            <input type='submit' id='send' name='send' value='REGISTRAR NUEVO USUARIO' tabindex='14' class='botonLila'> 
            <input type='hidden' id='regNewUser' name='regNewUser' value='1'>
        </div>
            <button class='botonVerde'>
                <a href='index.php'>CANCELAR Y VOLVER A TODOS LOS USUARIOS</a>
            </button>
        </form>
        <div id='datosF'></div>
    </section>");

    } // FIN FUNCTION show_form_NewClient()

    function validate_newClient(){
        
        global $db;     global $db_name;
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        mysqli_report(MYSQLI_REPORT_OFF);
        global $sqlUser;
        $sqlUser =  "SELECT * FROM `$db_name`.$table_name WHERE `dni` = '$_POST[dni]' OR `Email` = '$_POST[mail]' OR `Tlf`= '$_POST[telf]' OR `Usuario`='$_POST[nick]' OR `Pass`='$_POST[passw]' LIMIT 1 ";

        global $sqlUserQry;     $sqlUserQry = mysqli_query($db, $sqlUser);
        global $sqlUserArr;     $sqlUserArr = mysqli_fetch_assoc($sqlUserQry);
        global $sqlUserCount;   $sqlUserCount = mysqli_num_rows($sqlUserQry);

            if(!$sqlUser){ 
                echo "ERROR L.821: ".mysqli_error($db);
            }elseif($sqlUserCount>0){
                
                $errors = array();

                if($sqlUserArr['dni']==$_POST['dni']){
                    $errors [] = "<h5 style='color:#ff0000;'>YA EXISTE ESTE DNI.<br>MODIFIQUE LOS DATOS</h5>";
                }elseif($sqlUserArr['Email']==$_POST['mail']){
                    $errors [] =  "<h5 style='color:#ff0000;'>YA EXISTE ESTE EMAIL.<br>MODIFIQUE LOS DATOS</h5>";
                }elseif($sqlUserArr['Tlf']==$_POST['telf']){
                    $errors [] =  "<h3 style='color:#ff0000;'>YA EXISTE ESTE TELEFONO.<br>MODIFIQUE LOS DATOS</h3>";
                }else{
                    $errors [] =  "<h3 style='color:#ff0000;'>YA EXISTE ESTE USUARIO.<br>MODIFIQUE LOS DATOS</h3>";
                }

                return $errors;

            }else{ /* NO COINCIDEN DATOS DEL USUARIO */
                //$action = "$_SERVER[PHP_SELF]"; // PARA BASE NAME
            }

    } // FIN FUNCION validate_newClient()

    function process_newClient(){

        global $db;     global $db_name;    global $ruta;   global $UserActionLog;

        mysqli_report(MYSQLI_REPORT_OFF);
        global $table_name; $table_name = "`".$_SESSION['clave']."cliente`";

        $regUser = "INSERT INTO `$db_name`.$table_name(`Nombre`, `Apellidos`, `dni`, `ldni`, `Email`, `DateNac`, `Tlf`, `Usuario`, `Pass`, `Direccion`) VALUES ('$_POST[nombre]','$_POST[apellido]','$_POST[dni]','$_POST[lDni]','$_POST[mail]','$_POST[fecha]','$_POST[telf]','$_POST[nick]','$_POST[passw]','$_POST[direccion]')";
        $formHead = '<h5 id="hora">000000</h5><h3>SE HAN REGISTRADO LOS DATOS CORRECTAMENTE</h3>';

        $UserActionLog = "\t* CREA NUEVO USUARIO: ".$_POST['nombre']." ".$_POST['apellido']." || DNI: ".$_POST['dni'].$_POST['lDni'].PHP_EOL;

        if(mysqli_query($db, $regUser)){ 
            require $ruta.'incluRegistroDatPost.php';
            //header("Location: index.php");
            $rutaJsRedir = "index.php";
            $redirphp ="<script type='text/javascript'>
                            function redir(){
                                window.location.href='".$rutaJsRedir."';
                            } setTimeout('redir()',10);
                        </script>";
            echo ($redirphp);

        }else{
            echo "ERROR L.91/104: ".mysqli_error($db)." ".$table_name."<br>";
        }

    } // FIN FUNCTION process_newClient()

            /* ******** FIN FUNCIONES INTERACCION USUARIO ******** */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

            /* ******** FUNCIONES CONSTRUCCIÓN / DESTRUCCIÓN DE TABLAS ******** */

    /* FORMULARIO BACKUP BBDD */
    function show_form_backup(){
        print("<div  align='center'>
            <form name='backup' action='$_SERVER[PHP_SELF]' method='post' >
                <input type='submit' value='BACKUP BBDD' class='botonVerde' />
                <input type='hidden' name='backup' value=1 />
            </form></div>");
    }
    /* PROCESO EL BACKUP */
    
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
        
            global $n;
            $n=1;
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
            $backup_file_name = "Mod_Admin/upbbdd/bbdd_export_tot/".$db_name.'_backup_'.time().'.sql';
            $fileHandler=fopen($backup_file_name,'w+');
            fwrite($fileHandler,$backupSQL);
            fclose($fileHandler);
        }

    } // FIN FUCNTION process_backup()


                /* ******** FIN FUNCIONES  CONSTRUCCIÓN / DESTRUCCION  TABLAS ******** */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

  
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
    //global $tablasContactoLog;
    //$tablasContactoLog = $dropClienteLog.tclienteLog.$tableClDatLog.$dropContactoLog.$tcontactoLog;

?>
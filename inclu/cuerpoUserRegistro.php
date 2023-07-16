<?php

    global $nombre;     global $apellido;       global $telf;
    global $dni;        global $lDni;           global $mail;
    global $fecha;      global $check;          global $direccion;
    global $nick;       global $nick2;          global $passw;      global $passw2;
    global $dniInp;     global $dnilInp;
 
    global $botonMisDatos;  global $botonRegistro;

    require $ruta.'botonera.php';

    if((isset($_POST['ocultoUser']))||(isset($_POST['oculto2']))||(isset($_POST['modifDat']))){
        if(isset($_POST['modifDat'])){ $_SESSION['modifDat'] = 1; }else{ }
        //echo $_SESSION['modifDat'];
        $nombre = 'value="'.$_POST["nombre"].'"';
        $apellido = 'value="'.$_POST["apellido"].'"';
        $telf = 'value="'.$_POST["telf"].'"';
        $dni = 'value="'.$_POST["dni"].'"';
        $lDni = 'value="'.$_POST["lDni"].'"';
        $mail = 'value="'.$_POST["mail"].'"';
        $fecha = 'value="'.$_POST["fecha"].'"';
        $nick = 'value="'.$_POST["nick"].'"';
        $nick2 = 'value="'.$_POST["nick2"].'"';
        $passw = 'value="'.$_POST["passw"].'"';
        $passw2 = 'value="'.$_POST["passw2"].'"';
        $check = 'checked';
        $direccion = 'value="'.$_POST["direccion"].'"';
    }else{ 
        unset($_SESSION['modifDat']);
        $nombre = "";   $apellido = "";    $telf = "";     $dni = "";     
        $lDni = "";     $mail = "";        $fecha = "";    
        $nick = "";     $nick2 = "";        $passw = "";   $passw2 = "";
        $check = "";    $direccion = "";
    }


    if(isset($_SESSION['nivel'])){
        $botonMisDatos = '<hr><button class="botonAzul" tabindex="15">
                            <a href="userMisDatos">CANCELAR Y VOLVER</a>
                        </button>';
        $botonRegistro = "MODIFICAR DATOS";
        $dniInp = '<input type="hidden" id="dni" name="dni" value="'.$_SESSION['dni_cliente'].'">'.$_SESSION['dni_cliente'];
        $dnilInp = '<input type="hidden" id="lDni" name="lDni" value="'.$_SESSION['ldni'].'">'.$_SESSION['ldni'];
    } else {  
        $botonMisDatos = ""; $botonRegistro = "REGISTRARME";
        $dniInp = '<input type="text" id="dni" name="dni"  size="20" maxlength="11" class="inpLit" tabindex="3" placeholder="Solo 8 Numeros" '.$dni.'>'; 
        $dnilInp = '<input type="text"id="lDni" name="lDni" size="20" maxlength="2" class="inpLit"  tabindex="4" placeholder="Solo 1 Letra" '.$lDni.'>';
    }
    

    print ('<section>
                <h3>FORMULARIO DE REGISTRO</h3>
                <h5 id="hora">000000</h5>
        <hr>

        <!-- PARA URI -->
        <form id="datos" name="datos" method="post" action="userRegistroDat" onsubmit="return validateForm()">

            <div>
                <label for="nombre">Nombre: </label>
                <input autofocus id="nombre" name="nombre" type="text" size="20" maxlength="22" tabindex="1" placeholder="Solo Letras" '.$nombre.'>
                <div id="nombreD"></div>
            </div>

            <div>
                <label for="apellido">Apellido: </label>
                <input id="apellido" name="apellido" type="text" size="20" maxlength="22" tabindex="2" placeholder="Solo Letras" '.$apellido.'>
                <div id="apellidoD"></div>
            </div>

            <div>
                <label for="dni">DNI: </label>'.$dniInp.'
                <div id="dniD"></div>
            </div>
    
            <div>
                <label for="lDni">Letra DNI: </label>'.$dnilInp.'
                <div id="lDniD"></div>
            </div>

            <div>
                <label for="mail">Email: </label>
                <input type="text" id="mail" name="mail" size="20" maxlength="30" tabindex="5" placeholder="miemail@xxx.xx" '.$mail.'>
                <div id="mailD"></div>
            </div>
    
            <div>
                <label for="telf">Tel&eacute;fono: </label>
                <input type="text" class="inpLit" id="telf" name="telf" size="20" maxlength="12" tabindex="6" placeholder="Solo 9 Numeros" '.$telf.'>
                <div id="telfD"></div>
            </div>

            <div>
                <label for="fecha">Fecha Nacimiento: </label>
                <input type="date" class="inpLit" id="fecha" name="fecha" size="20" tabindex="7" '.$fecha.'>
                <div id="fechaD"></div>
            </div>

            <div>
                <label for="nick">Nick: </label>
                <input type="text" id="nick" name="nick" size="20" maxlength="22" tabindex="8" placeholder="Solo Letras" '.$nick.'>
                <div id="nickD"></div>
            </div>
            <div>
                <label for="nick2">Nick Confirme: </label>
                <input type="text" id="nick2" name="nick2" size="20" maxlength="22" tabindex="9" placeholder="Solo Letras" '.$nick2.'>
                <div id="nick2D"></div>
            </div>

            <div>
                <label for="passw">Password: </label>
                <input type="text" id="passw" name="passw" size="20" maxlength="22" tabindex="10" placeholder="Solo Letras" '.$passw.'>
                <div id="passwD"></div>
            </div>
            <div>
                <label for="passw2">Password Confirme: </label>
                <input type="text" id="passw2" name="passw2" size="20" maxlength="22" tabindex="11" placeholder="Solo Letras" '.$passw2.'>
                <div id="passw2D"></div>
            </div>
 
            <div>
                <label for="check">Condiciones :</label>
                <input type="checkbox" id="check" name="check" tabindex="12" onchange="ejercicio()" '.$check.'> Aceptar
                <div id="checkD"></div>
            </div>

            <div>
                <label for="direccion">Direccion: </label>
                <input type="text" autofocus id="direccion" name="direccion" size="13" maxlength="56" tabindex="13" placeholder="Solo Letras" '.$direccion.'>
                <div id="direccionD"></div>
            </div>

        <div style="text-align: center;">
            <!-- -->
            <input type="submit" id="send" name="send" value="'.$botonRegistro.'" tabindex="14" class="botonLila"> 
            <input type="hidden" id="oculto1" name="oculto1" value="1">
        </div>
        </form>
        <div id="datosF"></div>'.$botonMisDatos.'
    </section>'.$botonera.'');


?>
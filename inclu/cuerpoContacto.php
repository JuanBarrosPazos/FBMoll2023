<?php

    unset($_SESSION['LogTemp']);
    unset($_SESSION['contacto']);

    global $dni_cliente;    global $dni_clienteV;
    global $nombreV;        global $apellidoV;       global $telfV;       global $mailV;
    global $interesV;       global $nComenV;         global $nMesasV;
    global $fechaV;         global $horaV;           global $comentV;     global $checkV;
    global $SGenV;          global $SEspV;           global $SResV;      

    require $ruta.'botonera.php';
    
    if(isset($_POST['ocultoR'])){
        $dni_clienteV = 'value="'.$_POST["dni_cliente"].'"';
        $nombreV = 'value="'.$_POST["nombre"].'"';
        $apellidoV = 'value="'.$_POST["apellido"].'"';
        $mailV = 'value="'.$_POST["mail"].'"';
        $telfV = 'value="'.$_POST["telf"].'"';

        ($_POST['interes']=="Sala General")?$SGenV = 'selected':$SGenV= '';
        ($_POST['interes']=="Sala Reservada")?$SResV = 'selected':$SResV = '';
        ($_POST['interes']=="Salón Especial")?$SEspV = 'selected':$SEspV = '';

        $nComenV = 'value="'.$_POST["nComen"].'"';
        $nMesasV = 'value="'.$_POST["nMesas"].'"';
        $fechaV = 'value="'.$_POST["fecha"].'"';
        $horaV = 'value="'.$_POST["hora"].'"';
        $comentV = $_POST["coment"];
        $checkV = 'checked';

    }elseif(isset($_SESSION['nivel'])){
        $dni_clienteV = 'value="'.$_SESSION["dni_cliente"].'"';
        $nombreV = 'value="'.$_SESSION["nombre"].'"';
        $apellidoV = 'value="'.$_SESSION["apellidos"].'"';
        $mailV = 'value="'.$_SESSION["email"].'"';
        $telfV = 'value="'.$_SESSION["tlf"].'"';

    } else { 
        $dni_clienteV = 'value="'.$dni_cliente.'"';
        $nombreV = "";       $apellidoV = "";         $telfV = "";         $mailV = "";
        $interesV = "";      $nComenV = "";           $nMesasV = "";
        $fechaV = "";        $horaV = "";             $comentV = "";       $checkV = "";
    }

    global $nombreInp;      global $apellidoInp;    global $emailInp;   global $tlfInp;
    if(isset($_SESSION['nivel'])){

        $nombreInp = '<input id="nombre" name="nombre" type="hidden" '.$nombreV.' >'.$_SESSION["nombre"];
        $apellidoInp = '<input id="apellido" name="apellido" type="hidden" '.$apellidoV.' >'.$_SESSION["apellidos"];
        $emailInp = '<input id="mail" name="mail" type="hidden" '.$mailV.' >'.$_SESSION["email"];
        $tlfInp = '<input id="telf" name="telf" type="hidden" '.$telfV.' >'.$_SESSION["tlf"];

        //date('Y-m-d H:i:s');
        global $hora; $hora = date('H');
        global $saludo;
        if($hora<16){
            $saludo = '<p>Hola buenos días.<br>'.$_SESSION["nombre"].' '.$_SESSION["apellidos"].'</p>';
        }else if($hora > 16){ 
            $saludo = '<p>Hola buenas tardes.<br>'.$_SESSION["nombre"].' '.$_SESSION["apellidos"].'</p>';
        }else if($hora > 21){
            $saludo = '<p>Hola buenas noches.<br>'.$_SESSION["nombre"].' '.$_SESSION["apellidos"].'</p>';
        }else{
            $saludo = '<p>Hola '.$_SESSION["nombre"].' '.$_SESSION["apellidos"].'</p>';
        }
        //print ('<section><p>Dni_Cliente: '.$dni_clienteV.'</p>'.$saludo);
        print ('<section>'.$saludo);
         
    }else{
        $nombreInp = '<input autofocus id="nombre" name="nombre" pattern="[a-zA-Z\s]{3,25}" type="text" size="20" maxlength="25" tabindex="1" placeholder="Solo Letras" '.$nombreV.' >';

        $apellidoInp = '<input id="apellido" name="apellido" pattern="[a-zA-Z\s]{3,25}" type="text" size="20" maxlength="25" tabindex="2" placeholder="Solo Letras" '.$apellidoV.' >';

        $emailInp = '<input id="mail" name="mail" type="email" size="20" maxlength="50" tabindex="5" placeholder="miemail@xxx.xx" '.$mailV.' >';

        $tlfInp = '<input class="inpLit" id="telf" name="telf" type="tel" size="20" maxlength="9" tabindex="6" placeholder="Solo 9 Numeros" '.$telfV.' >';

        print('<section onclick="limpioFormAcceso()">
        <!-- COMENTO LOS BOTONES
        <button><a style="cursor:pointer" onclick="botonPopUpFormContact()" tabindex="18">ACCESO USUARIOS</a>
        </button><button>
        <a style="cursor:pointer" onclick="window.open(\'userAccessPopUp.php\',\'_blank\')" tabindex="18">
            ACCESO USUARIOS
        </a></button>-->');
    }

    print ('<h3>FORMULARIO DE CONTACTO</h3>
            <h5 id="hora">000000</h5>
        <hr>
        <!-- PARA URI -->
        <form id="datos" name="datos" method="post" action="contactoDat" onsubmit="return validateForm()">
        <input id="dni_cliente" name="dni_cliente" type="hidden" '.$dni_clienteV.'>

            <div>
                <label for="nombre">Nombre: </label>'.$nombreInp.'
                <div id="nombreD"></div>
            </div>

            <div>
                <label for="apellido">Apellido: </label>'.$apellidoInp.'
                <div id="apellidoD"></div>
            </div>

            <div>
                <label for="mail">Email: </label>'.$emailInp.'
                
                <div id="mailD"></div>
            </div>
    
            <div>
                <label for="telf">Tel&eacute;fono: </label>'.$tlfInp.'
                
                <div id="telfD"></div>
            </div>

            <div>
                <label for="interes">Inter&eacute;s:</label>
                <select id="interes" name="interes" style="width: 150px;" tabindex="7" >
                    <option value="">Tipo de Reserva</option>
                    <option value="Sala General" '.$SGenV.'>Sala General</option>
                    <option value="Sala Reservada" '.$SResV.'>Sala Reservada</option>
                    <option value="Salón Especial" '.$SEspV.'>Salón Especial</option>
                </select>
                <div id="interesD"></div>
            </div>

            <div>
                <label for="nComen">N&ordm; Personas:</label>
                <input class="inpLit" id="nComen" name="nComen" type="number" min="2" max="50" size="20" maxlength="2" tabindex="8" placeholder="Numeros, Max 50" '.$nComenV.' >
                <div id="nComenD"></div>
            </div>

            <div>
                <label for="nMesas">N&ordm; Mesas:</label>
                <input class="inpLit" id="nMesas" name="nMesas" type="number" min="1" max="6"  size="20" maxlength="1" tabindex="9" placeholder="Numeros, Max 6" '.$nMesasV.' >
                <div id="nMesasD"></div>
            </div>

            <div>
                <label for="fecha">Fecha: </label>
                <input class="inpLit" id="fecha" name="fecha" type="date" size="20" tabindex="10" '.$fechaV.' >
                <div id="fechaD"></div>
            </div>

            <div>
                <label for="hora">Time: </label>
                <input class="inpLit" id="hora" name="hora" type="time" min="09:00" max="21:30" tabindex="11" '.$horaV.' >
                <div id="horaD"></div>
                <p class="timeInfo">Horario 09:00 to 21:30</p>
            </div>

            <div>
                <label style="vertical-align: top;" for="coment">Comentarios:</label>
                <textarea id="coment" name="coment" rows="6" cols="23" maxlength="100"  placeholder="Sus comentarios" onkeypress="return limita(event, 100)" onkeyup="actualizaInfo(100)" tabindex="12" >'.$comentV.'</textarea>
                <div id="comentD"></div>
            </div>
            <div id="info">Maximo 100 caracteres</div>         
    
            <div>
                <label for="check">Condiciones :</label>
                <input id="check" name="check" type="checkbox" tabindex="13" onchange="ejercicio()" '.$checkV.' > Aceptar
                <div id="checkD"></div>
            </div>

        <div style="text-align: right;">
            <input id="send" name="send" type="submit" value="ENVIAR RESERVA" tabindex="14" class="botonVerde"> 
            <input id="oculto1" name="oculto1" type="hidden" value="1">
        </div>
        </form>
        <div id="datosF"></div>

        <hr>
        <h5>NOS PONDREMOS EN CONTACTO EN BREVE.<br>MUCHAS GRACIAS</h5>
       
    </section>'.$botonera.'');

?>
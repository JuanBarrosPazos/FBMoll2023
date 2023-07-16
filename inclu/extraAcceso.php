<?php

    global $plusAcceso; global $UserAccess; global $UserError; global $AccesoPage;
    
    if(isset($_SESSION['nivel'])){ 
        $plusAcceso = '<div class="openClient">
            <div id="datosTUs">
                <img src="'.$ruta.'img/imgCliente/'.$_SESSION["img"].'">
                <p>'.$_SESSION["nombre"].'</p>
            </div>
        <form id="salirF" name="salirF" method="post" action="'.$_SERVER['PHP_SELF'].'">
                <div id="nombreUsrD"></div>
                <div id="passD"></div>
            <input id="salir" name="salir" type="submit" value="CERRAR SESION" class="botonLila">
            <input id="closeSession" name="closeSession" type="hidden" value="1" >
        </form>
        <!-- PARA $BASENAME
        <form id="userDatF" name="userDatF" method="post" action="userMisDatos.php">
        -->
        <form id="userDatF" name="userDatF" method="post" action="usermisdatos">
            <input id="misDatos" name="MisDatos" type="submit" value="MIS DATOS" class="botonLila">
            <input id="userDat" name="userDat" type="hidden" value="1" >
        </form>
        </div>';
        
    }else if($AccesoPage == 1){
        
        $plusAcceso = '';

    }else{ $plusAcceso = '<!-- ADAPTO EL CUADRO DE ACCESO FIXED -->
                    <div id="login2">
                        <a href="useraccesspopup">
                            <img src="'.$ruta.'img/Icos/ico13.png">
                        </a>
                    </div>
                    <div id="login" onclick="limpioFormPrin()">
    <form id="acceso" name="acceso" method="post" action="'.$_SERVER['PHP_SELF'].'" style="margin-bottom:0.2em;">
                            <div>
                            <div id="nombreUsrD">'.$UserAccess.'</div>
        <input id="nombreUsr" name="nombreUsr" type="password" size="16" maxlength="22" tabindex="15" placeholder="NOMBRE USUARIO" onfocus="fondoColorSi(this)" onblur="fondoColorNo(this)" onkeydown="presionoTecla(this)">
                        </div>
                            <div>
        <input id="pass" name="pass" type="password" size="16" maxlength="22" tabindex="16" placeholder="PASSWORD" onfocus="fondoColorSi(this)" onblur="fondoColorNo(this)" onkeydown="presionoTecla(this)">
                                <div id="passD">'.$UserError.'</div>

                            </div>  
            <input id="send" name="send" type="submit" value="ACCEDER" tabindex="17" class="botonVerde"> 
            <input id="iniSession" name="iniSession" type="hidden" value="1">

        </form>
            <div id="datosTUs"></div>
            <div id="datosFUs"></div>
                <!-- PARA URI -->
                    <a href="'.$ruta.'userRegistro" style="font-size: 68.0% !important;">NO ESTOY REGISTRADO</a>

                    <!--
                    <br><a href="'.$ruta.'Mod_Cliente/index.php?vertodos=1">VER TODOS LOS USUARIOS</a>
                    -->
                </div>';
    }

?>
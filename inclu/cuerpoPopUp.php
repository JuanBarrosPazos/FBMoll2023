<?php

    global $UserAccess; global $UserError; global $uri;

    if($uri == "claves"){

        echo "<section>";

        require 'clavesFunciones.php';
        require 'clavesLogica.php';

        echo "</section>";

    }else{
        pop_Acceso();
    }

    function pop_Acceso(){

        global $UserAccess; global $UserError; global $ruta;
    
            print ('<section style="padding-bottom: 0.6em;">
                        <h3>ACCESO USUARIOS</h3>
                        <h5 id="hora">000000</h5>
                        <hr>

                <form id="acceso" name="acceso" method="post" action="useraccesspopup" >
                    <div>
                        <div id="nombreUsrD">'.$UserAccess.'</div>
                        <label for="nombreUsrD">Usuario: </label>
                            <input autofocus id="nombreUsr" name="nombreUsr" type="password" size="20" maxlength="20" tabindex="1" placeholder="NOMBRE USUARIO" onfocus="fondoColorSi(this)" onblur="fondoColorNo(this)" onkeydown="presionoTecla(this)">
                    </div>

                    <div>
                        <label for="pass">Password: </label>
                            <input id="pass" name="pass" type="password" size="20" maxlength="20" tabindex="2" placeholder="PASSWORD" onfocus="fondoColorSi(this)" onblur="fondoColorNo(this)" onkeydown="presionoTecla(this)">
                        <div id="passD">'.$UserError.'</div>
                    </div>
                        <input id="send" name="send" type="submit" value="ABRIR SESION" tabindex="3" class="botonVerde"> 
                        <input id="iniSession" name="iniSession" type="hidden" value="1">
                </form>
                        <hr>
                        <!-- PARA URI -->
                        <a href="'.$ruta.'userRegistro" class="botonRojo">NO ESTOY REGISTRADO</a>
            </section>');

    } // FIN FUNCTION pop_AcCeso()

?>
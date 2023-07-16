
<?php
        // <!-- VA CON EL PHP SELECT -->
        global $ruta;       $ruta = "";
        require("conexion.php");
        global $conexion;   $conexion = retornarConexion();
        global $tablau;     $tablau = "`".$_SESSION['clave']."cliente`";
?>

<!-- FORMULARIO PARA AGREGAR -->
    <diV class="modal fade" id="formularioContacto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close btn-close" name="button" data-bs-dismiss="modal" >
                        
        </button>
    </div>
  
    
    <div class="modal-body">
        <input type="hidden" id="id">

    <!-- VA CON EL PHP SELECT -->
    <div class='form-row' id='dni_clienteDiv'>
            <div class='form-group col-md-12'>
    <?php
        
        print("
            <label for='dni_cliente'>Dni Cliente: </label>

        <select id='dni_cliente' name='dni_cliente'>
                    <option value=''>SELECCIONE UN USUARIO</option><!-- --> ");
            
            // CONSTRUYO EL SELECT DE USUARIOS
            $sqlu =  "SELECT * FROM $tablau ORDER BY `Nombre` ASC ";
            $qu = mysqli_query($conexion, $sqlu);
            if(!$qu){
                    print("Modifique la entrada L.148 ".mysqli_error($conexion)."<br/>");
            } else {
                while($rowu = mysqli_fetch_assoc($qu)){
                        print ("<option value='".$rowu['dni']."' ");
                        if($rowu['dni'] == @$_POST['id_cliente']){print ("selected = 'selected'");}
                        print ("> ".$rowu['Nombre']." ".$rowu['Apellidos']." </option>");
                    }
                }  
        ?>
        <!--
            <input autofocus id='dni_cliente' name='dni_cliente' type='number' size='20' maxlength='8' tabindex='1' value='99999999'  required >
        -->
    </div></div></select>
    <!-- FIN VA CON EL PHP SELECT -->

        <div class="form-row" id="nombreDiv">
            <div class="form-group col-md-12">
                <label for="nombre">Nombre: </label>
                <input id="nombre" name="nombre" pattern="[a-zA-Z\s]{3,20}" type="text" size="20" maxlength="20" tabindex="2"  required>
            </div>
        </div>
        <div class="form-row" id="apellidoDiv"> 
            <div class="form-group col-md-12">
                <label for="apellido">Apellido: </label>
                <input id="apellido" name="apellido" pattern="[a-zA-Z\s]{3,20}" type="text" size="20" maxlength="20" tabindex="2" required>
            </div>
        </div>
        <div class="form-row" id="mailDiv">
            <div class="form-group col-md-12">
                <label for="mail">Email: </label>
                <input id="mail" name="mail" type="email" size="20" maxlength="30" tabindex="3" required>
            </div>
        </div>
        <div class="form-row" id="telfDiv"> 
            <div class="form-group col-md-12">
                <label for="telf">Tel&eacute;fono: </label>
                <input class="inpLit" id="telf" name="telf" type="tel" size="20" maxlength="9" tabindex="4" required>
            </div>
        </div>
        <div class="form-row" id="interesDiv">
            <div class="form-group col-md-12">
                <label for="interes">Inter&eacute;s:</label>
                <select id="interes" name="interes" style="width: 150px;" tabindex="5" required>
                    <option value="">Tipo de Reserva</option>
                    <option value="Sala General">Sala General</option>
                    <option value="Sala Reservada">Sala Reservada</option>
                    <option value="Salon Actos">Salón Actos</option>
                </select>
            </div>
        </div>
        <div class="form-row" id="nComenDiv">
            <div class="form-group col-md-12">
                <label for="nComen">N&ordm; Personas:</label>
                <input class="inpLit" id="nComen" name="nComen" type="number" min="2" max="50" step="1" tabindex="6" required>
            </div>
        </div>
        <div class="form-row" id="nMesasDiv">
            <div class="form-group col-md-12">
                <label for="nMesas">N&ordm; Mesas:</label>
                <input class="inpLit" id="nMesas" name="nMesas" type="number" min="1" max="6" step="1" tabindex="7" required>
            </div>
        </div>
        <div class="form-row" id="fechaDiv">
            <div class="form-group col-md-12">
                <label for="fecha">Fecha: </label>
                <input class="inpLit" id="fecha" name="fecha" type="date" size="20" tabindex="8" required>
            </div>
        </div>
        <div class="form-row" id="horaDiv">
            <div class="form-group col-md-12">
                <label for="hora">Time: </label>
                <input class="inpLit" id="hora" name="hora" type="time" min="09:00" max="21:30" tabindex="9" required>
                <p class="timeInfo">Horario 09:00 to 21:30</p>
            </div>
        </div>
        <div class="form-row" id="comentDiv">
            <div class="form-group col-md-12">
                <label style="vertical-align: top;" for="coment">Comentarios:</label>
                <textarea id="coment" name="coment" rows="6" cols="23" maxlength="100"  placeholder="Sus comentarios" onkeypress='return limita(event, 100)' onkeyup='actualizaInfo(100)' tabindex="10" required></textarea>
            </div>
            <div id='info'>Maximo 100 caracteres</div>          
        </div>

    </div> <!-- FIN MODAL BODY-->
                    <div class="modal-footer">
                        <button type="button" id="confirmarAgregar" class="btn btn-success">Agregar</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                    </div>
            </div> <!-- FIN MODAL CONTENT-->
        </div>
    </diV> <!-- FIN MODAL FADE -->
    <!-- FIN FORMULARIO AGREGAR O MODIFIVAR --> 


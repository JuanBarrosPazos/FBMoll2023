    <!-- FORMULARIO PARA MODIFICAR -->
    <diV class="modal fade" id="formularioModificar" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close btn-close" name="button" data-bs-dismiss="modal" >
            </button>
        </div>
       <div class="modal-body">
        <div class="form-row" id="leidoDiv">
            <div class="form-group col-md-12">
                <label for="leido">LEIDO</label>
                <select id="leido" name="leido" style="width: 150px;" required>
                    <option value="">-- --</option>
                    <option value="y">SÍ LEIDO</option>
                    <option value="n">NO LEIDO</option>
                </select>
            </div>
        </div>
        <div class="form-row" id="confirmadoDiv">
            <div class="form-group col-md-12">
                <label for="confirmado">CONFIRMADO</label>
                <select id="confirmado" name="confirmado" style="width: 150px;" required>
                    <option value="">-- --</option>
                    <option value="y">SÍ CONFIRM.</option>
                    <option value="n">NO CONFIRM.</option>
                </select>
            </div>
        </div>
        <div class="form-row" id="leemeDiv">
            <div class="form-group col-md-12">
                <label style="vertical-align: top;" for="leeme">COMETARIOS EMPRESA</label>
                <textarea id="leeme" name="leeme" rows="6" cols="23" maxlength="450"  placeholder="Comentarios Empresa..." onkeypress='return limitaLeeme(event, 450)' onkeyup='actualizaInfoLeeme(450)' required></textarea>
            </div>
            <div id='infoleeme'>Maximo 450 caracteres</div>          
        </div>
        <!--
        <input id="leido" name="leido" type="hidden">
        <input id="confirmado" name="confirmado" type="hidden">
        <input id="leeme" name="leeme" type="hidden">
        -->

        </div> <!-- FIN MODAL BODY-->
                        <div class="modal-footer">
                            <button type="button" id="confirmarModificar" class="btn btn-success">Modificar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                </div> <!-- FIN MODAL CONTENT-->
            </div>
        </diV> <!-- FIN MODAL FADE -->
    <!-- FIN FORMULARIO MODIFIVAR -->

        // CONSTRUCTOR DE LA TABLA DE RESULTADOS
        let tabla1 = $("#tablacontacto").DataTable({
            "ajax":{
                url: rut+"datos.php?accion=listar",
                dataSrc: ""
            },
            "columns": [
                {"data": "id"},
                {"data": "dni_cliente"},
                {"data": "nombre"},                
                {"data": "apellido"},                
                {"data": "mail"},                
                {"data": "telf"},                
                {"data": "interes"},                
                {"data": "nComen"},                
                {"data": "nMesas"},                
                {"data": "fecha"},                
                {"data": "hora"},                
                {"data": "coment"},                
                {"data": "leido"},                
                {"data": "confirmado"},                
                {"data": "leeme"},              
                {"data": null, "orderable": false},                
                {"data": null, "orderable": false}               
                ],
                "columnDefs": [{
                    targets: 15,
                    "defaultContent": "<button class='btn btn-sm btn-primary botonmodificar' id='btnAgregar'>MODIFICAR</button>",
                    data: null
                },
                {
                    targets: 16,
                        "defaultContent": "<button class='btn btn-sm btn-primary botonborrar' id='btnAgregar'>BORRAR</button>",
                        data: null
                }],
                "language":{
                    "url": "DataTables/spanish.json",
                    },
                        });
            
            // EVENTOS DE BOTONES 

                $('#btnAgregar').click(function(){
                    $('#confirmarAgregar').show();
                    $('#confirmarModificar').hide();

                    $('#dni_clienteDiv').show();
                    $('#nombreDiv').show();
                    $('#apellidoDiv').show();
                    $('#mailDiv').show();
                    $('#telfDiv').show();
                    $('#interesDiv').show();
                    $('#nComenDiv').show();
                    $('#nMesasDiv').show();
                    $('#fechaDiv').show();
                    $('#horaDiv').show();
                    $('#comentDiv').show();
                    $('#leidoDiv').hide();
                    $('#confirmadoDiv').hide();
                    $('#leemeDiv').hide();

                    limpiarFormulario();
                    $('#formularioContacto').modal('show');
                });

                $('#confirmarAgregar').click(function(){
                    //$('#formularioContacto').modal('hide');
                    let registro = recuperarDatosFormulario();
                    if(registro.nombre==''){
                        alert("NOMBRE ES OBLIGATORIO");
                        return;
                    }
                    else if(registro.apellido==''){
                        alert("APELLIDO ES OBLIGATORIO");
                        return;
                    }else if(registro.mail==''){
                        alert("MAIL ES OBLIGATORIO");
                        return;
                    }else{
                        $('#formularioContacto').modal('hide');
                        agregarRegistro(registro);
                    }
                    //console.log(registro); 
                    //agregarRegistro(registro);
                });
 
                $('#confirmarModificar').click(function(){
                    //$('#formularioContacto').modal('hide');
                    let registro = recuperarDatosFormulario();
                    //console.log(registro);
                    if(registro.leido==''){
                        alert("LEIDO ES OBLIGATORIO");
                        return;
                    } else if(registro.confirmado==''){
                        alert("CONFIRMADO ES OBLIGATORIO");
                        return;
                    } else if(registro.leeme==''){
                        alert("LEEME ES OBLIGATORIO");
                        return;
                    }else{
                        $('#formularioModificar').modal('hide');
                        modificarRegistro(registro);
                    }
                    //modificarRegistro(registro);
                });

                $('#tablacontacto tbody').on('click', "button.botonmodificar", function(){
                    $('#dni_clienteDiv').hide();
                    $('#nombreDiv').hide();
                    $('#apellidoDiv').hide();
                    $('#mailDiv').hide();
                    $('#telfDiv').hide();
                    $('#interesDiv').hide();
                    $('#nComenDiv').hide();
                    $('#nMesasDiv').hide();
                    $('#fechaDiv').hide();
                    $('#horaDiv').hide();
                    $('#comentDiv').hide();
                    $('#leidoDiv').show();
                    $('#confirmadoDiv').show();
                    $('#leemeDiv').show();
                    //alert("HOLA DISTE CLICK EN MODIFICAR"); 
                    $('#confirmarModificar').show();
                    $('#confirmarAgregar').hide();  
                    // IDENTIFICAMOS EL Contacto EN EL QUE ESTAMOS EN LA TABLA                  
                    let registro = tabla1.row($(this).parents('tr')).data();
                    recuperarRegistro(registro.id);
                });

                $('#tablacontacto tbody').on('click', "button.botonborrar", function(){
                    if(confirm("CONFIRME BORRAR EL REGISTRO!!!")){
                        // IDENTIFICAMOS EL Contacto EN EL QUE ESTAMOS EN LA TABLA 
                        let registro = tabla1.row($(this).parents('tr')).data();
        borrarRegistro(registro.id, registro.dni_cliente, registro.nombre, registro.apellido, registro.mail, registro.telf, registro.interes, registro.nComen, registro.nMesas, registro.fecha, registro.hora, registro.coment, registro.leido, registro.confirmado, registro.leeme);
                    }
                });

            // FIN EVENTOS DE BOTONES

            // FUNCIONES QUE INTERACTUAN CON FORMULARIO ENTRADA DATOS

                function limpiarFormulario(){
                    $('#id').val('');
                    $('#dni_cliente').val('');
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#mail').val('');
                    $('#telf').val('');
                    $('#interes').val('');
                    $('#nComen').val('');
                    $('#nMesas').val('');
                    $('#fecha').val('');
                    $('#hora').val('');
                    $('#coment').val('');
                    $('#leido').val('');
                    $('#confirmado').val('');
                    $('#leeme').val('');
                }

                function recuperarDatosFormulario(){
                    let registro = {
                        id: $('#id').val(),
                        dni_cliente: $('#dni_cliente').val(),
                        nombre: $('#nombre').val(),
                        apellido: $('#apellido').val(),
                        mail: $('#mail').val(),
                        telf: $('#telf').val(),
                        interes: $('#interes').val(),
                        nComen: $('#nComen').val(),
                        nMesas: $('#nMesas').val(),
                        fecha: $('#fecha').val(),
                        hora: $('#hora').val(),
                        coment: $('#coment').val(),
                        leido: $('#leido').val(),
                        confirmado: $('#confirmado').val(),
                        leeme: $('#leeme').val()
                    };
                    return registro;
                }

            // FIN FUNCIONES QUE INTERACTUAN CON FORMULARIO ENTRADA DATOS

            // FUNCIONES QUE SE COMUNICAN CON EL SERVER A TRAVES DE AJAX

                function agregarRegistro(registro){
                    $.ajax({
                        type: 'POST',
                        url: rut+"datos.php?accion=agregar",
                        data: registro,
                        success: function(msg){
                            tabla1.ajax.reload();
                        },
                        error: function(){
                            alert("HUBO UN PROBLEMA AL AGREGAR EL REGISTRO");
                        }
                    });
                }

            function borrarRegistro(id, dni_cliente, nombre, apellido, mail, telf, interes, nComen, nMesas, fecha, hora, coment, leido, confirmado, leeme){
                    $.ajax({
                        type: 'GET',
           url: rut+"datos.php?accion=borrar&id="+id+"&dni_cliente="+dni_cliente+"&nombre="+nombre+"&apellido="+apellido+"&mail="+mail+"&telf="+telf+"&interes="+interes+"&nComen="+nComen+"&nMesas="+nMesas+"&fecha="+fecha+"&hora="+hora+"&coment="+coment+"&leido="+leido+"&confirmado="+confirmado+"&leeme="+leeme,
                        data: '',
                        success: function(msg){
                            tabla1.ajax.reload();
                        },
                        error: function(){
                            alert("HUBO UN PROBLEMA AL BORRAR EL REGISTRO!!");
                        }
                    });
                }

                function recuperarRegistro(id){
                    $.ajax({
                        type: 'GET',
                        url: rut+"datos.php?accion=consultar&id="+id,
                        data: '',
                        success: function (datos) {
                            $('#id').val(datos[0].id);
                            $('#dni_cliente').val(datos[0].dni_cliente);
                            $('#nombre').val(datos[0].nombre);
                            $('#apellido').val(datos[0].apellido);
                            $('#mail').val(datos[0].mail);
                            $('#telf').val(datos[0].telf);
                            $('#interes').val(datos[0].interes);
                            $('#nComen').val(datos[0].nComen);
                            $('#nMesas').val(datos[0].nMesas);
                            $('#fecha').val(datos[0].fecha);
                            $('#hora').val(datos[0].hora);
                            $('#coment').val(datos[0].coment);
                            $('#leido').val(datos[0].leido);
                            $('#confirmado').val(datos[0].confirmado);
                            $('#leeme').val(datos[0].leeme);

                            $("#formularioModificar").modal('show');
                        },
                        error: function () {
                            alert("ERROR AL RECUPERAR LOS DATOS");
                        }
                    });
                }

                function modificarRegistro(registro){
                    $.ajax({
                        type: 'POST',
                        url: rut+"datos.php?accion=modificar&id="+registro.id,
                        data: registro,
                        success: function (msg) {
                            tabla1.ajax.reload();
                        },
                        error: function() {
                          alert("EL REGISTRO NO SE HA MODIFICADO CORRECTAMENTE");
                        }
                    });
                }

            // FIN FUNCIONES COMUNICAN SERVER AJAX

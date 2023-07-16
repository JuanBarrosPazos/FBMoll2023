        // CONSTRUCTOR DE LA TABLA DE RESULTADOS
        let tabla1 = $("#tablacontacto").DataTable({
            "ajax":{
                url: rut+"feedbackDatos.php?accion=listarFeedback",
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
                {"data": "borrado"},              
                {"data": null, "orderable": false},                
                {"data": null, "orderable": false}               
                ],
                "columnDefs": [{
                    targets: 16,
                    "defaultContent": "<button class='btn btn-sm btn-primary btnRecuperarFeedback' id='btnAgregar'>RECUPERAR</button>",
                    data: null
                },
                {
                    targets: 17,
                        "defaultContent": "<button class='btn btn-sm btn-primary botonborrarFeedback' id='btnAgregar'>BORRAR</button>",
                        data: null
                }],
                "language":{
                    "url": "DataTables/spanish.json",
                    },
                        });
            
            // EVENTOS DE BOTONES

                $('#tablacontacto tbody').on('click', "button.botonborrarFeedback", function(){
                    if(confirm("CONFIRME BORRAR EL REGISTRO!!!")){
                        // IDENTIFICAMOS EL Contacto EN EL QUE ESTAMOS EN LA TABLA 
                        let registro = tabla1.row($(this).parents('tr')).data();
        borrarRegistroFeedback(registro.id, registro.dni_cliente, registro.nombre, registro.apellido, registro.mail, registro.telf, registro.interes, registro.nComen, registro.nMesas, registro.fecha, registro.hora, registro.coment, registro.leido, registro.confirmado, registro.leeme);
                    }
                });

                $('#tablacontacto tbody').on('click', "button.btnRecuperarFeedback", function(){
                    if(confirm("CONFIRME RECUPERAR EL REGISTRO!!!")){
                        // IDENTIFICAMOS EL Contacto EN EL QUE ESTAMOS EN LA TABLA 
                        let registro = tabla1.row($(this).parents('tr')).data();
        recuperarFeedback(registro.id, registro.dni_cliente, registro.nombre, registro.apellido, registro.mail, registro.telf, registro.interes, registro.nComen, registro.nMesas, registro.fecha, registro.hora, registro.coment, registro.leido, registro.confirmado, registro.leeme);
                    }
                });
            // FIN EVENTOS DE BOTONES

            // FUNCIONES QUE INTERACTUAN CON FORMULARIO ENTRADA DATOS

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


            function borrarRegistroFeedback(id, dni_cliente, nombre, apellido, mail, telf, interes, nComen, nMesas, fecha, hora, coment, leido, confirmado, leeme){
                    $.ajax({
                        type: 'GET',
           url: rut+"feedbackDatos.php?accion=borrarFeedback&id="+id+"&dni_cliente="+dni_cliente+"&nombre="+nombre+"&apellido="+apellido+"&mail="+mail+"&telf="+telf+"&interes="+interes+"&nComen="+nComen+"&nMesas="+nMesas+"&fecha="+fecha+"&hora="+hora+"&coment="+coment+"&leido="+leido+"&confirmado="+confirmado+"&leeme="+leeme,
                        data: '',
                        success: function(msg){
                            tabla1.ajax.reload();
                        },
                        error: function(){
                            alert("HUBO UN PROBLEMA AL BORRAR EL REGISTRO!!");
                        }
                    });
                }

            function recuperarFeedback(id, dni_cliente, nombre, apellido, mail, telf, interes, nComen, nMesas, fecha, hora, coment, leido, confirmado, leeme){
                    $.ajax({
                        type: 'GET',
           url: rut+"feedbackDatos.php?accion=recuperarFeedback&id="+id+"&dni_cliente="+dni_cliente+"&nombre="+nombre+"&apellido="+apellido+"&mail="+mail+"&telf="+telf+"&interes="+interes+"&nComen="+nComen+"&nMesas="+nMesas+"&fecha="+fecha+"&hora="+hora+"&coment="+coment+"&leido="+leido+"&confirmado="+confirmado+"&leeme="+leeme,
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
                        url: rut+"feedbackDatos.php?accion=consultar&id="+id,
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

            // FIN FUNCIONES COMUNICAN SERVER AJAX

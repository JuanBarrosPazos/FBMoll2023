
// P.21V02 => VALIDO CAMPO A CAMPO SIN ALERT Y CON NOTIFICACIÓN CONJUNTA

function validateForm() {

    // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
    // INICIALIZO LAS VARIABLES DE ERRORES
    
    document.getElementById("nombreUsrD").innerHTML = ("");
    document.getElementById("passD").innerHTML = ("");
  
    // DECLARO LAS VARIABLES RECOJO LOS VALORES DEL FORMULARIO
    //let nombreV = document.getElementById("nombre").value; 
    let nombreV = document.forms["datos"]["nombre"].value;
    //let apellidoV = document.getElementById("apellido").value;
    let apellidoV = document.forms["datos"]["apellido"].value;
    let mailV = document.forms["datos"]["mail"].value;
    let telfV = document.forms["datos"]["telf"].value;
    let interesV = document.forms["datos"]["interes"].value;
    let nComenV = document.forms["datos"]["nComen"].value;
    let nMesasV = document.forms["datos"]["nMesas"].value;
    let fechaV = document.forms["datos"]["fecha"].value;
    let horaV = document.forms["datos"]["hora"].value;
    let comentV = document.forms["datos"]["coment"].value;
    //let checkV = document.getElementById("check").checked;
    let checkV = document.forms["datos"]["check"].checked;
 

    // INICIALIZO LAS VARIABLES DE ERRORES
    let nombreEr = document.getElementById("nombreD").innerHTML = ("");
    let apellidoEr = document.getElementById("apellidoD").innerHTML = ("");
    let mailEr = document.getElementById("mailD").innerHTML = ("");
    let telfEr = document.getElementById("telfD").innerHTML = ("");
    let interesEr = document.getElementById("interesD").innerHTML = ("");
    let nComenEr = document.getElementById("nComenD").innerHTML = ("");
    let nMesasEr = document.getElementById("nMesasD").innerHTML = ("");
    let fechaEr = document.getElementById("fechaD").innerHTML = ("");
    let horaEr = document.getElementById("horaD").innerHTML = ("");
    let comentEr = document.getElementById("comentD").innerHTML = ("");
    let checkEr = document.getElementById("checkD").innerHTML = ("");

    // ELIMINO ESPACIOS EN BLANCO PARA COMPROBAR LA LONGITUD
    nombreV = nombreV.trim();
    let nombreL = nombreV.replace(/\s+/g, '');

    apellidoV = apellidoV.trim();
    let apellidoL = apellidoV.replace(/\s+/g, '');

    mailV = mailV.trim();
    let mailL = mailV.replace(/\s+/g, '');
    mailL = mailL.replace(/,/g, '.');

    telfV = telfV.trim();
    let telfL = telfV.replace(/\s+/g, '');

    interesV = interesV.trim();
    let interesL = interesV.replace(/\s+/g, '');
    
    nComenV = nComenV.trim();
    let nComenL = nComenV.replace(/\s+/g, '');

    nMesasV = nMesasV.trim();
    let nMesasL = nMesasV.replace(/\s+/g, '');

    fechaV = fechaV.trim();
    let fechaL = fechaV.replace(/\s+/g, '');

    horaV = horaV.trim();
    let horaL = horaV.replace(/\s+/g, '');
    let horaMax = horaV.replace(':', '');

    comentV = comentV.trim();
    let comentL = comentV.replace(/\s+/g, '');

    // EXPRESINES REGULARES
    let letrasExp = /^[a-z A-Z]+$/;
    let numerosExp = /^[0-9]+$/;
    let passCarac = /^[a-z A-Z 0-9 !?\*]+$/;
    let comentCarac = /^[a-z A-Z 0-9 áéíóúÁÉÍÓÚ ;,.\s]+$/;
    let noValidos = /^[^@´`\'#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/;
    //let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/; // Primer Valor
    /* 
    / Inicio de la expresion ^ Inicio del la cadena [^ No se permiten estos caracteres, ni mayusculas, ni espacios] ([se permiten minusculas y numeros una o varias veces]{minimo 3}mas @ (([minusculas y numeros una o mas veces]{minimo 3}mas . [mas minusculas minimo 2 maximo 4 una o varias veces]))) $ fin del strin / fin de la expresion
    */
    let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*A-Z\s]([a-z0-9_]{2,})+@(([-a-z0-9]{3,})+\.)+([a-z]{2,3})$/;
    let fechaExp = /^\d{4}-\d{1,2}-\d{1,2}$/;
    let horaExp = /^\d{1,2}:\d{1,2}$/;

  // VALIDACION DE LA FECHA RESERVA
  var fecha = new Date();   var diames = fecha.getDate();   var mes = fecha.getMonth() + 1;

    // NUMERO DEL DIA DE LA SEMANA DE LA RESERVA
    var daytext = new Date(fechaV).getUTCDay();

    /*
    if(daytext == 0){ daytext = "DOMINGO";}
    else if(daytext == 1){ daytext = "LUNES";}
    else if(daytext == 2){ daytext = "MARTES";}
    else if(daytext == 3){ daytext = "MIERCOLES";}
    else if(daytext == 4){ daytext = "JUEVES";}
    else if(daytext == 5){ daytext = "VIERNES";}
    else if(daytext == 6){ daytext = "SABADO";}

  var ano = fecha.getYear();
  if (fecha.getYear() < 2000){
        ano = 1900 + fecha.getYear();
  } else {
        ano = fecha.getYear();
  }
  */
  let ano = fecha.getFullYear();

  // RESERVAS MAX 1 MES
  var mesPlus = parseInt(mes)+1;
  if(mes < 10){ mes = "0"+mes;}else{ }
  if(mesPlus < 10){ mesPlus = "0"+mesPlus;}else{ }
  if(diames < 10){ diames = "0"+diames; }else{ }
  var hoy = ano+"-"+mes+"-"+diames;
  var maxMes = ano+"-"+mesPlus+"-"+diames;
  var errorDate;
  // FIN VALIDACION FECHA RESERVA

    // DECLARO KEYS
    let keyRt = 0;


    // VALIDO EL NOMBRE [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (!isNaN(nombreV)||nombreL.length==0||nombreL.length<3||nombreV.length>=26||nombreL==null) {
      nombreEr = document.getElementById("nombreD").innerHTML = ("<p class='errorD'>NOMBRE OBLIGATORIO, SOLO LETRAS, MINIMO 3, MAXIMO 20</p>");
      document.getElementById("nombre").value = nombreV;
      keyRt = 1;
    }
    // VALIDO NOMBRE QUE SOLO SEAN LETRAS
    else if(letrasExp.test(nombreV) == false){
      nombreEr = document.getElementById("nombreD").innerHTML = ("<p class='errorD'>NOMBRE SOLO SE PERMITEN LETRAS</p>");
      document.getElementById("nombre").value = nombreV;
      keyRt = 1;
    }


    // VALIDO EL APELLIDO [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (!isNaN(apellidoV)||apellidoL.length==0||apellidoL.length<3||apellidoV.length>=26||apellidoL==null) {
        apellidoEr = document.getElementById("apellidoD").innerHTML = ("<p class='errorD'>APELLIDO OBLIGATORIO, SOLO LETRAS, , MINIMO 3, MAXIMO 20</p>");
        document.getElementById("apellido").value = apellidoV;
        keyRt = 1;
      }
    // VALIDO APELLIDO QUE SOLO SEAN LETRAS
    else if(letrasExp.test(apellidoV) == false){
      apellidoEr = document.getElementById("apellidoD").innerHTML = ("<p class='errorD'>APELLIDO SOLO SE PERMITEN LETRAS</p>");
      document.getElementById("apellido").value = apellidoV;
      keyRt = 1;
    }

    // VALIDO EL EMAIL [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (!isNaN(mailV)||mailL.length==0||mailL.length<7||mailV.length>=51||mailL==null) {
      mailEr = document.getElementById("mailD").innerHTML = ("<p class='errorD'>MAIL OBLIGATORIO, SOLO LETRAS, MINIMO 3, MAXIMO 20</p>");
      document.getElementById("mail").value = mailV;
      keyRt = 1;
    }
    // VALIDO DIRECCION EMAIL
    else if(mailExp.test(mailV) == false){
      mailEr = document.getElementById("mailD").innerHTML = ("<p class='errorD'>MAIL DIRECCION ERRONEA</p>");
      document.getElementById("mail").value = mailV;
      keyRt = 1;
    }


    // VALIDO EL TELEFONO [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (isNaN(telfV)||telfL.length==0||telfL.length<9||telfV.length>=10||telfL==null) {
      telfEr = document.getElementById("telfD").innerHTML = ("<p class='errorD'>TELEFONO OBLIGATORIO, SOLO 9 NUMEROS</p>");
      document.getElementById("telf").value = telfV;
      keyRt = 1;
    }
    // VALIDO NUMERO DE TELEFONO
    else if(numerosExp.test(telfV) == false){
      telfEr = document.getElementById("telfD").innerHTML = ("<p class='errorD'>TELEFONO NUMERO ERRONEO</p>");
      document.getElementById("telf").value = telfV;
      keyRt = 1;
    }


    // VALIDO EL CAMPO INTERES [NULL, LONGITUD]
    if (interesL.length==0||interesL==null) {
      interesEr = document.getElementById("interesD").innerHTML = ("<p class='errorD'>INTERES OBLIGATORIO</p>");
      document.getElementById("interes").value = interesV;
      keyRt = 1;
    }

    // VALIDO NUMERO COMENSALES [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (isNaN(nComenV)||nComenL.length==0||nComenL.length<1||nComenV.length>=3||nComenL==null) {
      nComenEr = document.getElementById("nComenD").innerHTML = ("<p class='errorD'>NUMERO COMENSALES, SOLO 2 NUMEROS</p>");
      document.getElementById("nComen").value = nComenV;
      keyRt = 1;
    }
    // VALIDO NUMERO COMENSALES
    else if(numerosExp.test(nComenV) == false){
      nComenEr = document.getElementById("nComenD").innerHTML = ("<p class='errorD'>COMENSALES NUMERO ERRONEO</p>");
      document.getElementById("nComen").value = nComenV;
      keyRt = 1;
    }

    // VALIDO NUMERO MESAS [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (isNaN(nMesasV)||nMesasL.length==0||nMesasL.length<1||nMesasV.length>=2||nMesasL==null) {
      nMesasEr = document.getElementById("nMesasD").innerHTML = ("<p class='errorD'>NUMERO DE MESAS, SOLO NUMEROS</p>");
      document.getElementById("nMesas").value = nMesasV;
      keyRt = 1;
    }
    // VALIDO NUMERO MESAS
    else if(numerosExp.test(nMesasV) == false){
      nMesasEr = document.getElementById("nMesasD").innerHTML = ("<p class='errorD'>NUMERO DE MESAS ERRONEO</p>");
      document.getElementById("nMesas").value = nMesasV;
      keyRt = 1;
    }


    // VALIDO EL CAMPO FECHA [NULL, LONGITUD]
    if (fechaL.length==0||fechaL.length<10||fechaV.length>=11||fechaL==null) {
      fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>FECHA OBLIGATORIA "+fechaV+"</p>");
      document.getElementById("fecha").value = fechaV;
      keyRt = 1;
    }
    // VALIDO LA FECHA FORMATO CORRECTO
    else if(fechaExp.test(fechaV) == false){
      fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>FECHA FORMATO INCORRECTO</p>");
      document.getElementById("fecha").value = fechaV;
      keyRt = 1;
    }
    // VALIDO FECHA RESERVA
  else if((fechaV < hoy)){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>ESTA FECHA ES ANTERIOR A HOY</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
  else if((fechaV == hoy)){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>NO SE ADMITEN RESERVAS EL MISMO DIA</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
  // MARTES CERRADO
  else if(daytext == 2){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>LOS MARTES CERRADO</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
  else if(fechaV > maxMes){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>NO SE ADMITEN RESERVAS MAS DE 1 MES</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
    else{
      /*
      fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD' style='color:#343434 !important;'> LA FECHA ES: "+fechaV+"</p>");
      */
    }


    // VALIDO LA HORA [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (!isNaN(horaV)||horaL.length==0||horaL.length<5||horaV.length>=101||horaL==null) {
      horaEr = document.getElementById("horaD").innerHTML = ("<p class='errorD'>HORA OBLIGATORIO "+horaV+"</p>");
      document.getElementById("hora").value = horaV;
      keyRt = 1;
    }
    // VALIDO LA HORA FORMATO CORRECTO
    else if(horaExp.test(horaV) == false){
      horaEr = document.getElementById("horaD").innerHTML = ("<p class='errorD'>FORMATO NO VALIDO</p>");
      document.getElementById("hora").value = horaV;
      keyRt = 1;
    }
    // VALIDO LA HORA MINIMA Y MAXIMA
    else if(horaMax < 0900 || horaMax > 2130){
      horaEr = document.getElementById("horaD").innerHTML = ("<p class='errorD'>NO SE ADMINTEN RESERVAS A ESTA HORA "+horaV+"</p>");
      document.getElementById("hora").value = horaV;
      keyRt = 1;
    }else{
      horaEr = document.getElementById("horaD").innerHTML = ("<p class='errorD' style='color:#343434 !important;'> LA HORA ES: "+horaV+"</p>");
    }

    // VALIDO LOS COMENTARIOS [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (comentL.length==0||comentL.length<5||comentV.length>=251||comentL==null) {
      comentEr = document.getElementById("comentD").innerHTML = ("<p class='errorD'>COMENTARIOS OBLIGATORIO, MINIMO 5, MAXIMO 250</p>");
      document.getElementById("coment").value = comentV;
      keyRt = 1;
    }
    // VALIDO LOS COMENTARIOS QUE SOLO SEAN LETRAS
    else if(comentCarac.test(comentV) == false){
      comentEr = document.getElementById("comentD").innerHTML = ("<p class='errorD'>COMENTARIOS NO SE PERMITEN CARACTERES ESPECIALES</p>");
      document.getElementById("coment").value = comentV;
      keyRt = 1;
    }

    // VALIDO EL CAMPO CHECKBOX
    if (!checkV) { 
      checkEr = document.getElementById("checkD").innerHTML = ("<p class='errorD'>CHECKBOX NO ESTA SELECCIONADO</p>");
      document.getElementById("check").value = checkV;
      keyRt = 1;
      }

    // RETORNO VALORES
    if (keyRt > 0){
      // NO HAY ERRORES
      document.getElementById("datosF").innerHTML = "";
      return false;
    }
    else if (keyRt == 0){ 
        /* COMENTO ESTO PARA QUE NO SE IMPRIMA
        const valores = [nombreV, apellidoV, mailV, telfV, interesV, nComenV, nComenL, fechaV, horaV, comentV, checkV];
        let textValor = "";
        valores.forEach(myFunction); // RECORRE EL ARRAY RETORNA ITEM INDEX
        document.getElementById("datosF").innerHTML = textValor;
         function myFunction(item, index) { 
            if (index == 0){ camp = "Nombre";}
            else if (index == 1){camp = "Apellido";}
            else if (index == 2){camp = "Mail";}
            else if (index == 3){camp = "Telefono";}
            else if (index == 4){camp = "Interes";}
            else if (index == 5){camp = "Nº Comensales";}
            else if (index == 6){camp = "Nº Mesas";}
            else if (index == 7){camp = "Fecha";}
            else if (index == 8){camp = "Hora";}
            else if (index == 9){camp = "Comentarios";}
            else if (index == 10){camp = "Check";}
            textValor+= "<p class='varVal'>"+(camp) + ": " + item + ".</p>";
            index ++;
        }  
        */
        return true; // PARA NO SALIR DEL FORMULARIO [TRUE]
      } 
  
      //return true; // NO QUIERO QUE SE PROCESE

  } // FIN FUNCION

  function ejercicio(){
    let checkV = document.forms["datos"]["check"].checked;
    if (!checkV) { 
      document.getElementById("checkD").innerHTML = ("<p class='errorD'>CHECKBOX NO ESTA SELECCIONADO</p>");
      document.getElementById("check").value = checkV;
      }else{
        document.getElementById("checkD").innerHTML = "<p class='varVal'>ACEPTADAS LAS CONDICIONES</p>";
        document.getElementById("check").value = checkV;
      }
  } // FIN FUNCION EJERCICIO

  // AL HACER CLICK EN EL FORMULARIO PRINCIPAL SE BORRAN LOS ERRORES DEL CUADRO DE ACCESO SUPERIOR DERECHO
  function limpioFormAcceso(){
      // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
      // INICIALIZO LAS VARIABLES DE ERRORES
      document.getElementById("nombreUsrD").innerHTML = ("");
      document.getElementById("nombreUsr").value = "";
      document.getElementById("passD").innerHTML = ("");
      document.getElementById("pass").value = "";
      document.getElementById("datosTUs").innerHTML = "";
      document.getElementById("datosFUs").innerHTML = "";
  }

  function botonPopUpFormContact(){
    limpioFormAcceso();
    limpioFormPrin();
    window.open('userAccessPopUp.php','','scrollbars=yes,menubar=no,width=400,resizable=yes,toolbar=no,location=no,status=no');
  }

 
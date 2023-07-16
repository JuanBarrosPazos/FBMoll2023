
// P.21V02 => VALIDO CAMPO A CAMPO SIN ALERT Y CON NOTIFICACIÓN CONJUNTA

function validateForm() {

  // DECLARO LAS VARIABLES RECOJO LOS VALORES DEL FORMULARIO
  //let nombreV = document.getElementById("nombre").value; 
  let nombreV = document.forms["datos"]["nombre"].value;
  //let apellidoV = document.getElementById("apellido").value;
  let apellidoV = document.forms["datos"]["apellido"].value;
  let dniV = document.forms["datos"]["dni"].value;
  let lDniV = document.forms["datos"]["lDni"].value.toUpperCase();
  let mailV = document.forms["datos"]["mail"].value;
  let telfV = document.forms["datos"]["telf"].value;
  let fechaV = document.forms["datos"]["fecha"].value;
  let nickV = document.forms["datos"]["nick"].value;
  let nick2V = document.forms["datos"]["nick2"].value;
  let passwV = document.forms["datos"]["passw"].value;
  let passw2V = document.forms["datos"]["passw2"].value;
  //let checkV = document.getElementById("check").checked;
  let checkV = document.forms["datos"]["check"].checked;
  let direccionV = document.forms["datos"]["direccion"].value;


  // INICIALIZO LAS VARIABLES DE ERRORES
  let nombreEr = document.getElementById("nombreD").innerHTML = ("");
  let apellidoEr = document.getElementById("apellidoD").innerHTML = ("");
  let dniEr = document.getElementById("dniD").innerHTML = ("");
  let lDniEr = document.getElementById("lDniD").innerHTML = ("");
  let mailEr = document.getElementById("mailD").innerHTML = ("");
  let telfEr = document.getElementById("telfD").innerHTML = ("");
  let fechaEr = document.getElementById("fechaD").innerHTML = ("");
  let nickEr = document.getElementById("nickD").innerHTML = ("");
  let nick2Er = document.getElementById("nick2D").innerHTML = ("");
  let passwEr = document.getElementById("passwD").innerHTML = ("");
  let passw2Er = document.getElementById("passw2D").innerHTML = ("");
  let checkEr = document.getElementById("checkD").innerHTML = ("");
  let direccionEr = document.getElementById("direccionD").innerHTML = ("");

  // ELIMINO ESPACIOS EN BLANCO PARA COMPROBAR LA LONGITUD
  nombreV = nombreV.trim();
  let nombreL = nombreV.replace(/\s+/g, '');

  apellidoV = apellidoV.trim();
  let apellidoL = apellidoV.replace(/\s+/g, '');

  dniV = dniV.trim();
  let dniL = dniV.replace(/\s+/g, '');

  lDniV = lDniV.trim();
  let lDniL = lDniV.replace(/\s+/g, '');

  mailV = mailV.trim();
  let mailL = mailV.replace(/\s+/g, '');
  mailL = mailL.replace(/,/g, '.');

  telfV = telfV.trim();
  let telfL = telfV.replace(/\s+/g, '');

  nickV = nickV.trim();
  let nickL = nickV.replace(/\s+/g, '');

  nick2V = nick2V.trim();
  let nick2L = nick2V.replace(/\s+/g, '');

  passwV = passwV.trim();
  let passwL = passwV.replace(/\s+/g, '');

  passw2V = passw2V.trim();
  let passw2L = passw2V.replace(/\s+/g, '');

  fechaV = fechaV.trim();
  let fechaL = fechaV.replace(/\s+/g, '');

  direccionV = direccionV.trim();
  let direccionL = direccionV.replace(/\s+/g, '');

  // EXPRESINES REGULARES
  let letrasExp = /^[a-z A-Z]+$/;
  let numerosExp = /^[0-9]+$/;
  let passCarac = /^[a-z A-Z 0-9 !?\*]+$/;
  let comentCarac = /^[a-z A-Z 0-9 áéíóúÁÉÍÓÚñÑ ;,.\s]+$/;
  let noValidos = /^[^@´`\'#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/;
  //let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/; // Primer Valor
  /* 
  / Inicio de la expresion ^ Inicio del la cadena [^ No se permiten estos caracteres, ni mayusculas, ni espacios] ([se permiten minusculas y numeros una o varias veces]{minimo 3}mas @ (([minusculas y numeros una o mas veces]{minimo 3}mas . [mas minusculas minimo 2 maximo 4 una o varias veces]))) $ fin del strin / fin de la expresion
  */
  let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*A-Z\s]([a-z0-9_]{2,})+@(([-a-z0-9]{3,})+\.)+([a-z]{2,3})$/;
  let fechaExp = /^\d{4}-\d{1,2}-\d{1,2}$/;
  let horaExp = /^\d{1,2}:\d{1,2}$/;
  
  // VALIDACION DEL DNI
  let letrasDni = 'TRWAGMYFPDXBNJZSQVHLCKE';
  let indice = parseInt(dniV)%23;
  let letraDni = letrasDni[indice];

  // VALIDACION DE LA FECHA MAYOR DE EDAD
  var fecha = new Date();   var diames = fecha.getDate();   var mes = fecha.getMonth() + 1;
  /*
  var ano = fecha.getYear();
  if (fecha.getYear() < 2000){
        ano = 1900 + fecha.getYear();
  } else {
        ano = fecha.getYear();
  }
  */
  let ano = fecha.getFullYear();
  if(mes < 10){ mes = "0"+mes;}else{ }
  if(diames < 10){ diames = "0"+diames; }else{ }
  var hoy = ano+"-"+mes+"-"+diames;
  var soyMenor = (ano-18)+"-"+mes+"-"+diames;
  var errorDate;
  // FIN VALIDACION FECHA MAYOR DE EDAD

  // DECLARO KEYS
  let keyRt = 0;

  // VALIDO EL NOMBRE [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(nombreV)||nombreL.length==0||nombreL.length<3||nombreV.length>=20||nombreL==null) {
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
  if (!isNaN(apellidoV)||apellidoL.length==0||apellidoL.length<3||apellidoV.length>=20||apellidoL==null) {
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


  // VALIDO EL NUMERO DEL DNI [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (isNaN(dniV)||dniL.length==0||dniL.length<8||dniV.length>=9||dniL==null) {
    dniEr = document.getElementById("dniD").innerHTML = ("<p class='errorD'>NUMERO DNI OBLIGATORIO, SOLO 8 NUMEROS</p>");
    document.getElementById("dni").value = dniV;
    keyRt = 1;
  }
  // VALIDO NUMERO DE DNI ES SOLO NUMERO
  else if(numerosExp.test(dniV) == false){
    dniEr = document.getElementById("dniD").innerHTML = ("<p class='errorD'>NUMERO DNI CARACTERES ERRONEOS</p>");
    document.getElementById("dni").value = dniV;
    keyRt = 1;
  }


  // VALIDO LA LETRA DEL DNI [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(lDniV)||lDniL.length==0||lDniL.length<1||lDniV.length>=2||lDniL==null) {
    lDniEr = document.getElementById("lDniD").innerHTML = ("<p class='errorD'>LETRA DEL DNI OBLIGATORIA, SOLO 1 LETRA</p>");
    document.getElementById("lDni").value = lDniV;
    keyRt = 1;
  }
  // VALIDO LA LETRA DEL DNI QUE SOLO SEAN LETRAS
  else if(letrasExp.test(lDniV) == false){
    lDniEr = document.getElementById("lDniD").innerHTML = ("<p class='errorD'>LETRA DEL DNI SOLO SE PERMITEN LETRAS</p>");
    document.getElementById("lDni").value = lDniV;
    keyRt = 1;
  }
  // VALIDO QUE LA LETRA DEL DNI ES CORRECTA
  else if( lDniV != letraDni){
    lDniEr = document.getElementById("lDniD").innerHTML = ("<p class='errorD'>LETRA DEL DNI NO ES CORRECTA "+lDniV+" CORRECTA "+letraDni+"</p>");
    document.getElementById("lDni").value = lDniV;
    keyRt = 1;
  }


  // VALIDO EL EMAIL [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(mailV)||mailL.length==0||mailL.length<7||mailV.length>=30||mailL==null) {
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
  // VALIDO MAYOR DE EDAD
  else if((fechaV == hoy)||(fechaV > hoy)){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>FECHA IGUAL O SUPERIOR A HOY</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
  else if(fechaV > soyMenor){
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD'>FECHA SOY MENOR DE EDAD</p>");
    document.getElementById("fecha").value = fechaV;
    keyRt = 1;
  }
  else{
    /*
    fechaEr = document.getElementById("fechaD").innerHTML = ("<p class='errorD' style='color:#343434 !important;'> LA FECHA ES: "+fechaV+" || "+hoy+"</p>");
    */
  }


  // VALIDO EL NICK [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(nickV)||nickL.length==0||nickL.length<3||nickV.length>=20||nickL==null) {
    nickEr = document.getElementById("nickD").innerHTML = ("<p class='errorD'>NICK OBLIGATORIO, LETRAS NUMEROS Y !?*, MINIMO 3, MAXIMO 20</p>");
    document.getElementById("nick").value = nickV;
    keyRt = 1;
  }
  // VALIDO NICK EXPRESION
  else if(passCarac.test(nickV) == false){
    nickEr = document.getElementById("nickD").innerHTML = ("<p class='errorD'>NICK LETRAS NUMEROS Y !?*</p>");
    document.getElementById("nick").value = nickV;
    keyRt = 1;
  }

  // VALIDO EL NICK2 [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(nick2V)||nick2L.length==0||nick2L.length<3||nick2V.length>=20||nick2L==null) {
    nick2Er = document.getElementById("nick2D").innerHTML = ("<p class='errorD'>NICK OBLIGATORIO, LETRAS NUMEROS Y !?*, MINIMO 3, MAXIMO 20</p>");
    document.getElementById("nick2").value = nick2V;
    keyRt = 1;
  }
  // VALIDO NICK2 EXPRESION
  else if(passCarac.test(nick2V) == false){
    nick2Er = document.getElementById("nick2D").innerHTML = ("<p class='errorD'>NICK LETRAS NUMEROS Y !?*</p>");
    document.getElementById("nick2").value = nick2V;
    keyRt = 1;
  }
  // VALIDO QUE LOS DOS NICK SEAN IGUALES
  else if(nick2V != nickV){
    nickEr = document.getElementById("nickD").innerHTML = ("<p class='errorD'>NICK Y NICK2 NO SON IGUALES</p>");
    document.getElementById("nick").value = nickV;
    nick2Er = document.getElementById("nick2D").innerHTML = ("<p class='errorD'>NICK Y NICK2 NO SON IGUALES</p>");
    document.getElementById("nick2").value = nick2V;
    keyRt = 1;
  }

  // VALIDO EL PASSW [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(passwV)||passwL.length==0||passwL.length<3||passwV.length>=20||passwL==null) {
    passwEr = document.getElementById("passwD").innerHTML = ("<p class='errorD'>PASSW OBLIGATORIO, LETRAS NUMEROS Y !?*, MINIMO 3, MAXIMO 20</p>");
    document.getElementById("passw").value = passwV;
    keyRt = 1;
  }
  // VALIDO PASSW EXPRESION
  else if(passCarac.test(passwV) == false){
    passwEr = document.getElementById("passwD").innerHTML = ("<p class='errorD'>PASSW LETRAS NUMEROS Y !?*</p>");
    document.getElementById("passw").value = passwV;
    keyRt = 1;
  }

  // VALIDO EL PASSW2 [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
  if (!isNaN(passw2V)||passw2L.length==0||passw2L.length<3||passw2V.length>=20||passw2L==null) {
    passw2Er = document.getElementById("passw2D").innerHTML = ("<p class='errorD'>PASSW2 OBLIGATORIO, LETRAS NUMEROS Y !?*, MINIMO 3, MAXIMO 20</p>");
    document.getElementById("passw2").value = passw2V;
    keyRt = 1;
  }
  // VALIDO PASSW2 EXPRESION
  else if(passCarac.test(passw2V) == false){
    passw2Er = document.getElementById("passw2D").innerHTML = ("<p class='errorD'>PASSW2 LETRAS NUMEROS Y !?*</p>");
    document.getElementById("passw2").value = passw2V;
    keyRt = 1;
  }
  // VALIDO PASSW Y PASSW2 SEAN IGUALES
  if(passwV != passw2V){
    passwEr = document.getElementById("passwD").innerHTML = ("<p class='errorD'>PASSW Y PASSW2 NO SON IGUALES</p>");
    document.getElementById("passw").value = passwV;
    passw2Er = document.getElementById("passw2D").innerHTML = ("<p class='errorD'>PASSW Y PASSW2 NO SON IGUALES</p>");
    document.getElementById("passw2").value = passw2V;
    keyRt = 1;
  }

  // VALIDO EL CAMPO CHECKBOX
  if (!checkV) { 
    checkEr = document.getElementById("checkD").innerHTML = ("<p class='errorD'>CHECKBOX NO ESTA SELECCIONADO</p>");
    document.getElementById("check").value = checkV;
    keyRt = 1;
    }


  // VALIDO DIRECCION OBLIGATORIO Y MAX CARACTERES
  if (direccionL.length==0||direccionL.length<10||direccionV.length>=57||direccionL==null) {
    direccionEr = document.getElementById("direccionD").innerHTML = ("<p class='errorD'>DIRECCION OBLIGATORIO, SOLO LETRAS O NUMEROS, MINIMO 10, MAXIMO 56</p>");
    document.getElementById("direccion").value = direccionV;
    keyRt = 1;
  }
  // VALIDO DIRECCION SIN CARACTERES ESPECIALES
  else if(comentCarac.test(direccionV) == false){
    direccionEr = document.getElementById("direccionD").innerHTML = ("<p class='errorD'>DIRECCION CARACTERES NO PERMITIDOS</p>");
    document.getElementById("direccion").value = direccionV;
    keyRt = 1;
  }

  // RETORNO VALORES
  if (keyRt > 0){
    // HAY ERRORES
    document.getElementById("datosF").innerHTML = "";
    return false;
  }
  else if (keyRt == 0){
    // NO HAY ERRORES
    /*  COMENTO ESTO PARA QUE NO SE IMPRIMA
    const valores = [nombreV, apellidoV, dniV, lDniV, mailV, telfV, fechaV, nickV, nick2V, passwV, passw2V, checkV, direccionV];
    let textValor = "";
    valores.forEach(myFunction); // RECORRE EL ARRAY RETORNA ITEM INDEX
    document.getElementById("datosF").innerHTML = textValor;
    function myFunction(item, index) { 
        if (index == 0){ camp = "Nombre";}
        else if (index == 1){camp = "Apellido";}
        else if (index == 2){camp = "Dni";}
        else if (index == 3){camp = "L.Dni";}
        else if (index == 4){camp = "Mail";}
        else if (index == 5){camp = "Telefono";}
        else if (index == 6){camp = "Fecha";}
        else if (index == 7){camp = "Nick";}
        else if (index == 8){camp = "Nick2";}
        else if (index == 9){camp = "Password";}
        else if (index == 10){camp = "Password2";}
        else if (index == 11){camp = "Check";}
        else if (index == 12){camp = "direccion";}
        textValor+= "<p class='varVal'>"+(camp) + ": " + item + ".</p>";
        index ++;
      } 
      */
      return true; // PARA NO SALIR DEL FORMULARIO [false]
    } 
    return true; // NO QUIERO QUE SE PROCESE false

} // FIN FUNCION validateForm()

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




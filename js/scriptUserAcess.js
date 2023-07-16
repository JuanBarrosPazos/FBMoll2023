
// P.21V02 => VALIDO CAMPO A CAMPO SIN ALERT Y CON NOTIFICACIÓN CONJUNTA

function validateFormUsr() {

    // DECLARO LAS CONSTANTES DE USUARIOS CONTRASEÑA
    const user1 = "Juan"; const pass1 = "Lolita!";
    const user2 = "Ana";  const pass2 = "Lolailo**";
    const user3 = "Luis"; const pass3 = "Reloli+";
    let passw;
    
    // DECLARO LAS VARIABLES RECOJO LOS VALORES DEL FORMULARIO
    //let nombreUsrV = document.getElementById("nombreUsr").value; 
    let nombreUsrV = document.forms["acceso"]["nombreUsr"].value;
    //let passV = document.getElementById("pass").value;
    let passV = document.forms["acceso"]["pass"].value;
 

    // INICIALIZO LAS VARIABLES DE ERRORES
    let nombreUsrEr = document.getElementById("nombreUsrD").innerHTML = ("");
    let passEr = document.getElementById("passD").innerHTML = ("");

    // ELIMINO ESPACIOS EN BLANCO PARA COMPROBAR LA LONGITUD
    nombreUsrV = nombreUsrV.trim();
    let nombreUsrL = nombreUsrV.replace(/\s+/g, '');

    passV = passV.trim();
    let passL = passV.replace(/\s+/g, '');

    // EXPRESINES REGULARES
    let letrasExp = /^[a-z A-Z]+$/;
    let userExp = /^[a-z A-Z 0-9 \s]+$/;
    let numerosExp = /^[0-9]+$/;
    let passCarac = /^[a-z A-Z 0-9 !?\*\+]+$/;
    let comentCarac = /^[a-z A-Z 0-9 áéíóúÁÉÍÓÚ ;,.\s]+$/;
    let noValidos = /^[^@´`\'#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/;
    //let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/; // Primer Valor
    /* 
    / Inicio de la expresion ^ Inicio del la cadena [^ No se permiten estos caracteres, ni mayusculas, ni espacios] ([se permiten minusculas y numeros una o varias veces]{minimo 3}mas @ (([minusculas y numeros una o mas veces]{minimo 3}mas . [mas minusculas minimo 2 maximo 4 una o varias veces]))) $ fin del strin / fin de la expresion
    */
    let mailExp = /^[^@´`\'áéíóúÁÉÍÓÚ#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*A-Z\s]([a-z0-9_]{2,})+@(([-a-z0-9]{3,})+\.)+([a-z]{2,3})$/;
    let fechaExp = /^\d{4}-\d{1,2}-\d{1,2}$/;
    let horaExp = /^\d{1,2}:\d{1,2}$/;
    
    // DECLARO KEYS
    let keyRt = 0;


    // VALIDO EL nombreUsr [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (nombreUsrL.length==0||nombreUsrL.length<3||nombreUsrV.length>=20||nombreUsrL==null) {
      nombreUsrEr = document.getElementById("nombreUsrD").innerHTML = ("<p class='errorD'>NOMBRE OBLIGATORIO, MINIMO 3, MAXIMO 20</p>");
      document.getElementById("nombreUsr").value = nombreUsrV;
      keyRt = 1;
    }
    // VALIDO nombreUsr QUE SOLO SEAN LETRAS
    else if(userExp.test(nombreUsrV) == false){
      nombreUsrEr = document.getElementById("nombreUsrD").innerHTML = ("<p class='errorD'>NOMBRE CARACTERES NO PERMITIDOS</p>");
      document.getElementById("nombreUsr").value = nombreUsrV;
      keyRt = 1;
    }
    // PASO VARIABLES PARA EL EJERCICIO
    else{
        if(nombreUsrV == user1){
            passw = pass1;
        }else if(nombreUsrV == user2){
            passw = pass2;
        }else if(nombreUsrV == user3){
            passw = pass3;
        }else {
            passw = "passError";
        }
    }

    // VALIDO EL PASSWORD [NUMERO, LONGITUD MIN, LONGITUD MAX, NULL]
    if (passL.length==0||passL.length<3||passV.length>=20||passL==null) {
        passEr = document.getElementById("passD").innerHTML = ("<p class='errorD'>PASSWORD OBLIGATORIO, MINIMO 3, MAXIMO 20</p>");
        document.getElementById("pass").value = passV;
        keyRt = 1;
      }
    // VALIDO PASSWORD QUE SOLO SEAN LETRAS
    else if(passCarac.test(passV) == false){
      passEr = document.getElementById("passD").innerHTML = ("<p class='errorD'>PASSWORD CARACTERES NO PERMITIDOS</p>");
      document.getElementById("pass").value = passV;
      keyRt = 1;
    }

    // VALIDO USUARIO PARA EL EJERCCIO
    if(keyRt != 1 && passV != passw){
        passEr = document.getElementById("passD").innerHTML = ("<p class='errorD'>ACCESO DENEGADO</p>");
        document.getElementById("pass").value = passV;
        nombreUsrEr = document.getElementById("nombreUsrD").innerHTML = ("<p class='errorD'>ACCESO DENEGADO</p>");
        document.getElementById("nombreUsr").value = nombreUsrV;
        keyRt = 1;
    }

      
    // RETORNO VALORES
    if (keyRt > 0){
        document.getElementById("datosTUs").innerHTML = "";
        document.getElementById("datosFUs").innerHTML = "";
      return false;
    }
    else if (keyRt == 0){ 
        const valores = [nombreUsrV, passV];
        let textValor = "";
        valores.forEach(myFunction); // RECORRE EL ARRAY RETORNA ITEM INDEX
        document.getElementById("datosTUs").innerHTML = "<h5 class='varVal'>ACCESO PERMITIDO</h5>";
        document.getElementById("datosFUs").innerHTML = textValor;
         function myFunction(item, index) { 
            if (index == 0){ camp = "nombreUsr";}
            else if (index == 1){camp = "Password";}
            textValor+= "<p class='varVal'>"+(camp) + ": " + item + ".</p>";
            index ++;
        } 
        return false; // PARA NO SALIR DEL FORMULARIO [TRUE]
      } 
  
      return false; // NO QUIERO QUE SE PROCESE

  } // FIN FUNCION

  // AL HACER CLICK EN EL FORMULARIO SUPERIOR DERECHO BORRO LOS ERRORES DEL FORMULARIO PRINCIPAL
  function limpioFormPrin(){
    // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
    // INICIALIZO LAS VARIABLES DE ERRORES Y VALUE
      document.getElementById("nombreD").innerHTML = ("");
      document.getElementById("nombre").value = "";
      document.getElementById("apellidoD").innerHTML = ("");
      document.getElementById("apellido").value = "";
      //document.getElementById("dniD").innerHTML = ("");
      //document.getElementById("dni").value = "";
      //document.getElementById("lDniD").innerHTML = ("");
      //document.getElementById("lDni").value = "";
      document.getElementById("mailD").innerHTML = ("");
      document.getElementById("mail").value = "";
      document.getElementById("telfD").innerHTML = ("");
      document.getElementById("telf").value = "";
      document.getElementById("interesD").innerHTML = ("");
      document.getElementById("interes").value = "";
      document.getElementById("nComenD").innerHTML = ("");
      document.getElementById("nComen").value = "";
      document.getElementById("nMesasD").innerHTML = ("");
      document.getElementById("nMesas").value = "";
      document.getElementById("fechaD").innerHTML = ("");
      document.getElementById("fecha").value = "";
      document.getElementById("horaD").innerHTML = ("");
      //document.getElementById("hora").value = "";
      document.forms["datos"]["hora"].value = "";
      document.getElementById("comentD").innerHTML = ("");
      document.getElementById("coment").value = "";
      document.getElementById("checkD").innerHTML = ("");
      document.getElementById("check").value = "";
    // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
    document.getElementById("datosF").innerHTML = "";

  } // FIN FUNCTION

    // AL HACER CLICK EN EL FORMULARIO SUPERIOR DERECHO BORRO LOS ERRORES DEL FORMULARIO PRINCIPAL
    function limpioFormPrinReg(){
      // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
      // INICIALIZO LAS VARIABLES DE ERRORES Y VALUE
        document.getElementById("nombreD").innerHTML = ("");
        document.getElementById("nombre").value = "";
        document.getElementById("apellidoD").innerHTML = ("");
        document.getElementById("apellido").value = "";
        //document.getElementById("dniD").innerHTML = ("");
        //document.getElementById("dni").value = "";
        //document.getElementById("lDniD").innerHTML = ("");
        //document.getElementById("lDni").value = "";
        document.getElementById("mailD").innerHTML = ("");
        document.getElementById("mail").value = "";
        document.getElementById("telfD").innerHTML = ("");
        document.getElementById("telf").value = "";
        document.getElementById("interesD").innerHTML = ("");
        document.getElementById("interes").value = "";
        document.getElementById("nComenD").innerHTML = ("");
        document.getElementById("nComen").value = "";
        document.getElementById("nMesasD").innerHTML = ("");
        document.getElementById("nMesas").value = "";
        document.getElementById("fechaD").innerHTML = ("");
        document.getElementById("fecha").value = "";
        document.getElementById("horaD").innerHTML = ("");
        //document.getElementById("hora").value = "";
        document.forms["datos"]["hora"].value = "";
        document.getElementById("comentD").innerHTML = ("");
        document.getElementById("coment").value = "";
        document.getElementById("checkD").innerHTML = ("");
        document.getElementById("check").value = "";
      // BORRO LOS DATOS DE MENSAJES DE ERROR DEL OTRO FORMULARIO
      document.getElementById("datosF").innerHTML = "";
  
    } // FIN FUNCTION
  
  // JUEGO CON LOS COLORES DE LOS CAMPOS DE USER PASWORD
  function fondoColorSi(x) {
    x.style.background = "#d1f0ec";
  }
  function fondoColorNo(x) {
    x.style.background = "";
  }
  function presionoTecla(x) {
    x.style.backgroundColor = "#fdf2c0";
  }

  // MENSAJE AL CERRAR LA VENTANA
  function alertCerrarVentana(){
    return "...";
  }
  /* 
  window.onbeforeunload = function(event) {
    event.returnValue = "...";
  };
  */

  // CAMBIO LA IMAGEN DEL LOGO
        function modifImgNo(){
          // MODIFICO LA RUTA PARA LA URI
          // let imgEje = document.getElementById("logo").src = "../img/Logos/logo.png";
            let imgEje = document.getElementById("logo").src = "img/Logos/logo.png";
            return imgEje;
            }
        function modifImgMouse(){
          // MODIFICO LA RUTA PARA LA URI
          // let imgEje = document.getElementById("logo").src = "../img/Logos/favicon.png";
            let imgEje = document.getElementById("logo").src = "img/Logos/favicon.png";
            return imgEje;
            }



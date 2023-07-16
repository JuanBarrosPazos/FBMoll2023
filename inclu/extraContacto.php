<?php

    global $plusHeader;
    $plusHeader = '<script src="'.$ruta.'js/func.js"></script>
            <script type="text/JavaScript">
            // Esta función limita el número de carácteres del text area de comentarios.
            function limita(elEvento, maximoCaracteres) {
                    var elemento = document.getElementById("coment");
            // Obtener la tecla pulsada 
                    var evento = elEvento || window.event;
                    var codigoCaracter = evento.charCode || evento.keyCode;
                    // Permitir utilizar las teclas con flecha horizontal
                    if(codigoCaracter == 37 || codigoCaracter == 39) { return true;}
            // Permitir borrar con la tecla Backspace y con la tecla Supr.
                if(codigoCaracter == 8 || codigoCaracter == 46) {
                    return true;
                }else if(elemento.value.length >= maximoCaracteres ) {
                    return false;
                    }else {return true;}
                } // FIN FUNCION
    
            function actualizaInfo(maximoCaracteres) {
                var elemento = document.getElementById("coment");
                var info = document.getElementById("info");
            if(elemento.value.length >= maximoCaracteres ) {
                info.innerHTML = "Máximo "+maximoCaracteres+"caracteres";
            }else {
                info.innerHTML = "Restan "+(maximoCaracteres-elemento.value.length)+" caracteres.";
                }
            } // FIN FUNCION
                // Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 100);" onkeyup="actualizaInfo(100)" para limitar los caracteres a 100 en este caso.
                function MM_validateForm() { 
                if (document.getElementById){
                    var i,p,q,nm,test,num,min,max,errors="",args=MM_validateForm.arguments;
                    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
                    if (val) { nm=val.name; if ((val=val.value)!="") {
                        if (test.indexOf("isEmail")!=-1) { p=val.indexOf("@");
                        if (p<1 || p==(val.length-1)) errors+="- "+nm+" must contain an e-mail address.\n";
                        } else if (test!="R") { num = parseFloat(val);
                        if (isNaN(val)) errors+="- "+nm+" must contain a number.\n";
                        if (test.indexOf("inRange") != -1) { p=test.indexOf(":");
                            min=test.substring(8,p); max=test.substring(p+1);
                            if (num<min || max<num) errors+="- "+nm+" must contain a number between "+min+" and "+max+".\n";
                    } } } else if (test.charAt(0) == "R") errors += "- "+nm+" is required.\n"; }
                    } if (errors) alert("The following error(s) occurred:\n"+errors);
                    document.MM_returnValue = (errors == "");} 
                    } // FIN FUNCION
            </script>
            <!-- FUNCION DE LA HORA JS -->
            <script src="'.$ruta.'js/hora.js"></script>';

    global $plusBody;
    $plusBody = 'onload="hora()"';
    global $plusLogo;
    $plusLogo = 'onmouseover="modifImgMouse()" onmouseout="modifImgNo()"';

?>
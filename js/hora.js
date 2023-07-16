function hora(){

    let fecha = new Date();
    let diames = fecha.getDate();
    let daytext = fecha.getDay();

    if(daytext == 0){ daytext = "DOMINGO";}
    else if(daytext == 1){ daytext = "LUNES";}
    else if(daytext == 2){ daytext = "MARTES";}
    else if(daytext == 3){ daytext = "MIERCOLES";}
    else if(daytext == 4){ daytext = "JUEVES";}
    else if(daytext == 5){ daytext = "VIERNES";}
    else if(daytext == 6){ daytext = "SABADO";}

    let mes = fecha.getMonth()+1;
    if(mes < 10){
        mes = 0+mes.toString();
    }else{ }
    let ano = fecha.getYear();

    if(fecha.getYear()<2000){ ano = 1900+fecha.getYear();}
    else{ ano = fecha.getYear();}

    let hora = fecha.getHours();
    let minuto = fecha.getMinutes();
    let segundo = fecha.getSeconds();

    if(hora>=12 && hora<=23){ m = "P.M.";}
    else{ m = "A.M.";}

    if(hora < 10){ hora = "0"+hora;}
    if(minuto < 10){ minuto = "0"+minuto;}
    if(segundo < 10){ segundo = "0"+segundo;}

    let nowhora = daytext+" "+diames+"/"+mes+"/"+ano+" - TIME: "+hora+":"+minuto+":"+segundo;

    //document.getElementById("hora").firstChild.nodeValue = nowhora;
    document.getElementById("hora").innerHTML = nowhora;

    tiempo = setTimeout('hora()',1000);
}

function ejercicioDos(){
    alert("GRACIAS POR VISITARNOS");
  }
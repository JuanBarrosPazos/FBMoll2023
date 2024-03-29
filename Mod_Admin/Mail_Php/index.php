<!DOCTYPE html>
	
<head>
	
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="content-type" content="text/html" charset="utf-8" />
<meta http-equiv="Content-Language" content="es-es">
<meta name="Language" content="Spanish">
<meta name="description" content="Modulo Administrador" />
<meta name="keywords" content="Juan Barros Pazos, Programas gratis, Spain, Mallorca, Palma de Mallorca" />
<meta name="robots" content="all, index, follow" />
<meta name="audience" content="All" />
<title>Juan Manuel Barros Pazos</title>

<link href="Descargas.css" rel="stylesheet" type="text/css" />
<link href="favicon.png" type='image/ico' rel='shortcut icon' />

<script type="text/JavaScript">
<!--
// Esta función limita el número de carácteres del text area de comentarios.
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfo(maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
  var info = document.getElementById("info");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+"caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}
// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.
function MM_validateForm() { 
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }

</script>
	
</head>

<body topmargin="0">
<div id="Conte">

  <div id="head"> 
  			<span style="font-size:18px">
			  		JUAN BARROS PAZOS
            </span>
  	</br>
  			<span style="font-size:12px">
			  	Design & Programming in Palma de Mallorca
            </span>
   </div>

  	<div style="clear:both"></div>
   
   <div id="TitTut" style="margin-top:12px; text-align:center; font-family:'Times New Roman', Times, serif; font-size:18px">
   
        <font color="#FFFFFF">
					<strong> <i>
					Design & Programming in Palma de Mallorca
            		</i></strong>
    	</font>

	        <br />

	</div>

	  <div style="clear:both"></div>
        

  <div id="Caja2Admin">
	  
<?php
		

///////////////////////////////////////////////////////////////////////////////////////////////

	if(isset($_POST['oculto'])){
			if($form_errors = validate_form()){
						show_form($form_errors);
										
			} else {process_Mail();
					//show_form();
					   }
					}	/* Fin del if $_POST['oculto']*/
										
			else {show_form();}
												
/////////////////////////////////////////////////////////////////////////////////////////

 function validate_form(){
	 
	 $errors = array();
		
	/* Validamos el campo Nombre. */
	
		if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "Nombre: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 3 ){
		$errors [] = "Nombre: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "Nombre: <font color='#FF0000'>Solo texto</font>";
		}
		
	/* Validamos el campo Apellidos. */
	
		if(strlen(trim($_POST['apellidos'])) == 0){
		$errors [] = "Apellidos: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['apellidos'])) < 3 ){
		$errors [] = "Apellidos: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['apellidos'])){
		$errors [] = "Apellidos: <font color='#FF0000'>Solo texto</font>";
		}


	/* Validamos el campo mail. */
	
		if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "Mail: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "Mail: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
	/* Validamos el campo Asunto. */
	
		if(strlen(trim($_POST['asunto'])) == 0){
		$errors [] = "Asunto: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['asunto'])) < 3 ){
		$errors [] = "Asunto: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['asunto'])){
		$errors [] = "Asunto: <font color='#FF0000'>Solo texto</font>";
		}

	/* Validamos el campo Mensaje. */
	
		if(strlen(trim($_POST['mensaje'])) == 0){
		$errors [] = "Mensaje: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['mensaje'])) < 3 ){
		$errors [] = "Mensaje: <font color='#FF0000'>Escriba más de tres carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^$<>\[\]\{\}]+$/',$_POST['mensaje'])){
		$errors [] = "Mensaje: <font color='#FF0000'>Caracteres no permitidos $<>[]{}</font>";
		}

	return $errors;
 			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
				$defaults = $_POST;
									} 
		else {	$defaults = array (	'nombre' => isset($_POST['nombre']),
									'apellidos' => isset($_POST['apellidos']),
									'Email' => isset($_POST['Email']),	
									'asunto' => isset($_POST['asunto']),	
									'mensaje' => isset($_POST['mensaje']));
									}
	
	if ($errors){
		
	print("<table align='center'>
				<tr>
					<td style='text-align:'center'>
						<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</td>
				</tr>
				<tr>
					<td style='text-align:left'>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FFFFFF'>* </font>".$errors [$a]."<br/>");
					}
	print("</td>
				</tr>
<embed src='../audi/error_form.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
</embed>
		</table>");

				}
	elseif(isset($_POST['oculto']) != 1){
		print("<embed src='../audi/admin_sys_contact.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed></table>");
			}
	
print(" <table align='center' style=\"border:0px;margin_bottom:6px;margin-top:15px\">
		<tr>
 			<form name='contacto' method='post' action='$_SERVER[PHP_SELF]'>
			<td>Nombre:</td>
            <td width='12'><span style='color:#FFFFFF;'>*</span></td>
            <td><input name='nombre' type='text' id='nombre' size='40' maxlength='35' value='".$defaults['nombre']."'/></td>
      </tr>
      <tr>
        <td>Apellidos:</td>
            <td width='12'><span style='color:#FFFFFF;'>*</span></td>
            <td><input name='apellidos' type='text' id='apellidos' size='40' maxlength='35' value='".$defaults['apellidos']."'/></td>
      </tr>
      <tr>
        <td>Email:</td>
            <td><span style='color:#FFFFFF;'>*</span></td>
            <td><input name='Email' type='text' id='Email' size='40' maxlength='40' value='".$defaults['Email']."'/></td>
      </tr>
      <tr>
        <td>Asunto:</td>
            <td><span style='color:#FFFFFF;'>*</span></td>
            <td><input name='asunto' type='text' id='asunto' size='40' maxlength='25' value='".$defaults['asunto']."'/></td>
      </tr>
      <tr>
        <td>Mensaje:</td>
            <td><span style='color:#FFFFFF;'>*</span></td>
            <td colspan='2'>
<textarea onkeypress='return limita(event, 200)' onkeyup='actualizaInfo(200)' name='mensaje' id='mensaje' cols='40' rows='5'>".$defaults['mensaje']."</textarea>
             
			<div id='info' align='center' style='color:#FFFFFF;'>
			  			 Maximum 200 characters            
			</div>          
		</td>
      </tr>
      <tr>
            <td>&nbsp;</td>
        	<td>&nbsp;</td>
            <td align='right'>
                <input type='submit' value='ENVIAR FORMULARIO CONTACTO' class='botonverde' />
				<input type='hidden' name='oculto' value=1 />
            </td>
		</form>	
      </tr>
	</table>"); /* Fin del print */

	}	/* Fin de la función show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

 function process_Mail(){	

	global $mail_from;
	$mail_from = 'juanbarrospazos@hotmail.es';
	
	global $mensaje;
	$mensaje = '<html lang="es">
					 <head>
						 <meta charset="UTF-8">
						 <meta http-equiv="X-UA-Compatible" content="IE=edge">
						 <meta name="viewport" content="width=device-width, initial-scale=1.0">
						 <title>Document</title>
						 <style>
							 body {
								 font-family: "Times New Roman", Times, serif;
							 }
							 body a {
								 text-decoration:none;
							 }
							 table a {
								 color: #666666;
								 text-decoration: none;
								 font-family: "Times New Roman", Times, serif;
							 }
							 table a:hover {
								 color: #FF9900;
								 text-decoration: none;
							 }
							 tr {
								 margin: 0px;
								 padding: 0px;
							 }
							 td {
								 margin: 0px;
								 padding: 6px;
							 }
							 th {
								 padding: 6px;
								 margin: 0px;
								 text-align: center;
								 color: #666666;
							 }
						 </style>
		 </head>
		<body bgcolor="#D7F0E7">

	<table font-family="Times New Roman" width="600px" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<th colspan="3">Formulario de contacto.</th>
						  </tr>
						  <tr>
							<td align="right" width="40px">Asunto:</td>
							<td width="12" width="12px">&nbsp;</td>
							<td align="left">'.$_POST['asunto'].'</td>
						  </tr>
						  <tr>
						  <tr>
							<td align="right">Nombre:</td>
							<td width="12">&nbsp;</td>
							<td align="left">'.$_POST['nombre'].'</td>
						  </tr>
						  <tr>
							<td align="right">Apellidos:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['apellidos'].'</td>
						  </tr>
						  <tr>
							<td align="right">Email:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Email'].'</td>
						  </tr>
						  <tr>
							<td align="right" valign="top">Mensaje:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['mensaje'].'</td>
						  </tr>
					</table>
						</body>
							</html>';
			
		# datos del mensaje
	 
				global $destinatario;
				$destinatario = 'juanbarrospazos@hotmail.es';
				$titulo= $_POST['asunto']." ".$_POST['nombre']." ".$_POST['apellidos'].".";
				$responder= $_POST['Email'];
				//$remite= $_POST['Email'];
				//$remitente= $_POST['nombre']." ".$_POST['apellidos']."."; 

		# cabecera
	// PASO LAS CABECERAS EN UNA SOLO VARIABLE
	global $cabecera;
	//$cabecera = "Content-type: text/html; charset=UTF-8\nMIME-Version: 1.0\nDate: ".date("l j F Y, G:i")."\n";

	$cabecera = 'Content-type: text/html; charset=UTF-8'."\n";
	//$cabecera = 'Content-Type: multipart/mixed;'."\n";
	$cabecera .= "MIME-Version: 1.0\n";
	//$cabecera .= 'MIME-Version: 1.0' . "\r\n";
	$cabecera .= "Date: ".date("l j F Y, G:i")."\n";
	//$cabecera .= "From: ".$destinatario."<".$destinatario.">\n";
	//$cabecera .= "Return-path: ". $remite."\n";
	//$cabecera .= "Reply-To: ".$responder."\n";
	$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				
			if( mail($destinatario, $titulo, $mensaje, $cabecera)){
						print("<table align='center' style=\"margin-top:40px\">
								<tr>
									<td align='center'>
										<font color='#0080C0'>
											SU MENSAJE HA SIDO ENVIADO.
											<br/>
											MUCHAS GRACIAS. ".$_POST['nombre']." ".$_POST['apellidos'].".
										</font>
									</td>
								 </tr>
								<tr>
									<td align='center'>
										<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
											Contactos Juan Barros
										</a>
									</td>
								</tr>
							</table>
			<embed src='../audi/form_submit_1.mp3' autostart='true' loop='false' width='0' height='0' hidden='true'></embed>");
		}else{
			global $head_footer;
			print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									EL MENSAJE NO HA PODIDO ENVIARSE,<br>
									".$_POST['nombre']." ".$_POST['apellidos'].".
									MUCHAS GRACIAS.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
									&copy; Juan Barr&oacute;s Pazos 2021 - 2023.
								</a>
							</td>
						</tr>
					</table>
		<embed src='../audi/form_submit_2.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
			show_form();											
					} /*Fin del if del mail*/
														
	 		}	/* Fin funcion process_Mail(); */
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
/* Creado por Juan Barros Pazos 2021 */
?>

	</div>
	<div style="clear:both"></div>
		<div id="footer">&copy; Juan Barr&oacute;s Pazos 2021 - 2023.</div>
	</div>
</body>
</html>
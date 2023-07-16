<?php
//session_start();

	require 'error_hidden.php';
	global $rutaHtml; 	$rutaHtml = "../";
	require 'header.php';


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

		if(isset($_POST['delete'])){delete();
									show_form();
									listfiles();
							}
	
		else {	show_form();
				listfiles();
		}
								
	} else { require 'table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){

	global $db;
	global $db_name;
	
	if((isset($_POST['oculto1']))||(isset($_POST['delete']))){
				$_SESSION['tablas'] = $_POST['tablas'];
				$defaults = array ('Orden' => '`id` ASC',
								   'tablas' => $_POST['tablas'],
								   						);
		//print($_SESSION['tablas']);
										}
		else{	unset($_SESSION['tablas']);
				$defaults = array ('Orden' => '`id` ASC',
								   'tablas' => '',);
										}

	if($_SESSION['Nivel'] == 'admin'){
		
		print("
			<table align='center' style='border:1; margin-top:2px' width='auto'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<input type='hidden' name='Orden' value='".$defaults['Orden']."' />
				<tr>
					<td align='center'>LOG ACTIVIDAD CLIENTES</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left; margin-right:6px''>
						<input type='submit' value='SELECCIONE USUARIO' class='botonAzul' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>
			<select name='tablas'>");

	global $db; 	
	global $tablau;	
	$tablau = "`".$_SESSION['clave']."cliente`";

	$sqlu =  "SELECT * FROM $tablau ORDER BY `id_cliente` ASC ";
	$qu = mysqli_query($db, $sqlu);
	if(!$qu){
			print("ERROR L.72 ".mysqli_error($db)."<br/>");
	} else {

		while($rowu = mysqli_fetch_assoc($qu)){
			print ("<option value='".$rowu['dni']."' ");
				if($rowu['dni'] == $defaults['tablas']){ print ("selected = 'selected'"); }
					print ("> ".$rowu['Nombre']." ".$rowu['Apellidos']." </option>");
					} // FIN WHILE
				} // FIN ELSE
		
	print ("</select>
				</div>
					</td>
				</tr>
			</form>	
				</table>"); 
		}
	
	} // FIN FUNCTION show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){
	global $rowa; 	$rowa = '99999999'; // ANONIMO

	if(@$_SESSION['tablas'] == ''){ $_SESSION['tablas'] = $rowa; }
	//print("* ".$_SESSION['tablas'].".</br>");

	global $ruta;
	$ruta ="../userlog/";
	//print("RUTA: ".$ruta.".</br>");
	
	global $rutag;
	//$rutag = "../userlog/{*}";
	$rutag = "../userlog/{*_".$_SESSION['tablas'].".log}";
	//print("RUTA G: ".$rutag.".</br>");
		
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));
	//echo $num."<br>";
	if($num < 1){
		
		print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
					<tr>
					<td align='center'>NO HAY ARCHIVOS PARA DESCARGAR</td>
					</tr>");
	}else{
		global $arrFiles;
		
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' colspan='3' class='BorderInf'>".strtoupper($_SESSION['tablas'])." ARCHIVOS LOG </td></tr>");

		$arrFiles = glob($rutag,GLOB_BRACE);

		//while($archivo = readdir($directorio)){
		for($i=0; $i < $num; $i++){
			//if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			//echo "** ".$arrFiles[$i]."<br>";
			$nomFiles = str_replace('../userlog/', '', $arrFiles[$i]);

			print("<tr>
			<td class='BorderInfDch'>
				<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
					<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
					<input type='hidden' name='ruta' value='".$arrFiles[$i]."'>
					<input type='submit' value='ELIMINAR' class='botonRojo' >
					<input type='hidden' name='delete' value='1' >
				</form>
			</td>
			<td class='BorderInfDch'>
				<form name='archivos' action='".$arrFiles[$i]."' target='_blank' method='post'>
					<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
					<input type='submit' value='DESCARGAR' class='botonVerde' />
				</form>
			</td>
			<td class='BorderInf'>".strtoupper($nomFiles)."</td>");
			
		//}else{}
	} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}


function delete(){unlink($_POST['ruta']);}
	
		

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'footer.php';

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>

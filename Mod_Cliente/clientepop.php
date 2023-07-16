<?php
    require "inclu/header.php";

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'plus') || ($_SESSION['Nivel'] == 'user')){
				
		if((isset($_POST['feed']))||(isset($_POST['detalle']))){	
					process_form();
		}elseif(isset($_POST['logcliente'])){
			listfiles();
		}elseif(isset($_POST['delete'])){
			delete();
			listfiles();
		}

		}else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){

	global $db;     		global $db_name;
	global $table_name; 	

	global $trFeed;
	global $vertodos;
	if(isset($_POST['feed'])){
		$table_name = "`".$_SESSION['clave']."clientefeed`";
	}else{
		$table_name = "`".$_SESSION['clave']."cliente`";
	}
	$vertodos = "SELECT * FROM `$db_name`.$table_name WHERE `id_cliente` = $_POST[id_cliente] LIMIT 1";
	$vertodosQry = mysqli_query($db, $vertodos);
	$vertodosCount = mysqli_num_rows($vertodosQry);
	if(!$vertodosQry){
		echo "<h3>ERROR L.27 ".mysqli_error($db)."</h3>";
	}else{
		if($vertodosCount < 1){
			echo "<h3>NO HAY DATOS</h3>";
		}else{ // HAY DATOS Y SE IMPRIMEN
			print("<table align='center'>
					<tr>
				<th colspan=3  class='BorderInf'>DATOS DEL USUARIO</th>
					</tr>");

		global $row; 
		while ($row = mysqli_fetch_assoc($vertodosQry)) {

	if(isset($_POST['feed'])){
		$trFeed = "<tr>
						<td style='text-align:right !important;'>DELETE: </td>
						<td style='text-align:left !important;'>".$row['delete']."</td>
					</tr>";
	}else{ $trFeed = ""; }

		print(" <tr>
					<td style='text-align:right !important; width:120px;' >NIVEL:</td>
					<td style='text-align:left !important; width:110px;' >".$row['Nivel']."</td>
					<td rowspan='5' style='text-align:center !important;'>
			<img src='../img/imgCliente/".$row['img']."' height='120px' width='90px' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>NOMBRE: </td>
					<td style='text-align:left !important;'>".$row['Nombre']."</td>
				</tr>				
				<tr>
					<td style='text-align:right !important;'>APELLIDOS: </td>
					<td style='text-align:left !important;'>".$row['Apellidos']."</td>
				</tr>				
				<tr>
					<td style='text-align:right !important;'>DNI: </td>
					<td style='text-align:left !important;'>".$row['dni'].$row['ldni']."</td>
				</tr>				
				<tr>
					<td style='text-align:right !important;'>EMAIL: </td>
					<td style='text-align:left !important;'>".$row['Email']."</td>
				</tr>				
				<tr>
					<td style='text-align:right !important;'>FECHA NACIMIENTO: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['DateNac']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>TELEFONO: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['Tlf']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>USUARIO: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['Usuario']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>PASSWORD: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['Pass']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>DIRECCION: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['Direccion']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>FECHA REGISTRO: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['datereg']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>LAST IN: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['lastin']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>LAST OUT: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['lastout']."</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>ACCESOS: </td>
					<td style='text-align:left !important;' colspan='2'>".$row['visitadmin']."</td>
				</tr>".$trFeed."");
			}
		print("<tr>
			<td colspan=3 align='right' class='BorderSup'>
				<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
					<input type='submit' value='CERRAR VENTANA' class='botonRojo' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>
		</tr>
	</table>"); 

			}

	} 

	} // FIN FUNCTION process_form()
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){

	//unset($_SESSION['tablas']);

	if((!isset($_SESSION['tablas']))||(@$_SESSION['tablas'] == '')||(@$_SESSION['tablas'] != $_POST['dni'])){ 
		$_SESSION['tablas'] = $_POST['dni']; 
	}else{ }
	//print("* ".$_SESSION['tablas'].".</br>");

	global $ruta;
	$ruta ="userlog/";
	//print("RUTA: ".$ruta.".</br>");
	
	global $rutag;
	//$rutag = "../userlog/{*}";
	$rutag = "userlog/{*_".$_SESSION['tablas'].".log}";
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

		for($i = 0; $i < $num; $i++){
			$nomFiles = str_replace('userlog/','',$arrFiles[$i]);

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
			<td class='BorderInf'>".strtoupper($nomFiles)."</td>
			");
		} // FIN DEL WHILE
	} // FIN ELSE

	closedir($directorio);

	print("<tr>
	<td colspan=3 align='center' class='BorderSup'>
		<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
			<input type='submit' value='CERRAR VENTANA' class='botonRojo' />
			<input type='hidden' name='oculto2' value=1 />
		</form>
	</td></tr></table>");

	} // FIN FUNCTION listfiles()


	function delete(){ unlink($_POST['ruta']); }


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    require "inclu/footer.php"

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>

<?php
session_start();
 
	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Inclu/webmaster.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	global $ruta;
	$ruta = "../";
	global $rutacam;
	$rutacam = "";
	//DEFINE LA RUTA DE REDIR() Y DE CANCEL
	global $docname;
	$docname = "cam/indexcam.php"; // AL INDEX CAMARA SCANNER
	//$docname = "Admin/Admin_Ver.php";// AL RESUMEN DE USUARIOS REGISTRADOS

 if(isset($_GET['pin'])){

	require $rutacam.'consultaqr.php';

		if (($rowu['Nivel'] == 'admin') || ($rowu['Nivel'] == 'plus') || ($rowu['Nivel'] == 'user')){ 

				process_pinqr(); 
				
		} elseif (($rowu['Nivel'] == 'close')) {
											print("<table style=\"margin-top:20px; margin-buttom:20px;\">
														<tr><td style='text-align:center'>
															<font color='#FF0000'>
																** USUARIO BLOQUEADO POR EL WEBMASTER **
															</font><br/>
														</td></tr> 
													</table>");
											require $rutacam.'redir.php';
							} else { require $ruta.'Inclu/table_permisos.php';
									 require $rutacam.'redir.php';
										}
	
	
	} else { require $ruta.'Inclu/table_permisos.php';
			 require $rutacam.'redir.php';
				}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_pinqr(){
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $rutacam;
	require $rutacam.'consultaqr.php';
	
	$_SESSION['usuarios'] = strtolower($rowu['ref']);
	
	if ($contu> 0){
	
	global $rutacam;
	require $rutacam.'table_data.php';
		
	}else{
		
		global $rutacam;
		require $rutacam.'table_lost.php';

	 		}	

	require $rutacam.'redir.php';

	} // FIN FUNCTION 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>

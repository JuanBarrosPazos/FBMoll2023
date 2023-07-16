<?php

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
												
			show_form($form_errors);
										
		} else {print("<table align='center' style=\"margin-top:20px\">
							<tr>
								<td>
									<font color='#0080C0'>
										SE HA PROCESADO SU PETICION CORRECTAMENTE.
									</font>
								</td>
							</tr>
							<tr>
								<td>
									<font color='#0080C0'>
										PULSE ENVIAR PARA RECIBIR SUS DATOS VIA MAIL.
									</font>
								</td>
							</tr>
						</table>");
											
				process_form();
							}
					}	/* Fin del if $_POST['oculto']*/
			
			elseif(isset($_POST['oculto2'])){	
				process_Mail();
				unset($_SESSION['']);
			} else { show_form(); }

?>
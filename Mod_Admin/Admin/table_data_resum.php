<?php
        global $rf;
        if ($rf == ''){$rf = $_POST['ref'];}
		elseif (isset($_SESSION['refcl'])){$rf = $_SESSION['refcl'];}
        else { }
		global $pass;
        if (!isset($_POST['Pass'])){ $pass = $_POST['Password'];}
        else { $pass = $_POST['Pass'];}
 
        print(" <tr>
					<td style='text-align:right !important; width:120px;' >Nombre:</td>
					<td style='text-align:left !important; width:110px;' >".$_POST['Nombre']."</td>
					<td rowspan='5' style='text-align:center !important;'>
						<img ".$rutaimg." height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Apellidos: </td>
					<td style='text-align:left !important;'>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Documento: </td>
					<td style='text-align:left !important;'>".$_POST['doc']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>N&uacute;mero: </td>
					<td style='text-align:left !important;'>".$_POST['dni']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Control: </td>
					<td style='text-align:left !important;'>".$_POST['ldni']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Mail: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Nivel: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Nivel']."</td>
				</tr>");
				
		if (isset($vertabla)){ }
		elseif (!isset($vertabla)){		
		print("	<tr>
					<td style='text-align:right !important;'>Ref Usuario: </td>
					<td style='text-align:left !important;' colspan='2'>".$rf."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Usuario: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Password: </td>
					<td style='text-align:left !important;' colspan='2'>".$pass."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Pais: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Teléfono 1: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Teléfono 2: </td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['Tlf2']."</td>
				</tr>");
		}
?>
<?php

	mysqli_report(MYSQLI_REPORT_OFF);
	global $db;

	/* VERIFICO LAS TABLAS CON LA CLAVE EN LA BBDD */

	/* DETECTO TODAS LAS TABLAS EN LA BBDD */
	global $tablas;
    $tablas = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '%'";
    $result = mysqli_query($db, $tablas);
	global $infoTBbdd;
	global $totTablas;
	if(!$result){
			$infoTBbdd = "<p>ERROR LINEA 10: ".mysqli_error($db)."</p>";
	}else{
			$totTablas = mysqli_num_rows($result);
			$infoTBbdd = "<p>TABLAS EN LA BASE DE DATOS: ".$totTablas."</p>"; 
		}
	/* FIN DETECTO TODAS LAS TABLAS EN LA BBDD */

	/* DETECTO LAS TABLAS CON CLAVE EN LA BBDD */

        global $table_name;
        $table_name = $_SESSION['clave'];

		global $sqltcl;
		$sqltcl = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME LIKE '$table_name%' ";
		global $querycl;
		$querycl = mysqli_query($db, $sqltcl);
		global $countcl;
		global $infoTClave;
		if(!$querycl){
			$infoTClave = "<p>ERROR LINEA 24: ".mysqli_error($db)."</p>";
		}else{
			$countcl= mysqli_num_rows($querycl);
			$infoTClave = "<p>TABLAS EN BBDD CON CLAVE: ".$_SESSION['clave'].": ".$countcl."</p>";
		}

?>
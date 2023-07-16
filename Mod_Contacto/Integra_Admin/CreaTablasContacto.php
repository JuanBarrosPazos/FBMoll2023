<?php

	global $db;       global $db_host;        global $db_user;        global $db_pass;
	global $db_name;  global $dbconecterror;
	
	/************** CREAMOS LA TABLA CONTACTO ***************/
 
	global $table_name_cc;
	$table_name_cc = "`".$_SESSION['clave']."contacto`"; 
 
	$contacto = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_cc (
  `id` int(4) NOT NULL auto_increment, /* `dni_cliente` int(8) */
  `dni_cliente` int(8) collate utf8_spanish2_ci NOT NULL DEFAULT '99999999', /* DNI ANONIMO 99999999 */
  `nombre` varchar(25) collate utf8_spanish2_ci NOT NULL, 
  `apellido` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `mail` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `telf`int(9) NOT NULL default '0',
  `interes` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `nComen` int(2) collate utf8_spanish2_ci NOT NULL,
  `nMesas` int(2) collate utf8_spanish2_ci NOT NULL,
  `fecha` date collate utf8_spanish2_ci NOT NULL DEFAULT '2021-12-20',
  `hora` time collate utf8_spanish2_ci NOT NULL DEFAULT '00:00:00',
  `coment` varchar(250) collate utf8_spanish2_ci NOT NULL,
  `leido` varchar(2) collate utf8_spanish2_ci NOT NULL default 'n',
  `confirmado` varchar(4) collate utf8_spanish2_ci NOT NULL default 'n',
  `leeme` text(500) collate utf8_spanish2_ci NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $contacto)){
					global $tc1;
					$tc1 = "\t* OK TABLA CONTACTO.".PHP_EOL;
		} else { global $tc1;
				  $tc1 = "\t* L.15 NO OK TABLA CONTACTO. ".mysqli_error($db).PHP_EOL;
			        }

	/************* CREAMOS LA TABLA FEEDBACK CONTACTO ****************/

	global $table_name_fc;
	$table_name_fc = "`".$_SESSION['clave']."contactofeed`";

	$contactofeed = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_fc (
  `id` int(4) NOT NULL auto_increment,
  `dni_cliente` int(8) collate utf8_spanish2_ci NOT NULL DEFAULT '99999999', /* DNI ANONIMO 99999999 */
  `nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `apellido` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `mail` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `telf`int(9) NOT NULL default '0',
  `interes` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `nComen` int(2) collate utf8_spanish2_ci NOT NULL,
  `nMesas` int(2) collate utf8_spanish2_ci NOT NULL,
  `fecha` date collate utf8_spanish2_ci NOT NULL DEFAULT '2021-12-20',
  `hora` time collate utf8_spanish2_ci NOT NULL DEFAULT '00:00:00',
  `coment` varchar(250) collate utf8_spanish2_ci NOT NULL,
  `leido` varchar(2) collate utf8_spanish2_ci NOT NULL default 'n',
  `confirmado` varchar(4) collate utf8_spanish2_ci NOT NULL default 'n',
  `leeme` text(500) collate utf8_spanish2_ci NULL,
  `borrado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	UNIQUE KEY `id` (`id`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db, $contactofeed)){
						  global $tc2;
						  $tc2 = "\t* OK TABLA FEEDBACK.".PHP_EOL;
			} else { global $tc;
					 $tc2 = "\t* L.46 NO OK TABLA FEEDBACK. ".mysqli_error($db).PHP_EOL;
                       }

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
    global $tablasContactoLog;
    $tablasContactoLog = $tc1.$tc2;

?>
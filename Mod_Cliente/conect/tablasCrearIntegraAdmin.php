<?php

        global $db;         global $db_host;    global $db_user;
        global $db_pass;    global $db_name;    global $dbconecterror;
        global $key;
        
        /************** DEFINO VARIABLES PARA LA TABLA CLIENTE ***************/

        global $table_name_c;
        $table_name_c = "`".$_SESSION['clave']."cliente`";

        /************** DEFINO VARIABLES PARA LA TABLA CLIENTE FEEDBACK ***************/

        global $table_name_cf;
        $table_name_cf = "`".$_SESSION['clave']."clientefeed`";
        
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  /////////////////// 

        /************** CREAMOS LA TABLA CLIENTE ***************/
        // ANTES QUE CONTACTO POR LA CLAVE FORANEA lpr_cliente

        $cliente = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_c (
        `id_cliente` int(4) NOT NULL auto_increment,
        /*`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,*/
        `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL DEFAULT 'cliente',
        `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
        `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
        /*`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',*/
        /*`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,*/
        `dni` int(8) collate utf8_spanish2_ci NOT NULL, /* USO EL DNI COMO REFERENCIA DEL CLIENTE */
        `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
        `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
        `DateNac` date collate utf8_spanish2_ci NULL,
        `Tlf` int(9) NOT NULL DEFAULT '666888999',
        /*`Tlf2` int(9) NOT NULL DEFAULT '0',*/
        `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
        /*`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,*/
        `Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
        `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
        `img` varchar(20) collate utf8_spanish2_ci NOT NULL DEFAULT 'default.png', 
        `datereg` datetime collate utf8_spanish2_ci NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `lastin` datetime collate utf8_spanish2_ci NOT NULL DEFAULT '1212-12-12 00:00:00',
        `lastout` datetime collate utf8_spanish2_ci NOT NULL DEFAULT '1212-12-12 00:00:00',
        `visitadmin` int(4) collate utf8_spanish2_ci NOT NULL DEFAULT '0',
        UNIQUE KEY `id_cliente` (`id_cliente`),
        PRIMARY KEY (`id_cliente`),
        /*UNIQUE KEY `ref` (`ref`),*/
        UNIQUE KEY `dni` (`dni`),
        UNIQUE KEY `Email` (`Email`),
        UNIQUE KEY `Usuario` (`Usuario`),
        UNIQUE KEY `Pass` (`Pass`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
        
        global $tclienteLog;    global $clDat;      global $tableClDatLog;
        
        if(mysqli_query($db , $cliente)){
        //echo "<p>TABLA CLIENTE CREADA CORRECTAMENTE</p>";
        $tclienteLog = "\t* OK TABLA CLIENTE.".PHP_EOL;
        $key = 0;
        
        $clDat = "INSERT INTO `$db_name`.$table_name_c (`id_cliente`, `Nivel`, `Nombre`, `Apellidos`, `dni`, `ldni`, `Email`, `DateNac`, `Tlf`, `Usuario`, `Pass`, `Direccion` ) VALUES (1, 'admin', 'Juan', 'Barros', 55555555, 'K', 'juanbarrospazos@hotmail.es', '1966-05-16', 654639155, 'JuanBarros', 'MariaPazos', 'Palma de Mallorca'),(2, 'cliente', 'Anonimo', 'Anonimo', 99999999, 'Z', 'noreply@noreply.es', '1966-05-16', 654639155, '4n0n1m0', '4n0n1m0', 'Palma de Mallorca')";
            if(mysqli_query($db, $clDat)){
                //echo "<p>INSERTADOS LOS DATOS EN LA TABLA CLIENTE</p>";
                $tableClDatLog = "\t* OK INIT VALUES EN TABLA CLIENTE.".PHP_EOL;
                $key = 0;
            } else { 
                echo "<p>L.63 ERROR AL INSERTAR DATOS EN TABLA CLIENTE".mysqli_error($db)."</p>";
                $tableClDatLog = "\t* L.94 NO OK INIT VALUES EN TABLA CLIENTE. ".mysqli_error($db).PHP_EOL;
                $key = 1;
                    }
        } else {
            echo "<p>L.24 TABLA CLIENTE ERROR: ".mysqli_error($db)."</p>";
            $tclienteLog = "\t* L.56 NO OK TABLA CLIENTE. ".mysqli_error($db).PHP_EOL;
            $key = 1;
                }

        /************** CREAMOS LA TABLA CLIENTE FEEDBACK ***************/
        // ANTES QUE CONTACTO POR LA CLAVE FORANEA lpr_clientefeed

        $clienteFeed = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_cf (
            `id_cliente` int(4) NOT NULL auto_increment,
            /*`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,*/
            `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL DEFAULT 'cliente',
            `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
            `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
            /*`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',*/
            /*`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,*/
            `dni` int(8) collate utf8_spanish2_ci NOT NULL, /* USO EL DNI COMO REFERENCIA DEL CLIENTE */
            `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
            `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
            `DateNac` date collate utf8_spanish2_ci NULL,
            `Tlf` int(9) NOT NULL DEFAULT '666888999',
            /*`Tlf2` int(9) NOT NULL DEFAULT '0',*/
            `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
            /*`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,*/
            `Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
            `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
            `img` varchar(20) collate utf8_spanish2_ci NOT NULL DEFAULT 'default.png',
            `datereg` datetime collate utf8_spanish2_ci NOT NULL,
            `delete` datetime collate utf8_spanish2_ci NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `lastin` datetime collate utf8_spanish2_ci NOT NULL DEFAULT '1212-12-12 00:00:00',
            `lastout` datetime collate utf8_spanish2_ci NOT NULL DEFAULT '1212-12-12 00:00:00',
            `visitadmin` int(4) collate utf8_spanish2_ci NOT NULL DEFAULT '0',
            UNIQUE KEY `id_cliente` (`id_cliente`),
            PRIMARY KEY (`id_cliente`),
            /*UNIQUE KEY `ref` (`ref`),*/
            UNIQUE KEY `dni` (`dni`),
            UNIQUE KEY `Email` (`Email`),
            UNIQUE KEY `Usuario` (`Usuario`),
            UNIQUE KEY `Pass` (`Pass`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
 
        global $tclienteFeedLog;
        
        if(mysqli_query($db , $clienteFeed)){
            //echo "<p>TABLA CLIENTE FEEDBACK CREADA CORRECTAMENTE</p>";
            $tclienteFeedLog = "\t* OK TABLA CLIENTE FEEDBACK.".PHP_EOL;
            $key = 0;
        } else {
            echo "<p>L.82 TABLA CLIENTE FEEDBACK ERROR: ".mysqli_error($db)."</p>";
            $tclienteFeedLog = "\t* L.113 NO OK TABLA CLIENTE FEEDBACK. ".mysqli_error($db).PHP_EOL;
            $key = 1;
                }


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

        /************	PASAMOS LOS PARAMETROS A .LOG	*****************/

    global $tablasClienteLog;
    $tablasClienteLog = $tclienteLog.$tableClDatLog.$tclienteFeedLog;


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>
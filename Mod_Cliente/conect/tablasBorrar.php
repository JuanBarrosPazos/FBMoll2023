<?php

        global $db;         global $db_host;    global $db_user;
        global $db_pass;    global $db_name;    global $dbconecterror;
        global $key;
        
        /************** DEFINO VARIABLES PARA LA TABLA CLIENTE ***************/

        global $table_name_c;
        //$table_name_c = "`".$_SESSION['clave']."cliente`";
        $table_name_c = "`lpr_cliente`";
        
        /************** DEFINO VARIABLES PARA LA TABLA CLIENTE FEEDBACK ***************/

        global $table_name_cf;
        //$table_name_c = "`".$_SESSION['clave']."cliente`";
        $table_name_cf = "`lpr_clientefeed`";
        
        /************** DEFINO VARIABLES PARA LA TABLA CONTACTO ***************/
        
        global $table_name_a;
        //$table_name_a = "`".$_SESSION['clave']."contacto`";
        $table_name_a = "`lpr_contacto`";

        /************** DEFINO VARIABLES PARA LA TABLA RESERVAS ***************/
        
        global $table_name_r;
        //$table_name_r = "`".$_SESSION['clave']."reserva`";
        $table_name_r = "`lpr_reserva`";

        /************** DEFINO VARIABLES PARA LA TABLA FACTURAS ***************/
        
        global $table_name_f;
        //$table_name_f = "`".$_SESSION['clave']."factura`";
        $table_name_f = "`lpr_factura`";

        /************** DEFINO VARIABLES PARA LA TABLA FORMA DE PAGO ***************/
        
        global $table_name_fp;
        //$table_name_fp = "`".$_SESSION['clave']."formpago`";
        $table_name_fp = "`lpr_formpago`";

        /************** DEFINO VARIABLES PARA LA TABLA ESTADO DEL PAGO ***************/
        
        global $table_name_sp;
        //$table_name_sp = "`".$_SESSION['clave']."estadopago`";
        $table_name_sp = "`lpr_estadopago`";

		  ////////////////////		  ////////////////////
////////////////////		////////////////////		////////////////////
	        ////////////////////		///////////////////

        // BORRAMOS ANTES POR LAS CLAVES FORANEAS

        /************** BORRAMOS LA TABLA FACTURAS ***************/
        global $dropFactura;
        $dropFactura = "DROP TABLE IF EXISTS `$db_name`.$table_name_f";
        global $dropFacturaLog;
        if(mysqli_query($db , $dropFactura)){ 
        echo "<p>BORRADA TABLA FACTURA</p>";
        $dropFacturaLog = "\t* BORRADA TABLA FACTURA.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA FACTURA</p>";
        $dropFacturaLog = "\t* NO BORRADA TABLA FACTURA.".PHP_EOL;
        }


		  ////////////////////		  ////////////////////
////////////////////		////////////////////		////////////////////
	        ////////////////////		///////////////////


        /************** BORRAMOS LA TABLA FORMA DE PAGO ***************/
        global $dropFormaPago;
        $dropFormaPago = "DROP TABLE IF EXISTS `$db_name`.$table_name_fp";
        global $dropFormaPagoLog;
        if(mysqli_query($db , $dropFormaPago)){ 
        echo "<p>BORRADA TABLA FORMA PAGO</p>";
        $dropFormaPagoLog = "\t* BORRADA TABLA FORMA PAGO.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA FORMA PAGO</p>";
        $dropFormaPagoLog = "\t* L.75 NO BORRADA TABLA FORMA PAGO.".PHP_EOL;
        }

        /************** BORRAMOS LA TABLA ESTADO DEL PAGO ***************/
        global $dropEstadoPago;
        $dropEstadoPago = "DROP TABLE IF EXISTS `$db_name`.$table_name_sp";
        global $dropFormaPagoLog;
        if(mysqli_query($db , $dropEstadoPago)){ 
        echo "<p>BORRADA TABLA ESTADO PAGO</p>";
        $dropEstadoPagoLog = "\t* BORRADA TABLA ESTADO PAGO.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA ESTADO PAGO</p>";
        $dropEstadoPagoLog = "\t* L.87 NO BORRADA TABLA ESTADO PAGO.".PHP_EOL;
        }

        /************** BORRAMOS LA TABLA RESERVAS ***************/
        global $dropReserva;
        $dropReserva = "DROP TABLE IF EXISTS `$db_name`.$table_name_r";
        global $dropReservaLog;
        if(mysqli_query($db , $dropReserva)){ 
        echo "<p>BORRADA TABLA RESERVA</p>";
        $dropReservaLog = "\t* BORRADA TABLA RESERVA.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA RESERVA</p>";
        $dropReservaLog = "\t* L.99 NO BORRADA TABLA RESERVA.".PHP_EOL;
        }

        /************** BORRAMOS LA TABLA CONTACTO ***************/
        global $dropContacto;
        $dropContacto = "DROP TABLE IF EXISTS `$db_name`.$table_name_a";
        global $dropContactoLog;
        if(mysqli_query($db , $dropContacto)){ 
        echo "<p>BORRADA TABLA CONTACTO</p>";
        $dropContactoLog = "\t* BORRADA TABLA CONTACTO.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA CONTACTO</p>";
        $dropContactoLog = "\t* L.111 NO BORRADA TABLA CONTACTO.".PHP_EOL;
        }
        
        /************** BORRAMOS LA TABLA CLIENTE ***************/
        global $dropCliente;
        $dropCliente = "DROP TABLE IF EXISTS `$db_name`.$table_name_c";
        global $dropClienteLog;
        if(mysqli_query($db , $dropCliente)){ 
        echo "<p>BORRADA TABLA CLIENTE</p>";
        $dropClienteLog = "\t* BORRADA TABLA CLIENTE.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA CLIENTE</p>";
        $dropClienteLog = "\t* L.123 NO BORRADA TABLA CLIENTE.".PHP_EOL;
        }

        /************** BORRAMOS LA TABLA CLIENTE FEEDBACK ***************/
        global $dropClienteFeed;
        $dropClienteFeed = "DROP TABLE IF EXISTS `$db_name`.$table_name_cf";
        global $dropClienteFeedLog;
        if(mysqli_query($db , $dropClienteFeed)){ 
        echo "<p>BORRADA TABLA CLIENTE FEEDBACK</p>";
        $dropClienteFeedLog = "\t* BORRADA TABLA CLIENTE FEEDBACK.".PHP_EOL;
        }else{
        echo "<p>NO BORRADA TABLA CLIENTE FEEDBACK</p>";
        $dropClienteFeedLog = "\t* L.135 NO BORRADA TABLA CLIENTE FEEDBACK.".PHP_EOL;
        }

		  ////////////////////		  ////////////////////
////////////////////		////////////////////		////////////////////
	        ////////////////////		///////////////////

        /************	PASAMOS LOS PARAMETROS A .LOG	*****************/

    global $tablasBorrarLog;
    $tablasBorrarLog = $dropFacturaLog.$dropFormaPagoLog.$dropEstadoPagoLog.$dropReservaLog.$dropContactoLog.$dropClienteLog.$dropClienteFeedLog;

    $ActionTime = date('H:i:s');
    $logdate = date('Y-m-d');

    $logtext = "** ".$ActionTime.PHP_EOL.$tablasBorrarLog.PHP_EOL;
    $filename = "log/ini_log_".$logdate.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);
 
		  ////////////////////		  ////////////////////
////////////////////		////////////////////		////////////////////
	        ////////////////////		///////////////////

?>
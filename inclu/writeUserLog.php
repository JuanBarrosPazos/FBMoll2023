<?php

    global $ActionTime;
    $ActionTime = date('H:i:s');
    global $logdate;
    $logdate = date('Y-m-d');

    global $logtext;
    $logtext = "** ".$ActionTime.PHP_EOL.$UserActionLog.PHP_EOL;

    global $filename;
    global $fileDir;
    if(isset($_SESSION['contacto'])){
        $fileDir = "Mod_Contacto/contactolog/";
    }else{
        $fileDir = "Mod_cliente/userlog/";
    }
    if(isset($_SESSION['nivel'])){
            $filename = $fileDir.$logdate."_".$_SESSION['dni_cliente'].".log";
            unset($_SESSION['LogTemp']);
            //unset($_SESSION['contacto']);
    }
    elseif(isset($_SESSION['LogTemp'])){
        $filename = $fileDir.$logdate."_".$_SESSION['LogTemp'].".log";
    }else{
        $filename = "log/sislog/".$logdate.".log";
        unset($_SESSION['LogTemp']);
        //unset($_SESSION['contacto']);
    }

    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

?>
<?php

    global $ActionTime;
    $ActionTime = date('H:i:s');
    global $logdate;
    $logdate = date('Y-m-d');

    global $logtext;
    $logtext = "** ".$ActionTime.PHP_EOL.$UserActionLog.PHP_EOL;

    global $filename;
    if((isset($_SESSION['nivel']))||(isset($_SESSION['Nivel']))){
            $filename = "userlog/".$logdate."_".$_POST['dni'].".log";
    }else{
        $filename = "../log/sislog/".$logdate.".log";
    }

    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

?>
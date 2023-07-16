<?php
session_start();

    global $ruta;
    $ruta = "";
    require "inclu/head.php";

?>

    <script src="miJs/comentCount.js"></script>

    <div style="text-align: center !important; margin: 7.6em auto 7.6em auto;">
        <button class="btn btn-sm btn-primary" id="btnAgregar">AGREGAR CONTACTO!</button>
        <button class="btn btn-sm btn-primary" id="vertodos"><a href="index(InitRaizOk).php" style="color:#ccc; text-decoration:none;">VER MENSAJES</a></button>
    </div> <!-- FIN CONTAINER -->

<?php
    require "www/formContacto.php";
?> 

    <script>
        var rut = "www/";
    </script>
    <script src="miJS/datos.js"></script>


<?php

    require "inclu/footer.php"

?>
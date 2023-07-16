<?php

    global $ruta;
    $ruta = "../";
    global $key;
    $key = 1;
    global $titulo;
    $titulo = "LA PERLA NOSOTROS";

    global $menuLinks;
    $menuLinks = '<a href="../index.php"><button class="botonVerde">INCIO</button></a>
                  <a href="carta.php"><button class="botonVerde">CARTA</button></a>
                  <a href="vinos.php"><button class="botonVerde">VINOS</button></a>
                  <a href="donde.php"><button class="botonVerde">DONDE</button></a>
                  <a href="contacto.php"><button class="botonVerde">CONTACTO</button></a>';

    require '../inclu/header.php';

    require '../inclu/cuerpoSomos.php';

    require '../inclu/footer.php';

?>

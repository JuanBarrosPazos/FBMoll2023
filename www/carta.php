
<?php

        global $ruta;
        $ruta = "../";
        global $key;
        $key = 1;
        global $titulo;
        $titulo = "LA PERLA CARTA";
        
        global $menuLinks;
        $menuLinks = '<a href="../index.php"><button class="botonVerde">INCIO</button></a>
                      <a href="vinos.php"><button class="botonVerde">VINOS</button></a>
                      <a href="donde.php"><button class="botonVerde">DONDE</button></a>
                      <a href="contacto.php"><button class="botonVerde">CONTACTO</button></a>
                      <a href="somos.php"><button class="botonVerde">NOSOTROS</button></a>';
    

        require '../inclu/header.php';

        require '../inclu/cuerpoCarta.php';

        require '../inclu/footer.php';

?>



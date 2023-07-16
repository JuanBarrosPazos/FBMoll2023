<?php
  session_start();

  global $footer;
  $footer = "<div style='text-align: center;'>
                <a style='text-decoration: none;' href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
                            &copy; Juan Barr&oacute;s Pazos 2021 - 2023.
                </a>
            </div>";

  if(isset($_SESSION['Nivel'])){

    if ((@$_SESSION['Nivel'] == 'admin') || (@$_SESSION['Nivel'] == 'plus')){
                        
            //error_reporting (0);
            require "indexPlay.php";

        }else{
            //error_reporting (0);
            require 'table_permisos.php';
            echo $footer;
        }

    }else{
            require 'table_permisos.php';
            echo $footer;
    }


?>
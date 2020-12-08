<?php

    spl_autoload_register(function($clase){ 
        //Quitamos el namespace del nombre de la Clase
        $clase = strstr($clase,"\\");
        $clase = substr($clase,1,strlen($clase));

        $ruta = "Models/$clase.php";      
        if (file_exists($ruta)){     
            include_once $ruta;
        }
        $ruta = "Views/$clase.php";   
        if (file_exists($ruta)){     
            include_once $ruta;
        }  
        $ruta = "../Models/$clase.php";      
        if (file_exists($ruta)){     
            include_once $ruta;
        }
        $ruta = "../Views/$clase.php";   
        if (file_exists($ruta)){     
            include_once $ruta;
        }  


    });

?>
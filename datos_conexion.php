<?php

        /*
        #Conexion por procedimiento
        $db_host="localhost";//direccion del servidor de base de datos mysql
        $db_nombre="prueba";
        $db_usuario="root";
        $db_contra="705715";
        */

        #CON PDO
        try{
                $base=new PDO('mysql:host=localhost;dbname=PRUEBA_REGISTROS','root','705715');

                #Atributos
                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                #Caracteres utilizados
                $base->exec("SET CHARACTER SET UTF8");

        }catch(Exception $e){
                #En caso de error
                die('Error'. $e->getMessage());
                echo "Linea del error ". $e->getLine();
        }

?>
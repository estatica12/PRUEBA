<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    #require("datos_conexion_prueba.php");
    include("datos_conexion.php");
    $data = json_decode(file_get_contents("https://weblogin.muninqn.gov.ar/api/Examen"), true);



    #TABLA CREADA USANDO PDO
    $base->query("CREATE TABLE REGISTROS (ID INTEGER PRIMARY KEY, DNI INTEGER UNIQUE,NOMBRE VARCHAR(20) ,APELLIDO VARCHAR(20) ,GENERO VARCHAR(15), EDAD TINYINT,LEGAJO INTEGER UNIQUE, CURSO_A VARCHAR(20), DESCRIP_A VARCHAR(100), MOD_A VARCHAR(12),CURSO_B VARCHAR(20), DESCRIP_B VARCHAR(100), MOD_B VARCHAR(12))");
    #exit();

    $datos_persona = array();
    #Ultima actualizacion de recorrido
    $cant = count($data["value"]);
    for ($i = 0; $i < $cant; $i++) {

        $primero = $data["value"][$i];

        foreach ($primero as $key2 => $value2) {
            foreach ($datos_persona as $key => $value) {

            }
            if ($key2 == "genero" or $key2 == "codigoPostal") {
  
                foreach ($value2 as $key3 => $value3) {
                    if ($key3 == "value") {
             
                        array_push($datos_persona, $value3);
               
                    } else {
                    }
                }
            } else {
        
                #Extraigo de razonSocial el nombre y apellido del usuario
                if ($key2 == "razonSocial") {

                    array_push($datos_persona, strstr($value2, ', ', true));

                    $apellido = explode(", ", $value2);
                    array_push($datos_persona, $apellido[1]);
                }
                #Con la fecha de nacimiento calculo la edad
                else if ($key2 == "fechaNacimiento") {
                    $fechaNac = strstr($value2, "T", true);
                    $fechaActual = date("Y-m-d");
                    $diff_edad = date_diff(date_create($fechaNac), date_create($fechaActual));
                    $edad = $diff_edad->format("%y");

                    array_push($datos_persona, (int)$edad);
                    $val0 = $datos_persona[0];
                    $val1 = $datos_persona[1];
                    $val2 = $datos_persona[3];
                    $val3 = $datos_persona[2];
                    $val4 = $datos_persona[4];
                    $val5 = $datos_persona[5];
                    print_r($datos_persona);

                    $base->query("INSERT INTO REGISTROS (ID, DNI, NOMBRE, APELLIDO, GENERO, EDAD, LEGAJO, CURSO_A, DESCRIP_A, MOD_A, CURSO_B, DESCRIP_B, MOD_B) VALUES ($val0,$val1,'$val2','$val3','$val4',$val5,$val0,'-','-','-','-','-','-')");
                    #Limpio el array para una nueva carga
                    $datos_persona = array();
                } else if ($key2 != "domicilio") {
                    array_push($datos_persona, $value2);
                    $var = strtoupper($key2);
                }

            }
        }
    }


    ?>
</body>

</html>
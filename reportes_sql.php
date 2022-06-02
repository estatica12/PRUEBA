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
    include("datos_conexion.php");
    /**
     * Este archivo contiene el resto de sentencias pedidas sobre consultas SQL.
     */


    #Listar los cursos individuales
    $cursos_indiv = $base->query("SELECT CURSO_A , CURSO_B FROM REGISTROS WHERE MOD_A='INDIVIDUAL' OR MOD_B='INDIVIDUAL' ");
    echo "Salida cursos individuales: <br>";
    foreach ($cursos_indiv as $row) {
        print $row['CURSO_A'] . "<br>";
        print $row['CURSO_B'] . "<br>";
    }
    echo "<br>";
    echo "<br>";

    #Listar los cursos grupales
    $cursos_grupales = $base->query("SELECT CURSO_A , CURSO_B FROM REGISTROS WHERE MOD_A='GRUPAL' OR MOD_B='GRUPAL'");
    echo "Salida cursos grupales: <br>";
    foreach ($cursos_grupales as $row) {
        print $row['CURSO_A'] . "<br>";
        print $row['CURSO_B'] . "<br>";
    }
    echo "<br>";
    echo "<br>";

    #Obtener cantidad de mujeres
    $cant_mujeres = $base->query("SELECT COUNT(GENERO) AS CANT_MUJERES FROM REGISTROS WHERE GENERO='FEMENINO'");

    #Obtener cantidad de hombres
    $cant_hombres = $base->query("SELECT COUNT(GENERO) AS CANT_HOMBRES FROM REGISTROS WHERE GENERO='MASCULINO'");

    #Cantidad de menores de edad
    $cant_menores = $base->query("SELECT COUNT(EDAD) AS CANT_MENORES FROM REGISTROS WHERE EDAD<18");

    #Cantidad de mayores de edad
    $cant_mayores = $base->query("SELECT COUNT(EDAD) AS CANT_MAYORES FROM REGISTROS WHERE EDAD>=18");

    ?>
</body>

</html>
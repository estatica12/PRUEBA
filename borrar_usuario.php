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

    #Capturo la accion de la url
    $id=$_GET["id"];
    #Ejecuto una consulta
    $base->query("DELETE FROM REGISTROS WHERE ID='$id'");

    #Redirijo a index.php
    header("Location:index.php");
    ?>
</body>

</html>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Documento sin título</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

    <h1>ACTUALIZAR</h1>

    <?php

    include("datos_conexion.php");

    if (!isset($_POST["bot_actualizar"])) {

        $id = $_GET["id"];
        $dni = $_GET["dni"];
        $nom = $_GET["nom"];
        $ape = $_GET["ape"];
        $gen = $_GET["gen"];
        $edad = $_GET["edad"];
        $leg = $_GET["leg"];
        $curso_a = $_GET["curso_a"];
        $desc_a = $_GET["desc_a"];
        $mod_a = $_GET["mod_a"];
        $curso_b = $_GET["curso_b"];
        $desc_b = $_GET["desc_b"];
        $mod_b = $_GET["mod_b"];
    } else {
        $id = $_POST["id"];
        $dni = $_POST["dni"];
        $nom = $_POST["nom"];
        $ape = $_POST["ape"];
        $gen = $_POST["gen"];
        $edad = $_POST["edad"];
        $leg = $_POST["leg"];
        $curso_a = $_POST["curso_a"];
        $desc_a = $_POST["desc_a"];
        $mod_a = $_POST["mod_a"];
        $curso_b = $_POST["curso_b"];
        $desc_b = $_POST["desc_b"];
        $mod_b = $_POST["mod_b"];

        $sql = "UPDATE REGISTROS SET ID=:_id, DNI=:_dni, NOMBRE=:_nom, APELLIDO=:_ape, GENERO=:_gen, EDAD=:_edad, LEGAJO=:_leg, CURSO_A=:_curso_a, DESCRIP_A=:_desc_a, MOD_A=:_mod_a, CURSO_B=:_curso_b, DESCRIP_B=:_desc_b, MOD_B=:_mod_b WHERE ID=:_id";

        $resultado = $base->prepare($sql);

        $resultado->execute(array(":_id" => $id, ":_dni" => $dni, ":_nom" => $nom, ":_ape" => $ape, ":_gen" => $gen, ":_edad" => $edad, ":_leg" => $leg, ":_curso_a" => $curso_a, ":_desc_a" => $desc_a, ":_mod_a" => $mod_a, ":_curso_b" => $curso_b, ":_desc_b" => $desc_b, ":_mod_b" => $mod_b));

        header("Location:index.php");
    }
    ?>


    <p>

    </p>
    <p>&nbsp;</p>
    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="25%" border="0" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                </td>
            </tr>
            <tr>
                <td>ID</td>
                <td><label for="id"></label>
                    <input type="text" name="id" id="id" value="<?php echo $id ?>">
                </td>
            </tr>
            <tr>
                <td>DNI</td>
                <td><label for="dni"></label>
                    <input type="text" name="dni" id="dni" value="<?php echo $dni ?>">
                </td>
            </tr>
            <tr>
                <td>NOMBRE</td>
                <td><label for="nom"></label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom ?>">
                </td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><label for="ape"></label>
                    <input type="text" name="ape" id="ape" value="<?php echo $ape ?>">
                </td>
            </tr>
            <tr>
                <td>GENERO</td>
                <td><label for="gen"></label>
                    <input type="text" name="gen" id="gen" value="<?php echo $gen ?>">
                </td>
            </tr>
            <tr>
                <td>EDAD</td>
                <td><label for="edad"></label>
                    <input type="text" name="edad" id="edad" value="<?php echo $edad ?>">
                </td>
            </tr>
            <tr>
                <td>LEGAJO</td>
                <td><label for="leg"></label>
                    <input type="text" name="leg" id="leg" value="<?php echo $leg ?>">
                </td>
            </tr>
            <tr>
                <td>CURSO_A</td>
                <td><label for="curso_a"></label>
                    <input type="text" name="curso_a" id="curso_a" value="<?php echo $curso_a ?>">
                </td>
            </tr>
            <tr>
                <td>DESCRIP_A</td>
                <td><label for="desc_a"></label>
                    <input type="text" name="desc_a" id="desc_a" value="<?php echo $desc_a ?>">
                </td>
            </tr>
            <tr>
                <td>MOD_A</td>
                <td><label for="mod_a"></label>
                    <input type="text" name="mod_a" id="mod_a" value="<?php echo $mod_a ?>">
                </td>
            </tr>
            <tr>
                <td>CURSO_B</td>
                <td><label for="curso_b"></label>
                    <input type="text" name="curso_b" id="curso_b" value="<?php echo $curso_b ?>">
                </td>
            </tr>
            <tr>
                <td>DESCRIP_B</td>
                <td><label for="desc_b"></label>
                    <input type="text" name="desc_b" id="desc_b" value="<?php echo $desc_b ?>">
                </td>
            </tr>
            <tr>
                <td>MOD_B</td>
                <td><label for="mod_b"></label>
                    <input type="text" name="mod_b" id="mod_b" value="<?php echo $mod_b?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
            </tr>
        </table>
    </form>
    <p>&nbsp;</p>
</body>

</html>
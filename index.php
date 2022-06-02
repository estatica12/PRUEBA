<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>CRUD</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">


</head>

<body>
  <?php
  include("datos_conexion.php");

  #$conexion=$base->query("SELECT * FROM REGISTROS");

  #En registros se almacena un array de objetos
  #$registros=$conexion->fetchAll(PDO::FETCH_OBJ);

  $registros = $base->query("SELECT * FROM REGISTROS")->fetchAll(PDO::FETCH_OBJ);


  if (isset($_POST["cr"])) {
    $id = $_POST["id"];
    $dni = $_POST["dni"];
    $nom = strtoupper($_POST["nom"]);
    $ape = strtoupper($_POST["ape"]);
    if ((strtoupper($_POST["genero"]) == "MASCULINO") or (strtoupper($_POST["genero"]) == "FEMENINO")) {
      $gen = strtoupper($_POST["genero"]);
    } else {
      $gen = "-";
    }
    if (0 < $_POST["edad"] and $_POST["edad"] < 120) {
      $edad = $_POST["edad"];
    }
    $leg = $_POST["legajo"];

    $curso_a = strtoupper($_POST["curso_a"]);
    $mod_a = strtoupper($_POST["mod_a"]);
    $descrip_a = strtoupper($_POST["desc_a"]);
    $curso_b = strtoupper($_POST["curso_b"]);
    $mod_b = strtoupper($_POST["mod_b"]);
    $descrip_b = strtoupper($_POST["desc_b"]);

    if (($curso_a == $curso_b) or ($mod_a == $mod_b)) {
      $curso_a = "-";
      $mod_a = "-";
      $curso_b = "-";
      $mod_b = "-";
    } else {
      $cant_a = $base->query("SELECT COUNT($curso_a) FROM REGISTROS WHERE CURSO_A='$curso_a' ");
      #$cant_b = $base->query("SELECT COUNT($curso_b) FROM REGISTROS WHERE CURSO_B='$curso_b' ");
      if ($cant_a != 0) {
        $busco_mod_a = $base->query("SELECT $mod_a FROM REGISTROS WHERE CURSO_A='$curso_a'");
        if ($mod_a == $busco_mod_a) {
          if ($mod_a == "INDIVIDUAL") {
            $mod_b = "GRUPAL";
          } else {
            $mod_b = "INDIVIDUAL";
          }
        } else {
          $mod_a = $busco_mod_a;
          #$curso_a="-";
          #$mod_a="-";
        }
      } else {
        if ($mod_a == "INDIVIDUAL") {
          $mod_b = "GRUPAL";
        } else {
          $mod_b = "INDIVIDUAL";
        }
      }
      $cant_b = $base->query("SELECT COUNT($curso_b) FROM REGISTROS WHERE CURSO_B='$curso_b' ");
      if ($cant_b != 0) {
        $busco_mod_b = $base->query("SELECT $mod_b FROM REGISTROS WHERE CURSO_B='$curso_b'");
        if ($mod_b != $busco_mod_b) {
          $curso_b="-";
          $mod_b="-";
        }
      }
    }

    #---------------------------------------
    #Ejercicios pedidos sobre sentencias SQL
    #Listar los cursos individuales
    $cursos_indiv= $base->query("SELECT CURSO_A , CURSO_B FROM REGISTROS WHERE MOD_A='INDIVIDUAL' OR MOD_B='INDIVIDUAL' ");

    #Listar los cursos grupales
    $cursos_grupales= $base->query("SELECT CURSO_A , CURSO_B FROM REGISTROS WHERE MOD_A='GRUPAL' OR MOD_B='GRUPAL'");

    #Obtener cantidad de mujeres
    $cant_mujeres= $base->query("SELECT COUNT(GENERO) AS CANT_MUJERES FROM REGISTROS WHERE GENERO='FEMENINO'");

    #Obtener cantidad de hombres
    $cant_hombres= $base->query("SELECT COUNT(GENERO) AS CANT_HOMBRES FROM REGISTROS WHERE GENERO='MASCULINO'");

    #Cantidad de menores de edad
    $cant_menores= $base->query("SELECT COUNT(EDAD) AS CANT_MENORES FROM REGISTROS WHERE EDAD<18");

    #Cantidad de mayores de edad
    $cant_mayores= $base->query("SELECT COUNT(EDAD) AS CANT_MAYORES FROM REGISTROS WHERE EDAD>=18");
    #-----------------------------------------------------


    $sql = "INSERT INTO REGISTROS (ID,DNI,NOMBRE,APELLIDO,GENERO,EDAD,LEGAJO,CURSO_A,DESCRIP_A,MOD_A,CURSO_B,DESCRIP_B,MOD_B) VALUES (:id,:dni,:nom,:ape,:gen,:edad,:leg,:curso_a,:descrip_a,:mod_a,:curso_b,:descrip_b,:mod_b)";

    $resultado = $base->prepare($sql);

    $resultado->execute(array(":id" => $id, ":dni" => $dni, ":nom" => $nom, ":ape" => $ape, ":gen" => $gen, ":edad" => $edad, ":leg" => $leg, ":curso_a" => $curso_a, ":descrip_a" => $descrip_a, ":mod_a" => $mod_a, ":curso_b" => $curso_b, ":descrip_b" => $descrip_b, ":mod_b" => $mod_b));

    header("Location:index.php");
  }

  ?>

  <h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

    <table width="50%" border="0" align="center">
      <tr>
        <td class="primera_fila">ID</td>
        <td class="primera_fila">DNI</td>
        <td class="primera_fila">NOMBRE</td>
        <td class="primera_fila">APELLIDO</td>
        <td class="primera_fila">GENERO</td>
        <td class="primera_fila">EDAD</td>
        <td class="primera_fila">LEGAJO</td>
        <td class="primera_fila">CURSO_A</td>
        <td class="primera_fila">DESCRIP_A</td>
        <td class="primera_fila">MOD_A</td>
        <td class="primera_fila">CURSO_B</td>
        <td class="primera_fila">DESCRIP_B</td>
        <td class="primera_fila">MOD_B</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
        <td class="sin">&nbsp;</td>
      </tr>


      <?php
      foreach ($registros as $persona) : ?>
        <tr>
          <td><?php echo $persona->ID ?></td>
          <td><?php echo $persona->DNI ?></td>
          <td><?php echo $persona->NOMBRE ?></td>
          <td><?php echo $persona->APELLIDO ?></td>
          <td><?php echo $persona->GENERO ?></td>
          <td><?php echo $persona->EDAD ?></td>
          <td><?php echo $persona->LEGAJO ?></td>
          <td><?php echo $persona->CURSO_A ?></td>
          <td><?php echo $persona->DESCRIP_A ?></td>
          <td><?php echo $persona->MOD_A ?></td>
          <td><?php echo $persona->CURSO_B ?></td>
          <td><?php echo $persona->DESCRIP_B ?></td>
          <td><?php echo $persona->MOD_B ?></td>

          <td class="bot"><a href="borrar_usuario.php?id=<?php echo $persona->ID ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
          <td class='bot'><a href="editar_form_prueba.php?id=<?php echo $persona->ID ?> & dni=<?php echo $persona->DNI ?> & nom=<?php echo $persona->NOMBRE ?> & ape=<?php echo $persona->APELLIDO ?> & gen=<?php echo $persona->GENERO ?> & edad=<?php echo $persona->EDAD ?> & leg=<?php echo $persona->LEGAJO ?> & curso_a=<?php echo $persona->CURSO_A ?> & desc_a=<?php echo $persona->DESCRIP_A ?> & mod_a=<?php echo $persona->MOD_A ?> & curso_b=<?php echo $persona->CURSO_B ?> & desc_b=<?php echo $persona->DESCRIP_B ?> & mod_b=<?php echo $persona->MOD_B ?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
        </tr>

      <?php
      endforeach;
      ?>


      <?php #<tr> 
      #<td></td>
      ?>
      <td><input type='text' name='id' size='10' class='centrado'></td>
      <td><input type='text' name='dni' size='10' class='centrado'></td>
      <td><input type='text' name='nom' size='10' class='centrado'></td>
      <td><input type='text' name='ape' size='10' class='centrado'></td>
      <td><input type='text' name='genero' size='10' class='centrado'></td>
      <td><input type='text' name='edad' size='10' class='centrado'></td>
      <td><input type='text' name='legajo' size='10' class='centrado'></td>
      <td><input type='text' name='curso_a' size='10' class='centrado'></td>
      <td><input type='text' name='desc_a' size='10' class='centrado'></td>
      <td><input type='text' name='mod_a' size='10' class='centrado'></td>
      <td><input type='text' name='curso_b' size='10' class='centrado'></td>
      <td><input type='text' name='desc_b' size='10' class='centrado'></td>
      <td><input type='text' name='mod_b' size='10' class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>

</html>
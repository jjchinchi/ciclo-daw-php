<?php 
// Incio de sesión 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog</title>
  <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="estilos.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <style>
   
  </style>
</head>
<body>

    <?php
      // Conexion 
      $conexion = new mysqli('localhost', 'admin_wordpress', 'Hlanz.2018', 'blog_php');
      if ($conexion->connect_error) {
          die('Error de Conexión (' . $conexion->connect_errno . ') '
                  . $conexion->connect_error);
      }
      $conexion->set_charset("utf8");
    ?>
  
  <div class="container">
    <h1 class="display-4 text-center">Artículos del Blog</h1>
    <div class="card-deck">
    <?php 
    if ($resultado = $conexion->query("SELECT * from posts")) {

      while($row = $resultado->fetch_array()) { ?>
      <?php //print_r($row); ?>
      
        <div class="card-body">
          <h4 class="card-title"><?php echo $row["titulo"]; ?></h4>
          <p class="card-text"><?php echo $row["texto"]; ?></p>
          <p class="card-text"><small class="text-muted">
            <?php echo "Autor ID: " . $row["autor"] . "<br/>Fecha: " . $row["fecha"]; ?>
          </small></p>
        </div>
      <?php }

      $resultado->free();
      $conexion->close(); 
    }
    ?>
    </div>
  </div>
  
</body>
</html>
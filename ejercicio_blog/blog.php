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
      <?php 
        //print_r($row);
         $id_post = $row['id'];
      ?>
        <!-- texto del post -->
        <div class="card-body">
          <h4 class="card-title"><?php echo $row["titulo"]; ?></h4>
          <p class="card-text"><?php echo $row["texto"]; ?></p>
          <p class="card-text"><small class="text-muted">
            <?php echo "Autor ID: " . $row["autor"] . "<br/>Fecha: " . $row["fecha"]; ?>
          </small></p>
            <!-- formulario de comentarios -->
          <form action="blog.php" method="post" id="comentarios">
            <input type="hidden" name="idPost" value="<?php echo $row["id"]; ?>">
            <div class="form-group" id="autor">
              <label for="autor">Autor:</label>
              <input type="text" class="form-control" name="autor" placeholder="Tu nombre">
            </div>
            <div class="form-group" id="comentario">
              <label for="comentario">Comentario:</label>
              <textarea class="form-control" name="comentario" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          </form>
          <!-- comentarios del post -->
          <?php
          if ($resultado2 = $conexion->query("SELECT * from comentarios where id_post='$id_post'")) {
            if( $resultado2->num_rows > 0 ) {
              echo '<h2>Comentarios:</h2>
                   <div class="card-deck">';
              while($row2 = $resultado2->fetch_array()) { ?>
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Autor: <?php echo $row2["autor"]; ?></h6>
                  <p class="card-text"><?php echo $row2["texto"]; ?></p>
                </div>
              </div>
              <?php
              }
              echo '</div>';
            }
          } 
            ?>
        </div> <!-- card-body -->
      <?php }

      $resultado->free();
      //$conexion->close(); 
    }

    // Almacenar Comentario en la BBDD
      if( isset($_POST["enviar"]) ) {
        $autor = $_POST["autor"];
        $comentario = $_POST["comentario"];
        $fecha = date("d-m-y");
        $idPost = $_POST["idPost"];
        //echo "insert into comentarios values (null,'$idPost','$autor','$comentario')";
        if( $conexion->query("insert into comentarios values (null,'$idPost','$autor','$comentario')") ) {
          echo "<p>Comentario enviado con éxito</p>";
        } else {
          echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
        }
        $conexion->close();
      }
    ?>
    </div> <!-- card-deck -->
  </div> <!-- container -->
  
</body>
</html>
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
  
  <div class="container">
    <h3>Panel de administración</h3>
    <div class="row">
      <div class="col">
        <form action="admin.php" method="post" id="login_form">
            <div class="form-group" id="nombre">
                <label for="Usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Introduce tu usuario">
            </div>
            <div class="form-group" id="pass">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce tu password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Enviar</button>
        </form>
        <a href='blog.php' class='btn btn-primary'>Ver Blog</a> 
      </div>
    <!-- </div> -->

    <?php
      // Conexion 
      $conexion = new mysqli('localhost', 'admin_wordpress', 'Hlanz.2018', 'blog_php');
      if ($conexion->connect_error) {
          die('Error de Conexión (' . $conexion->connect_errno . ') '
                  . $conexion->connect_error);
      }
      $conexion->set_charset("utf8");

      // Chequeo login
        if( isset($_POST["login"]) ) {
        $usuario = $_POST['usuario'];
        $passwd = $_POST['password'];
        if ($resultado = $conexion->query("SELECT * from usuarios where nombre='$usuario'")) {
          $row = $resultado->fetch_array(MYSQLI_ASSOC);
          //print_r($row);
          if ( $row['password']==$passwd ) {
            $_SESSION["usuario"] = $usuario; // Inicio de variable de sesión del usuario
            $_SESSION["id_usuario"] = $row['id'];
          } 
          else {
            echo "<div class='alert alert-danger'>La contraseña y el usuario introducidos no coinciden</div>";
          }
        }
        $resultado->free();
        $conexion->close(); 
      }

    // Formulario de post
    if ( isset($_SESSION["usuario"]) ) {
    ?>
    <!-- <div class="row"> -->
      <div class="col">
        <div class='alert alert-success'>Bienvenido <?php echo strtoupper($_SESSION["usuario"]); ?></div>
        <form action="admin.php" method="post" id="post_form">
          <div class="form-group" id="titulo">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" placeholder="Título del post">
          </div>
          <div class="form-group" id="texto">
            <label for="texto">Texto:</label>
            <textarea class="form-control" name="texto" placeholder="Texto..." rows="10"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="publicar">Publicar</button>
          <button type="submit" class="btn btn-danger" name="logout">Cerrar sesión</button>
        </form>
      </div>
    </div>    
    <?php } ?>

    <?php 
      // Almacenar Post en la BBDD
      if( isset($_POST["publicar"]) ) {
        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];
        $fecha = date("d-m-y");
        $autor = $_SESSION["id_usuario"];
        if( $conexion->query("insert into posts values (null,'$titulo','$texto','$fecha','$autor')") ) {
          echo "<div class='alert alert-success'>Post publicado con éxito</div>";
        } else {
          echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
        }
        $conexion->close(); 
      }
      elseif( isset($_POST["logout"]) ) session_destroy();
    ?>

  </div>
  
</body>
</html>
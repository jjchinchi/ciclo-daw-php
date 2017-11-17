<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Examen PHP - Usuario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
//echo 'usuario: ' . $_SESSION['usuario']; 
  $_SESSION['user_img'] = isset($_POST['user_img']) ? $_POST['user_img'] : '';

  /* ###  CONEXION BBDD  ### */
  $conexion = new mysqli('localhost', 'admin_wordpress', 'Hlanz.2018', 'examen_php');
  //Comprobar conexión a la bbdd
  if ($conexion->connect_error) {
      die('Error de Conexión (' . $conexion->connect_errno . ') '
              . $conexion->connect_error);
  }
  // establecer el conjunto de caracteres a utf8
  $conexion->set_charset("utf8");

  /* ###  LOGIN  ### */
  if( isset($_POST['entrar']) ) {
    $usuario = $_POST["log_usuario"];
    $passwd = $_POST["log_password"];
    if ($resultado = $conexion->query("SELECT * from usuarios where name='$usuario'")) {
      $row = $resultado->fetch_array(MYSQLI_ASSOC);
      if ( $row['password']==$passwd ) {
        $_SESSION['usuario'] = $_POST['log_usuario'];
      }
    }
  }

  /* ###  ADD IMAGEN  ### */
  if( isset($_POST['reg_imagen']) ) {
    $imagen = $_POST["imagen"];
    if( !$conexion->query("insert into admin_imgs values (null,'$imagen')") ) {
      echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
    }
  }

  $imagenes=[];
  if ($resultado = $conexion->query("SELECT * from admin_imgs")) {
  if( $resultado->num_rows > 0 ) {
    while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
      $imagenes[] = $row["url_img"];
      //echo $row["url_img"];
      }
    }
  }

?>


<div class="container" id="usuario">

<?php if ( isset($_SESSION['usuario']) ) { 
        $imagenes=[];
        if ($resultado = $conexion->query("SELECT * from admin_imgs")) {
        if( $resultado->num_rows > 0 ) {
          while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
            $imagenes[] = $row["url_img"];
            }
          }
        }

        if( $_SESSION['usuario']=="admin") { ?>
        <h3 class="text-center">Panel administración</h3>
        <div class="row justify-content-center">
        <?php 
        for($i=0; $i<count($imagenes); $i++) {
          echo '<div class="col"><img src="' . $imagenes[$i] . '" class="img-thumbnail"></div>';
        }
        ?>

        </div>

        <form action="usuario.php" method="post">
          <div class="form-group">
            <label for="imagen">Añadir avatar</label>
            <input type="text" class="form-control" name="imagen" placeholder="Introduce la URL de la imagen" required>
            <button type="submit" class="btn btn-primary" name="reg_imagen">Añadir</button>
          </div>
</form>
  <?php }
        else {
  ?>

  <div class="row justify-content-center">
    <div class="col">
      <form action="usuario.php" method="post">
      <div class="row">
      <?php 
      for($i=0; $i<count($imagenes); $i++) { 
         echo '<div class="form-check col">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="user_img" value="'.$imagenes[$i].'">
                <img src="'.$imagenes[$i].'" alt="" class="img-thumbnail">
              </label>
            </div>'; 
       }
      ?>  
      </div>
      <button type="submit" class="btn btn-primary" name="elegir_img">Elegir</button>
      </form>
    </div>
    <div class="col">
      <form action="usuario.php" method="post">
        <div class="card" style="width: 20rem;">
          <img class="card-img-top" src="<?php echo $_SESSION['user_img']; ?>" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title"><?php echo $_SESSION['usuario']; ?></h4>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <button type="submit" class="btn btn-danger" name="logout">Cerrar sesión</button>
            <a class="btn btn-info" href="#" onclick="javascript:window.location.href = './index.php'">Volver</a>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php 
}
}
      else {
      echo '<div class="alert alert-danger text-center">El usuario o la contraseña son erróneos</div>';
      echo '<a class="btn btn-info" href="javascript:history.go(-1)">Volver</a>'; 
      }

      if ( isset($_POST['logout']) ) {
        session_destroy();
        header("Location: index.php");
      }
?>

</div>
  
</body>
</html>
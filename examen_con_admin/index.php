<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Examen PHP - Inicio</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container" id="index">
  <div class="row justify-content-center">
    <div class="col">
    <h3>Registro</h3>
      <form action="index.php" method="post" id="registro">
          <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" name="reg_usuario" placeholder="Introduce tu nombre de Usuario" required>
          </div>
          <div class="form-group">
              <label for="usuario">Email:</label>
              <input type="email" class="form-control" name="reg_email" placeholder="Introduce tu Email" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" name="reg_password" placeholder="Introduce tu Contraseña">
          </div>
          <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
      </form>
    </div>
    <div class="col">
    <h3>Login</h3>
      <form action="usuario.php" method="post" id="login">
          <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" name="log_usuario" placeholder="Introduce tu nombre de Usuario" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" name="log_password" placeholder="Introduce tu Contraseña">
          </div>
          <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
      </form>
    </div>
  </div>
</div>

<?php 

/* ###  CONEXION BBDD  ### */
$conexion = new mysqli('localhost', 'admin_wordpress', 'Hlanz.2018', 'examen_php');
//Comprobar conexión a la bbdd
if ($conexion->connect_error) {
    die('Error de Conexión (' . $conexion->connect_errno . ') '
            . $conexion->connect_error);
}
// establecer el conjunto de caracteres a utf8
$conexion->set_charset("utf8");

/* ###  REGISTRO  ### */
if ( isset($_POST['registrar']) ) {
  $usuario=$_POST{'reg_usuario'};
  $email=$_POST['reg_email'];
  $password=$_POST['reg_password'];
  
  if ( ($usuario && $email && $password) != null ) {
    if( !$conexion->query("insert into usuarios values (null,'$usuario','$email','$password')") ) {
      echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
    }
    else {
      echo '<div class="alert alert-primary registro">Registro realizado con éxito!</div>';
    }

  }
  
}
?>
  
</body>
</html>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Document</title>
    <style>
        form {
            width: 300px;
            margin: auto;
        }
        .container {
            margin-top: 100px;
        }
        .alert {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <div class="container">

    <?php
      $user = ["admin","user1","user2","user3","user4","user5"];
      $pass = ["1234","1111","2222","3333","4444","5555"];
      $error = false; // no coinciden usuario y contraseña
      $_SESSION['login'] = false;
      $_SESSION['usuario'] = ""; //usuario logeado
      if( !isset($_SESSION['login']) ) {
    ?>
      <form action="login_form_session.php" method="post">
          <div class="form-group">
              <label for="Usuario">Usuario</label>
              <input type="text" class="form-control" name="usuario" placeholder="Introduce tu nombre de Usuario" required>
          </div>
          <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" name="password" placeholder="Introduce tu password">
          </div>
          <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
      </form>

      <?php 
      }
        if ( isset($_POST['enviar']) ) {
            $u=$_POST["usuario"];
            $p=$_POST["password"];
            for($i=0; $i<count($user); $i++) {
                if($user[$i]==$u) {
                    if($pass[$i]==$p) {
                        $_SESSION["login"] = true;
                        $_SESSION['usuario'] = $u;
                        break;
                    }
                }
            }
            if( !isset($_SESSION['login']) ) $error = true;
        }
        if( isset($_POST['cerrar']) ) unset($_SESSION['login']); //session_destroy(); 
        
        if ( isset($_SESSION['login']) && isset($_SESSION['usuario']) ) {    
      ?>
        <div class="alert alert-primary text-center" role="alert">
            Te has logueado como "<?php echo strtoupper($_SESSION['usuario']); ?>"
        </div>
        <form action="login_form_session.php" method="post">
            <button type="submit" class="btn btn-primary" name="cerrar">Cerrar sesión</button>
        </form>
      <?php
        }
        elseif ( $error ) {
     ?>
        <div class="alert alert-danger text-center" role="alert">
            El usuario o la contraseña son erróneos
        </div>
      <?php
        }
        elseif ( !isset($_SESSION['login']) ) { ?>

        <div class="alert alert-warning text-center" role="alert">
            Aún no te has logueado
        </div>

      <?php 
        }
  
      ?>

    </div>
</body>
</html>
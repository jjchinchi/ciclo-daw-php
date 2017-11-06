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
  <title>Juego imágenes</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <style>
    .container {
      padding-top:100px;
    }
    .row {
      width: 350px;
      margin: 20px auto;
    }
    a {
      color: black;
    }
    a[type=submit] {
      -webkit-appearance: inherit;
    }
    a:hover {
      text-decoration:none;
      color: black;
    }
    i {
      color: black;
    }
    h1 {
      margin-bottom: 30px;
    }
    h2 {
      margin-top: 30px;
    }
    small {
      text-align:center;
      display:block;
    }
  </style>
</head>
<body>
<?php 
  $array_inicial = ["fa-camera-retro","fa-camera-retro","fa-futbol-o","fa-futbol-o","fa-umbrella","fa-umbrella"];
  $_SESSION['array_inicial'] = [];

  // Si no se ha iniciado el juego crear el array de la sesión:
  if( !isset($_SESSION["carta1"]) ) {
    shuffle($array_inicial);
    for($i=0; $i<count($array_inicial); $i++) {
      $_SESSION['array_inicial'][$i] = $array_inicial[$i];
    }
  }

  $_SESSION["carta1"] = null;
  $_SESSION["carta2"] = null;
  $id = isset($_POST['select']) ? $_POST['select'] : null;
  /* $_SESSION["c1"] = null;
  $_SESSION["a2"] = null;
  $_SESSION["b2"] = null;
  $_SESSION["c2"] = null; */
?>
  <div class="container text-center">
    <h1 class="display-4">Encuentra las parejas!</h1>

    <form action="juego_cartas_session.php" method="post">
      <?php for( $i=0; $i<2; $i++ ) { ?>
      <div class="row">
        <?php for( $j=0; $j<3; $j++ ) { ?>
          <div class="col">
          <?php if ( $id != $_SESSION['aray_inicial'][$j] ) { ?>
            <a href="juego_cartas_session.php" type="submit" name="select" value="<?php echo $_SESSION['aray_inicial'][$j]; ?>">
              <i class="fa fa-square fa-5x"></i>
            </a>
          <?php }else{ ?>
            <i class="fa <?php echo $_SESSION['aray_inicial'][$j]; ?> fa-5x"></i>
          <?php } ?>
          </div>
          <!-- Genera nueva "row" -->
          <?php if ( $j == 2 ) { ?> </div><div class="row"> <?php } ?>
        <?php } //for $j ?>
      </div>
      <?php } //for $i ?>
    </form>

  <?php
  /* $gameOver="";
  if( isset($_POST['id']) ) {
    if( $id=="af" || $id=="fa" || $id=="be" || $id=="eb" || $id=="cd" || $id=="dc") {
      $gameOver = "<span class='text-success'>Ganaste!</span>";
    } elseif( strlen($id) > 1 ) {
      $gameOver = "<span class='text-danger'>Game Over</span>";
    }
  
  }  */?>
  <!-- <h2 class="display-4 text-warning" style="height:70px;"><?php echo $gameOver; ?></h2>
  <a href="juego_imagenes2.php"><i class="fa fa-repeat fa-2x"></i><h5 class="">Reload</h5></a> -->

  </div>
  
</body>
</html>
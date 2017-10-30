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
  <div class="container text-center">
    <h1 class="display-4">Encuentra las parejas!</h1>
<?php 
  $id = isset($_GET['id']) ? $_GET['id'] : null;
?>

  <div class="row">
    <div class="col">
      <?php if ( $id && ($id=="a" || strpos($id,'a') !== false) ) { ?>
        <i class="fa fa-camera-retro fa-5x"></i>
        <small>Camara retro</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="a" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'a'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Camara retro</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=a"><i class="fa fa-square fa-5x"></i></a>
        <small>Camara retro</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
    <div class="col">
      <?php if ( $id && ($id=="b" || strpos($id,'b') !== false) ) { ?>
        <i class="fa fa-umbrella fa-5x"></i>
        <small>Umbrella</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="b" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'b'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Umbrella</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=b"><i class="fa fa-square fa-5x"></i></a>
        <small>Umbrella</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
    <div class="col">
      <?php if ( $id && ($id=="c" || strpos($id,'c') !== false) ) { ?>
        <i class="fa fa-futbol-o fa-5x"></i>
        <small>Ball</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="c" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'c'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Ball</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=c"><i class="fa fa-square fa-5x"></i></a>
        <small>Ball</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <?php if ( $id && ($id=="d" || strpos($id,'d') !== false) ) { ?>
        <i class="fa fa-futbol-o fa-5x"></i>
        <small>Ball</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="d" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'd'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Ball</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=d"><i class="fa fa-square fa-5x"></i></a>
        <small>Ball</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
    <div class="col">
      <?php if ( $id && ($id=="e" || strpos($id,'e') !== false) ) { ?>
        <i class="fa fa-umbrella fa-5x"></i>
        <small>Umbrella</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="e" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'e'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Umbrella</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=e"><i class="fa fa-square fa-5x"></i></a>
        <small>Umbrella</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
    <div class="col">
      <?php if ( $id && ($id=="f" || strpos($id,'f') !== false) ) { ?>
        <i class="fa fa-camera-retro fa-5x"></i>
        <small>Camara retro</small><i class="fa fa-eye text-success"></i>
      <?php } elseif ( $id && $id!="f" ) { ?>          
        <a href="juego_imagenes2.php?id=<?php echo $id . 'f'; ?>"><i class="fa fa-square fa-5x"></i></a>
        <small>Camara retro</small><i class="fa fa-eye-slash text-info"></i>
      <?php } else { ?>
        <a href="juego_imagenes2.php?id=f"><i class="fa fa-square fa-5x"></i></a>
        <small>Camara retro</small><i class="fa fa-eye-slash text-info"></i>
      <?php } ?>
    </div>
  </div>

  <?php
  $gameOver="";
  if( isset($_GET['id']) ) {
    if( $id=="af" || $id=="fa" || $id=="be" || $id=="eb" || $id=="cd" || $id=="dc") {
      $gameOver = "<span class='text-success'>Ganaste!</span>";
    } elseif( strlen($id) > 1 ) {
      $gameOver = "<span class='text-danger'>Game Over</span>";
    }
  
  } ?>
  <h2 class="display-4 text-warning" style="height:70px;"><?php echo $gameOver; ?></h2>
  <a href="juego_imagenes2.php"><i class="fa fa-repeat fa-2x"></i><h5 class="">Reload</h5></a>

  </div>
  
</body>
</html>
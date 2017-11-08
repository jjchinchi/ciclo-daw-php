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
    button[type=submit] {
      background: none;
      border: none;
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
  //$_SESSION['array_inicial'] = [];

  if ( isset($_GET['select1']) ) {
    $_SESSION["carta1"] = $_GET['select1'];
    //$_GET['select1'] = null;
  } 
  elseif ( isset($_GET['select2']) ) {
    $_SESSION["carta2"] = $_GET['select2'];
    //$_GET['select2'] = null;
  }

  // Si no se ha iniciado el juego barajar el array de cartas:
  if( !isset($_SESSION["carta1"]) ) {
    shuffle($array_inicial);
    for($i=0; $i<count($array_inicial); $i++) {
      $_SESSION['array_inicial'][$i] = $array_inicial[$i] . "$i";
    }
  }
/*   print_r($array_inicial);
  echo "<br>"; */
  print_r($_SESSION['array_inicial']);
  

  //$id = isset($_GET['select']) ? $_GET['select'] : null;
  echo("<br/>carta1: " . $_SESSION["carta1"]);
  echo("<br/>carta2: " . $_SESSION["carta2"]);

  if( isset($_GET['restart']) ) {
    unset($_SESSION["carta1"]);
    unset($_SESSION["carta2"]);
  }

  $name = isset($_GET['select1']) ? "2" : "1";

?>
  <div class="container text-center">

    <h1 class="display-4">Encuentra las parejas!</h1>
    <form action="juego_cartas_session.php" method="get">
      <div class="row">
        <?php for( $i=0; $i<count($array_inicial); $i++ ) { ?>
          <div class="col">
          <?php echo "<script>console.log('".$_SESSION["carta1"] . " | " . $_SESSION["carta2"] . " - " . $_SESSION['array_inicial'][$i]."')</script>"; ?>
          <?php if ( $_SESSION["carta1"] == $_SESSION['array_inicial'][$i] || $_SESSION["carta2"] == $_SESSION['array_inicial'][$i] ) { ?>
            <i class="fa <?php echo $array_inicial[$i]; ?> fa-5x"></i>
          <?php }else{ ?>
            <button type="submit" name="select<?php echo $name; ?>" value="<?php echo $_SESSION['array_inicial'][$i]; ?>">
              <i class="fa fa-square fa-5x"></i><?php echo $_SESSION['array_inicial'][$i]; ?>
            </button>
          <?php } ?>
          </div>
          <!-- Genera nueva "row" -->
          <?php if ( $i == 2 ) { ?> </div><div class="row"> <?php } ?>
        <?php } //for $i ?>
      </div>
      <button type="submit" name="restart"> Reload </button>
    </form>

  <?php
  /* $gameOver="";
  if( isset($_GET['id']) ) {
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
<i class="fa <?php echo $_SESSION['array_inicial'][$i]; ?> fa-5x"></i>
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
            width: 300px;
            margin: auto;
        }
        .form-group {
            margin: 10px auto 10px 0;
        }
        .contenedor-numeros {
            margin-bottom: 20px;
        }
        label {
            min-width:150px;
        }
        button {
            margin-left:5px;
            margin-bottom:5px;
        }
    </style>
</head>
<body>
    <div class="container">

        <form class="form-inline" action="obtener_letras_abcdario.php" method="post">
            <div class="contenedor-numeros">
                <div class="form-group">
                    <label for="num1">Primer número</label>
                    <input type="text" class="form-control" name="num1" size="6">
                </div>
                <div class="form-group">
                    <label for="num2">Segundo número</label>
                    <input type="text" class="form-control" name="num2" size="6">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="calcular" style="margin:0 auto 0.5rem auto">ABCdario</button>
        </form>

        <?php

            if ( isset($_POST['num1']) && isset($_POST['num2']) ) {
                
                /* $num1 = $_POST['num1'] + 64;
                $num2 = $_POST['num2'] + 63;
                for($i=$num1; $i<=$num2; $i++) {
                    echo chr($i) . "\t";
                } */
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $result = "";
                if ( (($num1 && $num2) > 0) && ($num1 < $num2) && $num2 <= 27 ) {
                    $abc = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
                    for($i=$num1; $i<=$num2; $i++) {
                        $result .= $abc[$i-1] . "\t";
                    }
                }else {
                    $result .= "El intervalo es erróneo";
                }
        ?>
            <div class="alert alert-primary" role="alert">
                <?php echo "[" . $num1 . " - " . $num2 . "]" . " = " . $result; ?>
            </div>
        <?php
            }
            
        ?>
    </div>
</body>
</html>
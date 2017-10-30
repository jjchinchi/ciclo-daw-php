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

        <form class="form-inline" action="calculando2.php" method="post">
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
            <button type="submit" class="btn btn-primary" value="+" name="calcular">Sumar</button>
            <button type="submit" class="btn btn-primary" value="-" name="calcular">Restar</button>
            <button type="submit" class="btn btn-primary" value="x" name="calcular">Multiplicar</button>
            <button type="submit" class="btn btn-primary" value="/" name="calcular">Dividir</button>
        </form>

        <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $result = false;

                if($_POST["calcular"]=="+") {
                    $result = $_POST["num1"] + $_POST["num2"];
                }elseif($_POST["calcular"]=="-") {
                    $result = $_POST["num1"] - $_POST["num2"];
                }elseif($_POST["calcular"]=="x") {
                    $result = $_POST["num1"] * $_POST["num2"];
                }elseif($_POST["calcular"]=="/") {
                    $result = $_POST["num1"] / $_POST["num2"];
                }

                if($result) {
                    ?>

                    <div class="alert alert-primary" role="alert">
                        Resultado = <?php echo $result; ?>
                    </div>

                    <?php
                }else {
                    ?>

                    <div class="alert alert-danger" role="alert">
                        Error en los datos introducidos
                    </div>

                    <?php
                }

            }
            
        ?>

    </div>
</body>
</html>
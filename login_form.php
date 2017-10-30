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

        <form action="login_form.php" method="post">
            <div class="form-group">
                <label for="Usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Introduce tu nombre de Usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce tu password">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
            $user = ["admin","user1","user2","user3","user4","user5"];
            $pass = ["1234","1111","2222","3333","4444","5555"];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $u=$_POST["usuario"];
                $p=$_POST["password"];
                $ok = false;
                for($i=0; $i<count($user) && !$ok; $i++) {
                    if($user[$i]==$u) {
                        if($pass[$i]==$p) {
                            $ok = true;
                        }
                    
                    }
                }
                if($ok) {
                    
        ?>
            <div class="alert alert-primary" role="alert">
                Bienvenido "<?php echo $u; ?>"
            </div>
        <?php
                }
                else {
        ?>
            <div class="alert alert-danger" role="alert">
                El usuario o la contraseña son erróneos
            </div>
        <?php
                }
            }
        ?>

    </div>
</body>
</html>
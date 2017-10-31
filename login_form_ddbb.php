<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    <title>Document</title>
    <style type="text/css">
        form#login_form {
            width: 300px;
            margin: auto;
        }
        form.form-inline {
            justify-content:center;
        }
        .container {
            margin-top: 100px;
            margin-bottom: 100px;
        }
        .alert {
            margin: 60px auto;
            display: table;
        }
        img {
            margin-right: 1rem;
        }
        .btn {
            cursor: pointer;
        }
        div#seleccion {
            display: inline-block;
        }
        .lista-usuarios p {
            position: relative;
            width: 180px;
        }
        button#eliminar {
            position: absolute;
            right: 0;
            top: 18%;
        }
    </style>
</head>
<body>

<?php //Variables de inicio
        $loginOk = false;
        $listar = false;
        $registro = false;
        $modificado = false;
        $eliminado = false;
?>
    <div class="container">

        <form action="login_form_ddbb.php" method="post" id="login_form">
            <div class="form-group" id="nombre">
                <label for="Usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Introduce tu nombre de Usuario">
            </div>
            <div class="form-group" id="pass">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce tu password">
            </div>
            <div class="form-group d-none" id="imagen">
                <label for="image">URL Imagen</label>
                <input type="text" class="form-control" name="imagen" placeholder="Introduce la url de la imagen">
            </div>
            <div class="form-group" id="seleccion">
                <select class="custom-select" name="opcion">
                    <option value="0" selected>Selecciona una opción</option>
                    <option value="login">Login</option>
                    <option value="nuevo">Nuevo registro</option>
                    <option value="listar">Listar usuarios</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>

        <?php
            
            $conexion = new mysqli('localhost', 'admin_wordpress', 'Hlanz.2018', 'curso_php');
            //Comprobar conexión a la bbdd
            if ($conexion->connect_error) {
                die('Error de Conexión (' . $conexion->connect_errno . ') '
                        . $conexion->connect_error);
            }
            // establecer el conjunto de caracteres a utf8
            $conexion->set_charset("utf8");

            if( isset($_POST["enviar"]) ) {

                $usuario ="";
                $passwd = "";

                // #############  LOGIN   #############
                if ( $_POST["opcion"] == "login" ) {
                    //Capturar datos formulario
                    $usuario = $_POST["usuario"];
                    $passwd = $_POST["password"];

                    // Consulta a la bbdd
                    if ($resultado = $conexion->query("SELECT * from users where username='$usuario'")) {
                        $row = $resultado->fetch_array(MYSQLI_ASSOC);
                        if ( $row['pass']==$passwd ) {
                            //$loginOk = true;
                            ?> 
                            <div class="alert alert-primary text-center" role="alert">
                                <img src="<?php echo $row['image']; ?>" width="60" />
                                Bienvenido <?php echo strtoupper($row['username']); ?>
                            </div>
                            <form class="form-inline" action="login_form_ddbb.php" method="post" id="modify_form">
                                <input type="hidden" value="<?php echo $usuario; ?>" name="usuario" />
                                <input class="form-control mr-sm-2" type="text" placeholder="Nuevo nombre" name="n_usuario">
                                <input class="form-control mr-sm-2" type="password" placeholder="Nuevo password" name="n_password">
                                <input class="form-control mr-sm-2" type="password" placeholder="Repite el password" name="n_password2">
                                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="modificar" value="modificar">
                            </form>
                    <?php } else { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                El usuario o la contraseña son erróneos
                            </div>
                    <?php }
                        // liberar el conjunto de resultados
                        $resultado->free();
                    }

                // #############  LISTAR   #############
                } else if( $_POST["opcion"] == "listar" ) {
                    if ($resultado = $conexion->query("SELECT * from users")) {
                        $lista_usuarios = "<form action='login_form_ddbb.php' method='post'>";
                        while( $row = $resultado->fetch_array(MYSQLI_ASSOC) ) {
                            $lista_usuarios .= "<p><img src='". $row["image"] . "' width='60'>" . $row["username"] . "<button id='eliminar' type='submit' name='eliminar' value='".$row["id"]."'>&#10008;</button></p>";
                        }
                        $lista_usuarios .= "</form>"; ?>
                        <div class="alert alert-primary lista-usuarios" role="alert">
                            <p style="text-decoration:underline">USUARIOS:</p>
                            <?php echo $lista_usuarios; ?>
                        </div>
                    <?php 
                        $resultado->free();
                        // $listar = true;
                    }

                // #############  REGISTRAR   #############
                } else if( $_POST["opcion"] == "nuevo" ) {
                    $usuario = $_POST["usuario"];
                    $passwd = $_POST["password"];
                    $imagen = $_POST["imagen"];

                    if( ($usuario && $passwd && $imagen) != null ) {
                        if( !$conexion->query("insert into users values (null,'$usuario','$passwd','$imagen')") ) {
                            echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
                        }else { ?>
                            <div class="alert alert-primary text-center" role="alert">
                                Registro realizado con éxito!
                            </div>    
                <?php   }                        
                    } else { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            No has rellenado todos los campos
                        </div>
                <?php }
                }
                $conexion->close();
            } // Fin "Enviar"

            // #############  MODIFICAR   #############
            if( isset($_POST["modificar"]) ) {
                $usuario = $_POST["usuario"];
                $n_usuario = $_POST["n_usuario"];
                $n_passwd = $_POST["n_password"];
                $n_passwd2 = $_POST["n_password2"];
                if( ($n_usuario && $n_passwd) != null && $n_passwd == $n_passwd2 ) {
                    if( !$conexion->query("UPDATE users SET username='$n_usuario', pass='$n_passwd' WHERE username='$usuario'") ) {
                        echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
                    }else { ?>
                        <div class="alert alert-primary text-center" role="alert">
                            Usuario modificado con éxito
                        </div>
            <?php   }
                } else { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Error: no ha introducido los datos correctamente
                    </div>
            <?php }
                $conexion->close();
            }

            // #############  ELIMINAR   #############
            if( isset($_POST["eliminar"]) ) {
                if( !$conexion->query("DELETE FROM users WHERE id = '$_POST[eliminar]'") ) {
                        echo "Falló la creación del registro: (" . $conexion->errno . ") " . $conexion->error;
                }else { ?>
                    <div class="alert alert-primary text-center" role="alert">
                        Usuario eliminado con éxito
                    </div>
            <?php }
            }
        ?>

        <!-- ####### RESULTADOS ######### -->
        <?php if ( isset($_POST["enviar"]) ) { ?>
   
            <!-- LOGIN -->
            <?php  if ( $_POST["opcion"] == "login" && $loginOk ) { ?>
                <!-- <div class="alert alert-primary text-center" role="alert">
                    <img src="<?php //echo $row['image']; ?>" width="60" />
                    Bienvenido <?php //echo strtoupper($row['username']); ?>
                </div>
                <form class="form-inline" action="login_form_ddbb.php" method="post" id="modify_form">
                    <input type="hidden" value="<?php //echo $usuario; ?>" name="usuario" />
                    <input class="form-control mr-sm-2" type="text" placeholder="Nuevo nombre" name="n_usuario">
                    <input class="form-control mr-sm-2" type="password" placeholder="Nuevo password" name="n_password">
                    <input class="form-control mr-sm-2" type="password" placeholder="Repite el password" name="n_password2">
                    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="modificar" value="modificar">
                </form> -->
            <?php
                } else if ( $_POST["opcion"] == "login" && !$loginOk ) { 
            ?>
                <!-- <div class="alert alert-danger text-center" role="alert">
                    El usuario o la contraseña son erróneos
                </div> -->

                <!-- LISTAR -->
            <?php } else if ( $_POST["opcion"] == "listar" && $listar ) { ?>
                <!-- <div class="alert alert-primary lista-usuarios" role="alert">
                    <p style="text-decoration:underline">USUARIOS:</p>
                    <?php //echo $lista_usuarios; ?>
                </div> -->

                <!-- REGISTRAR -->
            <?php } else if ( $_POST["opcion"] == "registrar" && $registro ) { ?>
                <!-- <div class="alert alert-primary text-center" role="alert">
                    Registro realizado con éxito!
                </div> -->
            <?php } else if ( $_POST["opcion"] == "registrar" && !$registro ) { ?>
                <!-- <div class="alert alert-danger text-center" role="alert">
                    No has rellenado todos los campos
                </div> -->
            <?php } 
        } // endif "enviar";

        // MODIFICAR
        else if ( isset($_POST["modificar"]) ) { ?>
            <?php if ($modificado) { ?>
                <!-- <div class="alert alert-primary text-center" role="alert">
                    Usuario modificado con éxito
                </div> -->
            <?php
                } else { 
            ?>
                <!-- <div class="alert alert-danger text-center" role="alert">
                    Error: no ha introducido los datos correctamente
                </div> -->
            <?php } 
        } //endif "modificar"

        // ELIMINAR
        else if ( isset($_POST["eliminar"]) ) { ?>
            <?php if ($eliminado) { ?>
                <!-- <div class="alert alert-primary text-center" role="alert">
                    Usuario eliminado con éxito
                </div> -->
            <?php
                } 
        } //endif "modificar"
        ?>
        
    </div>

    <script>
        $(window).on('load', function(){
            if($('select').val()=="0") {
               $('button[name="enviar"]').prop('disabled', true); 
            }
        });

        $('select').on('change', function () {
            if ($(this).val() != "0") $('button').prop('disabled', false);
            if ($(this).val() == "nuevo") {
                $('div#imagen').removeClass('d-none');
                $('input').prop('disabled', false);
            }else if($(this).val() == "listar"){
                $('input').prop('disabled', true);
            }else {
                if (!$('div#imagen').hasClass('d-none')) {
                    $('div#imagen').addClass('d-none');
                }
                $('input').prop('disabled', false);
            }
        });

    </script>

</body>
</html>

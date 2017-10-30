<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
    .wrapper {
    margin: 0 auto;
    width: 300px;
    }
    h3 {
        text-align: center;
    }
    table {
        border: 2px solid black;
    }
    table td {
        padding: .5rem;
        border: 1px solid #D1D0D0;
    }
    span {
        font-weight: bold;
        color: darkred;
    }
    </style>
</head>
<body>
<div class="wrapper"> 
<h3>Mi página de cuentas</h3>
<br>

<?php
    $dato1 = isset($_POST["dato1"]) ? $_POST["dato1"] : 5;
    $dato2 = isset($_POST["dato2"]) ? $_POST["dato2"] : 6;
    function tabla_multiplicar($n1) {
        for($i=1; $i<=10; $i++) {
            echo $n1.' x '.$i.' = <span>'. $n1*$i .'</span><br/>';
        }
    }
?>
<form action="index.php" method="post">
<table>
    <tr rowspan>
        <td rowspan="3">
            Dato 1: <input type="text" name="dato1" placeholder="<?php echo $dato1; ?>"/> <br/>
            Dato 2: <input type="text" name="dato2" placeholder="<?php echo $dato2; ?>"/>
        </td>
        <td>La suma vale: <span><?php echo $dato1 + $dato2; ?></span></td>
    </tr>
    <tr>
        <td>La resta vale: <span><?php echo $dato1 - $dato2; ?></span></td>
    </tr>
    <tr>
        <td>La multiplicación vale: <span><?php echo $dato1 * $dato2; ?></span></td>
    </tr>
    <tr><td>Tabla de multiplicar del <span><?php echo $dato1; ?></span></td></tr>
    <tr><td>
    <?php
        tabla_multiplicar($dato1);
    ?>
    </td></tr>
    <tr><td colspan="2"><button type="submit">Calcular</button></td></tr>
</table>
</form>

</div>
    
</body>
</html>
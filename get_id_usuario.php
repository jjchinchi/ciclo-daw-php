<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $id = isset($_GET["id"]) ? $id = $_GET["id"] : null;

        if (is_numeric($id) && $id>=0 && $id<=3) :
            $nombre = array("Pepe", "Juan", "Laura", "Carmen");
            $img = array("https://i.pinimg.com/736x/4e/5c/f7/4e5cf7d4ccb9c59b6620a9c71944d51e--emoticons-text-smileys.jpg", 
                        "https://i.pinimg.com/736x/44/34/f5/4434f5f63b3a0994a4e8412d178a29ac--symbols-emoticons-smiley-faces.jpg", 
                        "http://3.bp.blogspot.com/-n4nniZBLL00/U-VtVKFtwmI/AAAAAAAALb4/LUw9J0Zue-4/s1600/prayer-smiley.png", 
                        "https://i.pinimg.com/736x/98/f4/b7/98f4b7dca252bf90c5e274e7f76dde86--emoticon-list-smiley-faces.jpg"
                   );
            $descripcion = array("Descripcion de Pepe", "Descripcion de Juan", "Descripcion de Laura", "Descripcion de Carmen");
    ?>
<div style="width: 80%; margin: auto; text-align:center">
    <h1 style="text-align:center"> Perfil del usuario</h1>
    <br>
    <br>
    <br>
    <h2><?php echo $nombre[$id]; ?></h2>
    <img src="<?php echo $img[$id]; ?>" style="margin:10px auto 10px auto" width="150">
    <p style="color:darkblue"><?php echo $descripcion[$id]; ?></p>
</div>
        <?php else : ?>
<h1 style="text-align:center"> El id introducido no es válido</h1>
        <?php endif; ?>

        
</body>
</html>
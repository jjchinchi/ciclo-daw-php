<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio de traducción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<style>
			.container {
				margin-top: 100px;
			}
			select {
				display: inline-block;
			}
			button {
				display: inline-block;
				margin-left: 10px;
			}
			.espacio30 {
				margin-top:15px;
				margin-bottom:15px;
				display:
			}
		</style>
	</head>
<body>
	<div class="container">

		<form action="idiomas.php" method="GET">
			<select class="custom-select" name="lang">
				<option value="none" selected>Selecciona un idioma</option>
				<option value="en">Inglés</option>
				<option value="es">Español</option>
				<option value="fr">Francés</option>
			</select>
			<button type="submit" class="btn btn-primary">Elegir</button>
		</form>
		<div class="espacio30"></div>

	<?php 

		$idioma['es']['Titulo']="Bienvenido";
		$idioma['es']['Parrafo']="WhatsApp está de estreno. Después de años con sus ya míticos emojis, ha decidido renovar el diseño de los mismos y lanzar una nueva versión de todos ellos. Más redonditos, con más detalle y, quizá, menos graciosos, los nuevos emoticonos de la aplicación de mensajería instantanea más usada del mundo ya están aquí, y tendremos que empezar a acostumbrarnos a ellos.";


		$idioma['en']['Titulo']="Welcome";
		$idioma['en']['Parrafo']="WhatsApp is premiering. After years with its mythical emojis, it has decided to renew the design of the same and to launch a new version of all of them. More round, more detailed and perhaps less funny, the new emoticons of the world's most used instant messaging application are already here, and we will have to start getting used to them.";

		$idioma['fr']['Titulo']="Bonjour";
		$idioma['fr']['Parrafo']="WhatsApp se démarque. Après des années avec ses émoluments mythiques, il a décidé de renouveler la conception de la même et de lancer une nouvelle version de tous. Plus rondes, plus détaillées et peut-être moins drôles, les nouvelles émoticônes de l'application de messagerie instantanée la plus utilisée au monde sont déjà disponibles, et nous devrons commencer à nous habituer.";

		$titulo="";
		$parrafo="";
		$lang = isset($_GET['lang']) ? $_GET['lang'] : false;

		if( $lang ) {
			$titulo = $idioma[$lang]['Titulo'];
			$parrafo = $idioma[$lang]['Parrafo'];
		}
	
	?>

		<h1> <?php echo $titulo; ?> </h1>
		<p> <?php echo $parrafo; ?> </p>

	</div>

</body>
</html>
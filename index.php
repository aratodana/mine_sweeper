<!DOCTYPE html>
<html>
<head>
	<title>Mezo</title>
	<link rel="stylesheet" type="text/css" href="desktop.css">
</head>
<body>
	<?php
		require("Mezo.php");
		require("Tabla.php");
		require("Webforras.php");
		session_start();
		if(isset($_SESSION["tabla"])){
			$tabla = $_SESSION["tabla"];
			if(is_numeric($_GET['x']) and is_numeric($_GET['y']) and $tabla->isOnTable($_GET['x'], $_GET['y'])){
				if(isset($_GET['x']) and isset($_GET['y']))
					{
						$tabla->felfed($_GET['x'], $_GET['y']);
					}
					$tabla->toHTML();
			}else{
				Alert("Valami hiba történt");
				}			
		}
		elseif (isset($_GET['size']) and isset($_GET['countOfMines'])) {
			if(is_numeric($_GET['size']) and is_numeric($_GET['countOfMines']) and $_GET['size']*$_GET['size'] >= $_GET['countOfMines']){
				$tabla = new Tabla;
				$tabla->Construct($_GET['size'], $_GET['countOfMines']);
				$_SESSION["tabla"] = $tabla;
				$tabla->toHTML();
				}
			else{
				Alert("Valami hiba történt");
				}
		}
		else{
			NewGame();
		}


	?>
</body>
</html>
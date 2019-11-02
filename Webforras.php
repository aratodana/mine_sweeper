<?php
	//Egyszerű szövegablak, ide tudod kiírni, hogyha valaki vesztett, nyert, vagy a rendszer hibát észlelt
	//Figyelem, innen csak új játék indítása lehetséges
	function Alert($szoveg)
	{
		echo "	<div>
					<h1>" . $szoveg . "</h1>
					<a href='index.php'>Új játék</a>
				</div>";
		unset($_SESSION['tabla']);
	}

	//Új játék választó lapot írja ki
	function NewGame()
	{
		?>
			<div>
				<form>
					<input type="text" name="size">
					<input type="text" name="countOfMines">
					<input type="submit" value="Mehet">
				</form>
			</div>
		<?php
	}

?>
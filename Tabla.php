<?php
	//Egy tábla reprezentációja
	class Tabla{
		private $size;
		private $matrix;
		private $pontszam;
		private $countOfMines;

		//Konstruktor
		public function Construct($size, $countOfMines)
		{
			$this->size = $size;
			$this->countOfMines = $countOfMines;
			$this->pontszam = 0;
			for($i=0; $i <$size; $i++)
			{
				for($j=0; $j <$size; $j++)
				{
					$this->matrix[$i][$j] = new Mezo;
					$this->matrix[$i][$j]->Construct(0);
				}
			}
			$this->generateMines();
		}

		//Aknák elhelyezése, a konstruktorban meghívódik
		private function generateMines()
		{
			$count = $this->countOfMines;
			while($count > 0)
			{
				$i = rand(0, $this->size-1);
				$j = rand(0, $this->size-1);
				if(!$this->matrix[$i][$j]->isMine()) {
					$this->matrix[$i][$j]->placeMine();
					$this->incraseArea($i, $j);
					$count--;
				}
			}
		}


		//Egy mező körüli mezők számértékeének növelése, ha nem aknák, a konstruktorban meghívódik
		private function incraseArea($i, $j)
		{
			for($k = $i-1; $k <= $i+1; $k++)
			{
				for($h = $j-1; $h <= $j+1; $h++)
				{
					if($k>=0 and $k<$this->size and $h>=0 and $h<$this->size and !$this->matrix[$k][$h]->isMine()) $this->matrix[$k][$h]->incrase();
				}
			}
		}

		//Minden nem akna mezőt felfedtünk?
		public function isWinner()
		{
			foreach($this->matrix as $row)
			{
				foreach($row as $element)
				{
					if(!$element->isFull())	return false;
				}
			}
			return true;
		}

		//Adott mező, valamint a hozzá tartozó terület felfedése
		public function felfed($x, $y)
		{
			$this->terjed($x, $y);
			if($this->matrix[$x][$y]->isMine())	Alert("Vesztettél!<br>Pontszámod: " . $this->pontszam);
			elseif($this->isWinner())	Alert("Nyertél");
		}

		private function terjed($x, $y)
		{
			$this->matrix[$x][$y]->felfed();
			$this->pontszam += $this->matrix[$x][$y]->getErtek();
			if($this->matrix[$x][$y]->isFree($x, $y)){
				if($this->isOnTable($x+1, $y) and ! $this->matrix[$x+1][$y]->isFelfedett())	$this->terjed($x+1, $y);
				if($this->isOnTable($x-1, $y) and ! $this->matrix[$x-1][$y]->isFelfedett())	$this->terjed($x-1, $y);
				if($this->isOnTable($x, $y+1) and ! $this->matrix[$x][$y+1]->isFelfedett())	$this->terjed($x, $y+1);
				if($this->isOnTable($x, $y-1) and ! $this->matrix[$x][$y-1]->isFelfedett())	$this->terjed($x, $y-1);
				//if($this->isOnTable($x+1, $y) and ! $this->matrix[$x+1][$y]->isFelfedett())	$this->felfed($x+1, $y);
			}
		}

		//Van ilyen mező a táblán?
		public function isOnTable($x, $y)
		{
			return $x >= 0 and $x < $this->size and $y >= 0 and $y < $this->size;
		}

		//Kiírja a pontszámot
		public function printPontszam()
		{
			echo $this->pontszam;
		}


		//HTML reprezentáció
		public function toHTML()
		{
			$size = $this->size;
			echo "<div id='gameWindow'><table>";
			for($i=0; $i<$size; $i++)
			{
				echo "<tr>";
				for($j=0; $j < $size; $j++)
				{
					echo "<td><a href='index.php?x=$i&y=$j'>" . $this->matrix[$i][$j]->toHTML() . "</a></td>";
				}
				echo "</tr>";
			}	
			echo "</table></div>";
		}
	}
?>
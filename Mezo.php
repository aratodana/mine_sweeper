<?php
	//Mező reprezentációja 
	class Mezo{
		//Adatmezők
		private $ertek;
		private $felfedett;

		//Konstruktor
		public function Construct($ertek)
		{
			$this->ertek = $ertek;
			$this->felfedett = false;
		}

		//Érték Getter
		public function getErtek()
		{
			return $this->ertek;
		}

		//Átírja Html Formába
		//Ide kell a megfelelő képeket kiírni
		public function toHTML(){
			//if($this->felfedett==false) return "[]";
			//if($this->ertek == -1)	return "X";
			//return (string)$this->ertek;

			if($this->felfedett==false) return "<img src='mines/secret.png' width='50px' alt='" . $this->ertek . "'>"; 
			return "<img src='mines/" . $this->ertek . ".png' width='50px' alt='" . $this->ertek . "'>"; 
		}

		//Megmondja, hogy a mező már fel van-e fedve
		public function isFelfedett()
		{
			return $this->felfedett;
		}

		//Felfedi az adott mezőt
		public function felfed()
		{
			$this->felfedett = true;
		}

		//Van-e akna a mezőn
		public function isMine()
		{
			return $this->ertek == -1;
		}

		//Akna elhelyezés a mezőn
		public function placeMine()
		{
			$this->ertek = -1;
		}

		//Mező számértékének növelése eggyel
		public function incrase()
		{
			$this->ertek++;
		}

		//A mező akna vagy felfedett-e
		public function isFull()
		{
			return $this->isMine() or $this->felfedett == true;
		}

		//A mező értéke 0-e
		public function isFree()
		{
			return $this->ertek == 0;
		}
	}
?>
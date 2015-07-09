<?php
	
	class Cell{
		
		public $type;
		private $x;
		private $y;
		
		const SEEN = 0;
		const BLANK = 10;
		const ROBOT = -5;
		const OBSTACLE = -10;
		const OBJECTIF = 100;
		
		public function __construct($type = self::BLANK, $x, $y){
			
			$this -> type = $type;
			
			$this -> x = $x;
			$this -> y = $y;
			
		}
		
		public function draw(){
			
			switch($this -> type){
				
				case self::SEEN : echo('[•]'); break;
				case self::BLANK : echo('[ ]'); break;
				case self::ROBOT : echo('[R]'); break;
				case self::OBSTACLE : echo('[#]'); break;
				case self::OBJECTIF : echo('[O]'); break;
				
			}
			
		}
		
		public function getType(){
			
			return $this -> type;
			
		}
		
		public function setType($type){
			
			if(in_array($type, array(self::SEEN, self::BLANK, self::ROBOT, self::OBSTACLE, self::OBJECTIF)))
			
				$this -> type = $type;
				
			else
			
				throw new Exception('Ce type de case n\'existe pas.');
			
		}
		
		public function isRobot(){
			
			return ($this -> type == self::ROBOT);
			
		}
		
		public function getXY(){
			
			return array($this -> x, $this -> y);
			
		}
		
		public function drawXY(){
			
			echo('['.$this -> x.'/'.$this -> y.']');
			
		}
		
	}

?>
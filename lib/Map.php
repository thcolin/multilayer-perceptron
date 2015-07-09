<?php

	class Map{
	
		private $map;
		
		public function __construct($h, $v, $Obstacles, $Objectif, $Start){
		
			$this -> map = array();
			
			for($x = 0; $x < $h; $x++){
				
				for($y = 0; $y < $v; $y++){
					
					/* WALLS */
					
					if($x == 0 || $x == $h - 1 || $y == 0 || $y == $v - 1)
					
						$type = Cell::OBSTACLE;
					
					/* OBSTACLES */
					
					else if(in_array(array($x, $y), $Obstacles))
					
						$type = Cell::OBSTACLE;
					
					/* BLANK */
					
					else
					
						$type = Cell::BLANK;
				
					$this -> map[$x][$y] = new Cell($type, $x, $y);
					
				}
				
			}
			
			$this -> setRobot($Start);
			$this -> map[$Objectif[0]][$Objectif[1]] -> setType(Cell::OBJECTIF);
		
		}
	
		public function draw(){
			
			for($i = 0; $i < count($this -> map); $i++){
				
				for($j = 0; $j < count($this -> map[$i]); $j++)
				
					$this -> map[$i][$j] -> draw();
					
				echo("\n");
				
			}
			
			echo("\n");
			
		}
		
		public function getVision(){
			
			$Vision = array();
			
			for($i = 0; $i < 3; $i++){
				
				for($j = 0; $j < 3; $j++){
					
					$x = $this -> Robot[0];
					$y = $this -> Robot[1];
					
					switch($i){
						
						case 0 : $x--; break;
						case 2 : $x++; break;
						
					}
					
					switch($j){
						
						case 0 : $y--; break;
						case 2 : $y++; break;
						
					}
					
					if($this -> map[$x][$y] -> getType() != Cell::ROBOT)
					
						$Vision[] = $this -> map[$x][$y];
					
				}
				
			}
		
			return $Vision;
			
		}
		
		public function drawVision($Vision, $highlight = false){
			
			for($i = 0; $i < count($Vision); $i++){
				
				if($i == 3 || $i == 5)
				
					echo("\n");
					
				if($highlight && $i == $highlight)
				
					echo('[T]');
					
				else{
						
					if($i == 4)
					
						echo('[R]');
					
					$Vision[$i] -> draw();
					
				}
				
			}
			
			echo("\n\n");
			
		}
		
		public function imagineVisionOutputs($Vision){
			
			$array = array_map(function($Cell){ return $Cell -> getType(); }, $Vision);
			$outputs = array();
			
			for($i = 0; $i < count($array); $i++){
			
				switch($array[$i]){
					
					case Cell::SEEN :
					
						if(in_array(Cell::BLANK, $array))
						
							$outputs[$i] = 0;
							
						else if(in_array(Cell::OBJECTIF, $array))
						
							$outputs[$i] = 0;
							
						else
						
							$outputs[$i] = 1;
					
					break;
					case Cell::BLANK :
					
						if(in_array(Cell::OBJECTIF, $array))
						
							$outputs[$i] = 0;
							
						else
						
							$outputs[$i] = 1;
					
					break;
					case Cell::ROBOT : $outputs[$i] = 0; break;
					case Cell::OBSTACLE : $outputs[$i] = 0; break;
					case Cell::OBJECTIF : $outputs[$i] = 1; break;
					
				}
				
			}
			
			for($i = 0; $i < count($outputs); $i++){
				
				if($i == 3 || $i == 5)
				
					echo("\n");
					
				if($i == 4)
				
					echo('[ ]');
				
				echo('['.$outputs[$i].']');
				
			}
			
			echo("\n\n");
			
			return $outputs;
			
		}
		
		public function setRobot($xy){
			
			list($x, $y) = $xy;
			
			if(in_array($this -> map[$x][$y] -> getType(), array(Cell::SEEN, Cell::BLANK, Cell::OBJECTIF))){
			
				$this -> map[$x][$y] -> setType(Cell::ROBOT);
				
				if(isset($this -> Robot))
				
					$this -> map[$this -> Robot[0]][$this -> Robot[1]] -> setType(Cell::SEEN);
				
				$this -> Robot = array($x, $y);
				
			}
				
			else
			
				throw new Exception('LE ROBOT NE PEUX PAS SE DÉPLACER SUR UN OBSTACLE !');
			
		}
		
	}
	
?>
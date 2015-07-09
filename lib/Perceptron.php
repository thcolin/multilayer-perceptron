<?php

	class Perceptron{
		
		private $weights;
		
		public function __construct($size, $reflection = false){
			
			$this -> reflection = $reflection;
			$this -> size = intval($size);
			$this -> learning = .5;
			$this -> bias = 0.0;
			
			for($i = 0; $i < $this -> size; $i++)
			
				$this -> weights[$i] = rand()/getrandmax() * 2 - 1;
			
		}
		
		public function getWeights(){
			
			return $this -> weights;
			
		}
		
		public function setWeights($weights){
			
			$this -> weights = $weights;
			
		}
		
		public function handle($inputs){
			
			$weightedInputs = array();
			
			for($i = 0; $i < $this -> size; $i++)
			
				$weightedInputs[] = $inputs[$i] * $this -> weights[$i];
				
			$sum = array_sum($weightedInputs) + $this -> bias;
			
			if($this -> reflection)
			
				return (1/(1+(41*exp(-$sum))));
			
			else
			
				return ($sum > 0 ? 1:0);
			
		}
		
		public function train($inputs, $outcome){
			
			$output = $this -> handle($inputs);
			
			for($i = 0; $i < $this -> size; $i++)
				
				$this -> weights[$i] = $this -> weights[$i] + $this -> learning * ($outcome - $output) * $inputs[$i];
				
			$this -> bias = $this -> bias + ($outcome - $output);
			
			return $output;
			
		}
		
	}
	
?>
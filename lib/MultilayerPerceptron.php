<?php

	class MultilayerPerceptron{
		
		private $layers;
		
		public function __construct($layersSize, $inputsSize){
			
			for($i = 0; $i < $layersSize; $i++){
				
				$this -> layers[$i] = array();
				
				for($j = 0; $j < $inputsSize; $j++)
				
					$this -> layers[$i][] = new Perceptron($inputsSize, ($i == 0 ? true:false));
				
			}
			
		}
		
		public function init(){
			
			if(is_file(dirname(__DIR__).'/save.json')){
				
				$weights = json_decode(file_get_contents(dirname(__DIR__).'/save.json'), true);
				
				for($i = 0; $i < count($this -> layers); $i++){
				
					for($j = 0; $j < count($this -> layers[$i]); $j++)
					
						$this -> layers[$i][$j] -> setWeights($weights[$i][$j]);
					
				}
				
				return true;
				
			}
			
			return false;
			
		}
		
		public function save(){
			
			$array = array();
			$i = 0;
			
			foreach($this -> layers as $layer){
			
				foreach($layer as $Neurone)
					
					$array[$i][] = $Neurone -> getWeights();
				
				$i++;
				
			}
			
			file_put_contents(__DIR__.'/save.json', json_encode($array));
			
		}
		
		private function handle($inputs){
			
			$outputs = array();
			
			/* Getting first layer results */
			
			$firstLayer = array();
			
			for($i = 0; $i < count($this -> layers[0]); $i++)
				
				$firstLayer[] = $this -> layers[0][$i] -> handle($inputs);
				
			/* Train second layer */
			
			for($i = 0; $i < count($this -> layers[1]); $i++)
			
				$outputs[] = $this -> layers[1][$i] -> handle($firstLayer);
				
			return $outputs;
			
		}
		
		public function train($inputs, $outcomes){
			
			/* Getting first layer results */
			
			$firstLayer = array();
			$secondLayer = array();
			
			for($i = 0; $i < count($this -> layers[0]); $i++)
				
				$firstLayer[] = $this -> layers[0][$i] -> handle($inputs);
				
			/* Train second layer */
			
			for($i = 0; $i < count($this -> layers[1]); $i++)
			
				$secondLayer[] = $this -> layers[1][$i] -> train($firstLayer, $outcomes[$i]);
			
			/* Train first layer */
			
			for($i = 0; $i < count($this -> layers[0]); $i++)
			
				$this -> layers[0][$i] -> train($inputs, $firstLayer[$i]);
				
			return $secondLayer;
			
		}
		
		public function resolve($Vision, $ExpectedOutputs){
			
			/* Correct Vision Array */
			
			$inputs = array();
			
			for($i = 0; $i < count($Vision); $i++)
				
				$inputs[] = $Vision[$i] -> getType();
			
			/* Handle */
			
			$outputs = $this -> train($inputs, $ExpectedOutputs);
			$keys = array_keys($outputs, 1);
			
			if(!empty($keys))
			
				$key = $keys[rand(0, count($keys) - 1)];
				
			else{
			
				$key = rand(0, count($outputs) - 1);
				echo("GETTING RANDOM POSITION.\n");
				
			}
			
			return $key;
			
		}
		
	}
	
?>
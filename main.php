<?php
	
	require_once __DIR__.'/lib/Perceptron.php';
	require_once __DIR__.'/lib/MultilayerPerceptron.php';
	require_once __DIR__.'/lib/Cell.php';
	require_once __DIR__.'/lib/Map.php';
	
	/*
	* Learning
	*/
	
	$NeuralNetwork = new MultilayerPerceptron(2, 8);
	
	$Maps = array();
	
	/*
		[#][#][#]
		[#][R][ ]
		[#][ ][ ]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK, Cell::OBSTACLE, Cell::BLANK, Cell::BLANK),
		array(0, 0, 0, 0, 1, 0, 1, 1)
	);
	
	/*
		[#][#][#]
		[ ][R][#]
		[ ][ ][#]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK, Cell::OBSTACLE, Cell::BLANK, Cell::BLANK, Cell::OBSTACLE),
		array(0, 0, 0, 0, 0, 1, 1, 0)
	);
	
	/*
		[#][#][#]
		[#][R][.]
		[#][.][.]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::SEEN, Cell::OBSTACLE, Cell::SEEN, Cell::SEEN),
		array(0, 0, 0, 0, 0, 0, 1, 0)
	);
	
	/*
		[#][#][#]
		[.][R][#]
		[.][.][#]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::SEEN, Cell::OBSTACLE, Cell::SEEN, Cell::SEEN, Cell::OBSTACLE),
		array(0, 0, 0, 0, 0, 0, 1, 0)
	);
	
	/*
		[ ][ ][#]
		[ ][R][#]
		[#][#][#]	
	*/
	
	$Maps[] = array(
		array(Cell::BLANK, Cell::BLANK, Cell::OBSTACLE, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE),
		array(1, 1, 0, 0, 0, 0, 0, 0)
	);
	
	/*
		[#][ ][ ]
		[#][R][ ]
		[#][#][#]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::BLANK, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE),
		array(0, 1, 1, 0, 0, 0, 0, 0)
	);
	
	/*
		[ ][#][#]
		[ ][R][ ]
		[ ][#][#]	
	*/
	
	$Maps[] = array(
		array(Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK, Cell::BLANK, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE),
		array(0, 0, 0, 0, 1, 0, 0, 0)
	);
	
	/*
		[#][#][ ]
		[O][R][ ]
		[#][#][ ]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK, Cell::OBJECTIF, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::BLANK),
		array(0, 0, 1, 0, 0, 0, 0, 0)
	);
	
	/*
		[.][.][.]
		[ ][R][ ]
		[ ][ ][ ]	
	*/
	
	$Maps[] = array(
		array(Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::BLANK, Cell::BLANK, Cell::BLANK, Cell::BLANK, Cell::BLANK),
		array(0, 0, 0, 1, 1, 1, 1, 1)
	);
	
	/*
		[.][.][.]
		[ ][R][ ]
		[#][#][#]	
	*/
	
	$Maps[] = array(
		array(Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::BLANK, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE),
		array(0, 0, 0, 1, 1, 0, 0, 0)
	);
	
	/*
		[.][.][.]
		[O][R][ ]
		[#][#][#]	
	*/
	
	$Maps[] = array(
		array(Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::OBJECTIF, Cell::BLANK, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE),
		array(0, 0, 0, 1, 0, 0, 0, 0)
	);
	
	/*
		[.][.][.]
		[.][R][ ]
		[.][ ][ ]	
	*/
	
	$Maps[] = array(
		array(Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::BLANK, Cell::SEEN, Cell::BLANK, Cell::BLANK),
		array(0, 0, 0, 0, 1, 0, 1, 1)
	);
	
	/*
		[#][#][#]
		[.][R][.]
		[.][.][ ]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::SEEN, Cell::BLANK),
		array(0, 0, 0, 0, 0, 0, 0, 1)
	);
	
	/*
		[#][#][#]
		[#][R][.]
		[#][ ][.]	
	*/
	
	$Maps[] = array(
		array(Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::OBSTACLE, Cell::SEEN, Cell::OBSTACLE, Cell::BLANK, Cell::SEEN),
		array(0, 0, 0, 0, 0, 0, 1, 0)
	);
	
	if(!$NeuralNetwork -> init()){
	
		for($i = 0; $i < 10000; $i++){
			
			foreach($Maps as $Map)
		
				$NeuralNetwork -> train($Map[0], $Map[1]);
			
			echo("Learning cycle : ".$i."\r");
		
		}
	
	}

	/*
	* Main
	*/
	
	/* OBSTACLES */
	
	$Obstacles = array();
	
	$Obstacles[] = array(1, 4);
	$Obstacles[] = array(2, 4);
	$Obstacles[] = array(2, 5);
	$Obstacles[] = array(2, 6);
	$Obstacles[] = array(3, 4);
	$Obstacles[] = array(4, 4);
	$Obstacles[] = array(4, 5);
	$Obstacles[] = array(6, 5);
	$Obstacles[] = array(7, 5);
	$Obstacles[] = array(8, 5);
	
	/* OBJECTIF */
	
	$Objectif = array(3, 5);
	
	/* START */
	
	$Start = array(6, 2);
	
	/* GO */

	$Map = new Map(10, 10, $Obstacles, $Objectif, $Start);
	
	$Positions = array();
	$iterations = 0;

	do{
		
		$iterations++;
	
		$Map -> draw();
		
		$Vision = $Map -> getVision();
		$Map -> drawVision($Vision);
		
		$ExpectedOutputs = $Map -> imagineVisionOutputs($Vision);
			
		for($i = 0; $i < 1000; $i++){
				
			$key = $NeuralNetwork -> resolve($Vision, $ExpectedOutputs);
			
			echo("Learning cycle : ".$i."\r");
			
		}
		
		echo("\n\n");
		
		//sleep(1);
		
		$NewPosition = $Vision[$key];
		$Map -> drawVision($Vision, $key);
		
		$Positions[] = $NewPosition;
		
		try{
		
			$Map -> setRobot($NewPosition -> getXY());
			
		}
		
		catch(Exception $e){
			
			echo($e -> getMessage()."\n\n");
			
			for($i = 0; $i < 10000; $i++){
			
				$NeuralNetwork -> train(array_map(function($Cell){ return $Cell -> getType(); }, $Vision), $ExpectedOutputs);
			
				echo("Learning cycle : ".$i."\r");
			
			}
			
		}
		
		/* Correct Autism */
		
		$Reverse = array_reverse($Positions);
		
		for($i = 2; $i < 5; $i++){
		
			if(array_slice($Reverse, 0, $i) == array_slice($Reverse, $i, $i)){
				
				echo("GETTING A CYCLE, CORRECTING IT..\n\n");
				
				for($i = 0; $i < 10000; $i++){
				
					$NeuralNetwork -> train(array_map(function($Cell){ return $Cell -> getType(); }, $Vision), $ExpectedOutputs);
				
					echo("Learning cycle : ".$i."\r");
				
				}
				
			}
		
		}
		
		echo("-------------------------------------\n\n");
	
	}
	
	while($NewPosition -> getXY() != $Objectif);
	
	echo("BRAVO ROBOT (".$iterations.") !\n");
	
	$NeuralNetwork -> save();
	
?>
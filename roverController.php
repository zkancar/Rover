<?php

class Rover {
	
	private $grid = array(100,100);
	private $x;
	private $y;
	private $direction;
	private $directions = array('N', 'E', 'S', 'W');
	
    public function __construct(){

    }
	
	public function start($cords, $commands, $direction){
		$this->x = $cords[0];
        $this->y = $cords[1];
		$this->direction = $direction;
		
		$this->move($commands);
	}
	
	public function move($commands){
		$commands = str_split(strtolower($commands));
		foreach($commands as $command){
			$this->moveCommand($command);
		}
	}
	
	public function moveCommand($command){
		switch($command){
			case "f":
				$this->moveForward();
			break;
			case "b":
				$this->moveBackward();
			break;
			case "l":
				$this->setDirectionLeft();
			break;
			case "r":
				$this->setDirectionRight();
			break;
			default:
			break;
		}
	}
	
	
	// Command forward North & East - Rover move upstairs on the grid
	// East and West Moves downstairs on the grid
	
	public function moveForward(){
		if($this->direction == "N" || $this->direction == "E"){
			$this->moveUpstairs();
		}else{
			$this->moveDownstairs();
		}
	}
	
	// Command backward South & West - Rover move upstairs on the grid
	// East and West Moves downstairs on the grid
	
	public function moveBackward(){
		if($this->direction == "S" || $this->direction == "W"){
			$this->moveUpstairs();
		}else{
			$this->moveDownstairs();
		}
	}		
	
	// Viewpoint North & South moves at the at the y angle up
	// Viewpoint  East & West moves at the at the x angle up
		
	public function moveUpstairs(){
		if($this->direction == "N" || $this->direction == "S"){
			$this->y++;
		}else{
			$this->x++;
		}
	}
	// Viewpoint North & South moves at the at the y angle down
	// Viewpoint  East & West moves at the at the x angle down
		
	public function moveDownstairs(){
		if($this->direction == "N" || $this->direction == "S"){
			$this->y--;
		}else{
			$this->x--;
		}
	}	
	
	//Set Directions from array
	//Rover rotates in circle left
	
	public function setDirectionLeft(){
		$direction_key = array_search($this->direction, $this->directions);
		if($direction_key != 0){
			$this->direction =  $this->directions[$direction_key-1];
		}else{
			$this->direction =  $this->directions[count($this->directions)-1];
		}
	}
	
	//Rover rotates in circle right
	
	public function setDirectionRight(){
		$direction_key = array_search($this->direction, $this->directions);
		if($direction_key != count($this->directions)-1){
			$this->direction = $this->directions[$direction_key+1];
		}else{
			$this->direction = $this->directions[0];
		}
	}

}

?>
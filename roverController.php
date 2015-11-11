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
		
		$this->checkCommands($cords, $commands, $direction);
		
		$this->x = $cords[0];
        $this->y = $cords[1];

		try { 
			$this->checkPositionInGrid($cords[0] , $cords[1] ). "<br />\n";
			echo 'Rover starts at '.$this->__PositionToString();
		} catch (Exception $e) { 
			echo 'Caught Exception: ',  $e->getMessage(), "<br />\n";
			die;
		} 
		
		$this->direction = $direction;
		$this->move($commands);
	}
	
	public function checkCommands($cords, $commands, $direction){
		if(!is_array($cords) || count($cords) < 2){
			echo "Cords must be an Array of two possible Cords.<br />";
		}
		if($commands == ""){
			echo "No commands given. Rover can not move.<br />";
		}
		if($direction == ""){
			echo "No direction given. Rover can not move.<br />";
		}
	}
	
	public function checkPositionInGrid($x, $y){
		if($x > $this->grid[0] || $y > $this->grid[1] || $x < 0 || $y < 0){
			throw new Exception("Position out of grid, Rover stops at : (".$this->x.", ".$this->y.")<br />");
		}
	}
	
	public function move($commands){
		$commands = str_split(strtolower($commands));
		foreach($commands as $command){
			$this->moveCommand($command);
		}
		echo "Out of commands, Rover stops at : (".$this->x.", ".$this->y.")<br />";
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
				echo "Rover doesn't understand your command : (".$command.")<br />";
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
			$new_y = $this->y+1;
			$new_x = $this->x;
		}else{
			$new_y = $this->y;
			$new_x = $this->x+1;
		}
		$this->possibleMove($new_x, $new_y);
	}
	// Viewpoint North & South moves at the at the y angle down
	// Viewpoint  East & West moves at the at the x angle down
		
	public function moveDownstairs(){
		if($this->direction == "N" || $this->direction == "S"){
			$new_y = $this->y-1;
			$new_x = $this->x;
		}else{
			$new_y = $this->y;
			$new_x = $this->x-1;
		}
		
		$this->possibleMove($new_x, $new_y);
		
	}	
	
	// Check if move is possible or out of Grid
	public function possibleMove($x, $y){
		try { 
			$this->checkPositionInGrid($x, $y). "\n";
			$this->x = $x;
			$this->y = $y;
			echo $this->__PositionToString();
		} catch (Exception $e) { 
			echo 'Caught Exception: ',  $e->getMessage(), "<br />\n"; 
			die;
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
		echo $this->__DirectionToString();
	}
	
	//Rover rotates in circle right
	
	public function setDirectionRight(){
		$direction_key = array_search($this->direction, $this->directions);
		if($direction_key != count($this->directions)-1){
			$this->direction = $this->directions[$direction_key+1];
		}else{
			$this->direction = $this->directions[0];
		}
		echo $this->__DirectionToString();
	}
	
    public function __PositionToString()
    {
        return sprintf('position: (%d, %d)<br />', $this->x, $this->y);
    }
	
    public function __DirectionToString()
    {
        return sprintf('move to: (%s)<br />', $this->direction);
    }
}

?>
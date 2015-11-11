<?php

class Rover {
	
	private $grid;
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
	
	public function moveForward(){
		
	}
	public function moveBackward(){
		
	}		
	
	public function setDirectionLeft(){
		$direction_key = array_search($this->direction, $this->directions);
		if($direction_key != 0){
			$this->direction =  $this->directions[$direction_key-1];
		}else{
			$this->direction =  $this->directions[count($this->directions)-1];
		}
	}
	
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
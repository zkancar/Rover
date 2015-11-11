<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'roverController.php';

$rover = new Rover;

$rover->start(array(10,10), 'fflfffrffrbbfffffffffflfffffffffffffffff', 'N');
?>
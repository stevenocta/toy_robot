<?php
namespace Toy\Robot;

require("classes/Robot.php");

echo "First Run: ";
$robot = new Robot();
$robot->place( 0, 0, $robot::NORTH );
$robot->move();
var_dump($robot->report());

echo "Second Run: ";
$robot->place( 0, 0, $robot::NORTH );
$robot->left();
var_dump($robot->report());

echo "Third Run: ";
$robot->place( 1, 2, $robot::EAST );
$robot->move();
$robot->move();
$robot->left();
$robot->move();
var_dump($robot->report());
?>
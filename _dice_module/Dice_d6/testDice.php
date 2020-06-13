#!/usr/bin/php
<?php
	require_once "Dice.class.php";
	Dice::$verbose = True;
	
	$dice = array($d6 = new Dice(6),$d3 = new Dice(3),$d7 = new Dice(7));
	
	$d6->rollDice(3);
	print($d6.PHP_EOL);
	
	$d3->rollDice(3);
	print($d3.PHP_EOL);

	$db = new DiceBox($dice);
	echo "Rolled a combined outcome of : ".$db->rollDice(3,6).PHP_EOL;
	
	$db->addDice($d7);
	$db->rollDice(3,7);
?>
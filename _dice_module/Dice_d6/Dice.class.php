#!/usr/bin/php
<?php
	class Dice
	{
		private $faces = 6;
		private $outcome;
		private $combined;
		private $timesRolled = 0;
		static $verbose = false;

		function __construct($faces)
		{
			if($this->faces)
				$this->faces = $faces;
		}
		function rollDice($num)
		{
			$this->resetDice();
			for($i = 0;$i < $num;$i++)
			{
				$this->combined += $this->rollDie();
				if(Dice::$verbose)
					echo sprintf("1d%d rolled a %d",$this->faces,$this->outcome).PHP_EOL;
			}

			return($this->combined);
		}
		function	getFaces()
		{
			return ($this->faces);
		}
		function rollDie()
		{
			$this->outcome = random_int(1,$this->faces);
			$this->timesRolled++;
			return ($this->outcome);
		}
		function getOutcome()
		{
			return ($this->outcome);
		}
		function getCombinedOutcome()
		{
			return (($this->combined ? $this->combined:$this->outcome));
		}
		function resetDice()
		{
			$this->timesRolled = 0;
			$this->combined = 0;
		}
		function __toString()
		{
			return sprintf("%dd%d : rolled an overall outcome of %d.", $this->timesRolled,$this->faces, $this->getCombinedOutcome());
		}
	}

	class DiceBox
	{
		private $dice;

		function __construct($array)
		{
			$this->dice = array();
			foreach($array as $die)
			{
				$this->addDice($die);
			}
		}

		function addDice(Dice $die)
		{
			foreach($this->dice as $dice)
			{
				if($dice->getFaces() == $die->getFaces())
				{
					echo sprintf("1d%d already in DiceBox.", $die->getFaces()).PHP_EOL;
					return ;
				}
			}
			echo sprintf("1d%d added to DiceBox.", $die->getFaces()).PHP_EOL;
			$this->dice[] = $die;
		}

		function rollDice($num, $size)
		{
			$i = 0;
			foreach($this->dice as $dice)
			{
				if($dice->getFaces() == $size)
				{
					$dice->rollDice($num);
					return($dice->getcombinedOutcome());
				}
			}
			echo sprintf("There are no %dd%d dice to roll", $num, $size).PHP_EOL;
		}
	}
?>
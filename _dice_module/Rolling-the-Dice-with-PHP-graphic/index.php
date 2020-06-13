<?PHP
	//Create array to log each roll
	$rollArray=array();
	
	$roll=rand(1,6); //Roll
	$rollArray[]=$roll; //Log roll
	echo "<img src=\"roll.php?roll=".$roll."\">"; //Get Image for roll	

	$roll=rand(1,6); //Roll
	$rollArray[]=$roll; //Log roll
	echo "<img src=\"roll.php?color=white-red&roll=".$roll."\">";//Get Image for roll
	
	$roll=rand(1,6); //Roll
	$rollArray[]=$roll; //Log roll
	echo "<img src=\"roll.php?color=black-white&roll=".$roll."\">";//Get Image for roll
	
	$roll=rand(1,6); //Roll
	$rollArray[]=$roll; //Log roll
	echo "<img src=\"roll.php?color=black-red&roll=".$roll."\">";//Get Image for roll

	echo "\n"
	."<p>Roll History:<br /><pre>\n"
	.print_r($rollArray, true)
	."</pre></p>\n";

	unset($rollArray);
?>

<?PHP
	//How will you log the roll?
	//The first instinct would be to use the session.
	//You won't need it. Read more below.
	//session_start();	
	
	putenv('GDFONTPATH=' . realpath('.'));
	$font="dice.ttf";
	
	//Generate image
	$im = imagecreatetruecolor(29, 30);
 
	//Generate available RGB colors
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 128, 128, 128);
	$red = imagecolorallocate($im, 153, 0, 0);
	$black = imagecolorallocate($im, 0, 0, 0);
 
	//Roll the dice here?
	//$roll=rand(1,6); //Create the roll on the calling page first!
	//Note: You could roll here, but you will have issues if you 
	//want to log the roll as the image (this script) loads AFTER the 
	//calling PHP page processes.
	
	if(
		isset($_GET["roll"]) && 
		is_numeric($_GET["roll"])
	){
		$roll=$_GET["roll"];	
	}else{
		die("");	
	}
	
	
	//Note: You can keep track of the rolls in a session array
	//However, this variable is only set after the image is loaded
	//which transpires AFTER the calling PHP page processes.
	//$_SESSION["roll"][]=$roll; //Use this on the calling page
	
	
	//Color options for the dice can be set by the url:
	//roll.php?color=black-red
	
	if(isset($_GET["color"])){
		$color=$_GET["color"];
		switch($color){
			case "white-red":
				//Fill the rectangle with a white background and red text
				imagefilledrectangle($im, 0, 0, 240, 40, $white);
				imagettftext($im, 20, 0, 1, 25, $red, $font, $roll);
				$debug="white-red set";
				break;
			case "black-white":
				//Fill the rectangle with a back background and white text
				imagefilledrectangle($im, 0, 0, 240, 40, $black);
				imagettftext($im, 20, 0, 1, 25, $white, $font, $roll);
				$debug="black-white set";
				break;
			case "black-red":
				//Fill the rectangle with a back background and red text
				imagefilledrectangle($im, 0, 0, 240, 40, $black);
				imagettftext($im, 20, 0, 1, 25, $red, $font, $roll);
				$debug="black-red set";	
				break;
		}
	}else{
		//Default color is a standard white die.
		//Fill the rectangle with a white background and black text
		imagefilledrectangle($im, 0, 0, 240, 40, $white);
		imagettftext($im, 20, 0, 1, 25, $black, $font, $roll);	
	}
 
	if(!isset($_GET["debug"])){
		//Prevent client side  caching
		header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	 
		//send image to browser
		header ("Content-type: image/gif");
		imagegif($im);

		//Kill it!
		imagedestroy($im);
	}else{
		echo "<p>Called:".$color."</p>";
		echo "<p>Set: ".$debug."</p>";	
	}
?>

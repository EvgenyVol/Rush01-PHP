<?php
class Dice {
    private $face_value; // A number from 1 to 6
    function __construct() {
        $this->face_value = 6;
    }
    // Roll the die:
    function roll() {
        $this->face_value = rand( 1, 6 ); // set face value to a random number from 1 to 6
    }
    // Return the face value (i.e. the number facing up):
    function get_face_value() {
        return $this->face_value; // Return the current face value
	}
	static public function doc()
    {
        return(file_get_contents('Dice.doc.txt'));
    }
}
$dice_one = new Dice();
$dice_two = new Dice();
​
?>
<!DOCTYPE html>
<html>
​
<head>
    <title>Dice Game</title>
    <style>
        table {
            border-collapse: collapse;
        }
​
        table th,
        table td {
            border: 1px solid black;
            padding: 5px;
        }
​
        td.p1 {
            background-color: pink;
        }
​
        td.p2 {
            background-color: lightblue;
        }
​
    </style>
</head>
​
<body>
<table>
    <tr>
        <th>Roll #</th>
        <th>Player One Rolled</th>
        <th>Player Two Rolled</th>
        <th>First Moves</th>
    </tr>
    <tbody>
    <?php
    for($i=1; $i<=1; $i++) {
        // Each time through loop, roll both dice
        $dice_one->roll();
        $dice_two->roll();
        // Get the face value after the roll and save it in variable
        $face_val_d1 = $dice_one->get_face_value();
        $face_val_d2 = $dice_two->get_face_value();
        // Figure out who won
        if($face_val_d1 > $face_val_d2){
            $whoWon = "Player One";
        }else if($face_val_d1 < $face_val_d2){
            $whoWon = "Player Two";
        }else{
            $whoWon = "Tie";
        }
        ?>
​
        <!-- Print to info to screen -->
        <tr>
            <td><?= $i; ?></td>
            <td><?= $face_val_d1; ?></td>
            <td><?= $face_val_d2; ?></td>
            <td><?= $whoWon; ?></td>
        </tr>
​
        <?php
    }
    ?>
    </tbody>
​
</table>
​
</body>
</html>
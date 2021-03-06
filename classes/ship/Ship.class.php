<?php

class Ship implements IShip
{
	//все ли поля в этом классе будут подтягиваться из бд?
	private $_id;
    private $_name;
    private $_weapon;
    private $_coordX;
	private $_coordY;
	private $_orientation;
	private $_handling;
    private $_ungle;
    private $_lenght;
    private $_hp;
    private $_pp;
    private $_sprite;
    private $_speed;
    private $_shield;
    private $_owner;
    private $_imgUrl;

    function __construct($id, $name, $weapon, $coordX, $coordY, $orientation, $handling, $length, $hp, $pp, $speed, $owner)
    {
    	$this->_id = $id;
        $this->setName($name);
        $this->setWeapon($weapon);
        $this->setCoord_x($coordX);
        $this->setCoord_y($coordY);
		$this->setOrientation($orientation);
		$this->_handling = $handling;
        $this->_lenght = $length;
        $this->_hp = $hp;
        $this->_pp = $pp;
        $this->_speed = $speed;
        $this->_owner = $owner; //написать геттеры/сеттеры?
    }
    public function setName($name)
    {
        $this->_name = $name;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setWeapon($weapon)
    {
        $this->_weapon = $weapon;
    }

    public function getWeapon()
    {
        return $this->_weapon;
    }

    public function setCoord_x($coord_x){
    	$this->_coordX = $coord_x;
    }
	public function setCoord_y($coord_y){
		$this->_coordY = $coord_y;
	}

    public function getCoord_x()
    {
	    return $this->_coordX;
    }

	public function getCoord_y()
	{
		return $this->_coordY;
	}
    public function doMove()
    {
	   if($this->_orientation === "up"){
	   	$this->_coordY--;
	   }
	   elseif($this->_orientation === "down"){
	   	$this->_coordY++;
	   }
	   elseif($this->_orientation === "left"){
	   	$this->_coordX--;
	   }
	   elseif($this->_orientation === "right"){
	   	$this->_coordX++;
	   }
    }

    public function setOrientation($orient)
    {
    	if(isset($orient)){
    		$this->_orientation = $orient;
	    }
    	else{
    		$this->_orientation = "right";
	    }
    }

    public function getOrientation()
    {
	    return $this->_orientation;
    }

    public function doRotate($ungle)
    {
	    if ($ungle == 90){
	    	if ($this->getOrientation() === "left"){
	    		$this->setOrientation("up");
	    		$this->setCoord_x($this->_coordX - intval(round($this->_lenght/2)));
	    		$this->setCoord_y($this->_coordY + intval(round($this->_lenght/2)));
		    }
	    	elseif ($this->getOrientation() === "up"){
			    $this->setOrientation("right");
			    $this->setCoord_x($this->_coordX - intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY - intval(round($this->_lenght/2)));
		    }
	    	elseif($this->getOrientation() === "right"){
			    $this->setOrientation("down");
			    $this->setCoord_x($this->_coordX + intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY - intval(round($this->_lenght/2)));
		    }
	    	elseif($this->getOrientation() === "down") {
			    $this->setOrientation("left");
			    $this->setCoord_x($this->_coordX + intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY + intval(round($this->_lenght/2)));
		    }
	    }
	    else{
		    if ($this->getOrientation() === "up"){
			    $this->setOrientation("left");
			    $this->setCoord_x($this->_coordX + intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY - intval(round($this->_lenght/2)));
		    }
		    elseif ($this->getOrientation() === "left"){
			    $this->setOrientation("down");
			    $this->setCoord_x($this->_coordX - intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY - intval(round($this->_lenght/2)));
		    }
		    elseif($this->getOrientation() === "down"){
			    $this->setOrientation("right");
			    $this->setCoord_x($this->_coordX - intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY + intval(round($this->_lenght/2)));
		    }
		    elseif($this->getOrientation() === "right"){
			    $this->setOrientation("up");
			    $this->setCoord_x($this->_coordX + intval(round($this->_lenght/2)));
			    $this->setCoord_y($this->_coordY + intval(round($this->_lenght/2)));
		    }
	    }
    }

    public function setUngle($ungle)
    {
    	$this->_ungle = $ungle;
    }

    public function getUngle()
    {
	    return $this->_ungle;
	}
	
	public function getPosition()
	{
		foreach (range(0, $this->_length) as $i) {
			if ($this->_orientaton == 'up') {
				$position[] = [$this->_coordX, $this->_coordY + $i];
			}
			if ($this->_orientaton == 'down') {
				$position[] = [$this->_coordX, $this->_coordY - $i];
			}
			if ($this->_orientaton == 'left') {
				$position[] = [$this->_coordX - $i, $this->_coordY];
			}
			if ($this->_orientaton == 'right') {
				$position[] = [$this->_coordX + $i, $this->_coordY];
			}
		}
	}

	public function getShipHP()
	{
		return ['hp'=>$this->_hp, 'shield'=>$this->_shield];
	}
}

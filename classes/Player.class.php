<?php

require_once ('ship/Ship.class.php');
require_once ('ship/ShipFactory.class.php');
require_once ('Color.class.php');

/**
 * Class Player
 */
class Player {
    const FIRST_PLAYER_COLOR = 0x4527A0;    // '#4527A0'
    const SECOND_PLAYER_COLOR = 0xFB8C00;   // '#FB8C00'
    /**
     * User name
     * @var string
     */
    private $_name;
    /**
     * User color
     * @var Color
     */
    private $_color;
    /**
     * 1 if you are the first user
     * 2 if you are the second user
     * correlates to Ship owner
     * @var int
     */
    private $_position;
    /**
     * storage for all the player ships
     * @var array
     */
    private $_fleet;
    private static $_doc = './Player.doc.txt';

    public function __construct(array $kwargs)
    {
        if (array_key_exists('name', $kwargs))
            $this->name = $kwargs['name'];
        else
            $this->_name = "Anonimus Abyss";
        if (@$kwargs['position'] == 1) {
            $this->_position = 1;
            $this->_color = self::FIRST_PLAYER_COLOR;
        } else {
            $this->_position = 2;
            $this->_color = self::SECOND_PLAYER_COLOR;
        }
        $this->_getFleet();
    }

    private function _getFleet()
    {
        $x = $this->_position == 1 ? 0 : 149;
        $y = $this->_position == 1 ? 0 : 100;
        $orientation = $this->_position == 1 ? 'down' : 'up';

        $this->_fleet[1] = new Ship(1,
                                    "Hand Of The Emperor",
                                    new SideLaserBatteries(),
                                    $x,
                                    $y,
                                    $orientation,
                                    5,
                                    4,
                                    10,
                                    10,
                                    15,
                                    $this->position);
        $this->_fleet[2] = new Ship(2,
                                    "Sword Of Absolution",
                                    new SideLaserBatteries(),
                                    $x+1,
                                    $y,
                                    $orientation,
                                    3,
                                    3,
                                    10,
                                    10,
                                    18,
                                    $this->position);
    }

    /**
     * @return string
     */
    public function getUserName() {
        return $this->name;
    }

    /**
     * @return Color
     */
    public function getUserColor() {
        return $this->color;
    }

    /**
     * @return array
     */
    public function getShipsPosition()
    {
        $positions = array();
        foreach ($_fleet as $s) {
            $shipPosition = $s->getPosition();
            $positions[] = [$s->getId() => $shipPosition];
        }
        return $positions;
    }
    public function getShipHp($id)
    {
        return $this->_fleet[$id]->getShipHp();
    }

    public function removeShip($id)
    {
        unset($this->_fleet[$id]);
    }

    public static function doc() {
        if (file_exists(self::$_doc)) {
            return file_get_contents(self::$_doc);
        }
    }


}
?>
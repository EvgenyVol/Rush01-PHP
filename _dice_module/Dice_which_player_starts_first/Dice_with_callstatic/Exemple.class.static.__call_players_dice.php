
<?php
//https://www.php.net/manual/ru/language.oop5.overloading.php#object.call
//https://elearning.intra.42.fr/notions/piscine-php-d06-introduction-to-object-oriented-programming-with-php/subnotions/piscine-php-d06-introduction-to-object-oriented-programming-with-php-__call-__callstatic/videos/__call-__callstatic
// There is no too much info

Class Exemple {

    public function __construct() {
        print('Constructor called' . PHP_EOL);
        return;
    }

    public function __destruct()
    {
        print ('Destructor called' . PHP_EOL);
        return;
    }
    public function __call($f, $args)
    {
        print ('Attempt to call function for  \'' . $f . '\' with dice thrown face-values ' );
        print_r($args);
        return;
    }
    public static function __callstatic($f, $args)
    {
        print ('Attempt to call static function for \'' . $f . '\' with dice face-values ' );
        print_r($args);
        return;
    }

}


$instance = new Exemple();
$instance->player1(rand(1,6));
Exemple::player2(rand(1,6));

/*
StudentRemoteMac:php_p_video Student$ php Exemple.class.static.__call.php
Constructor called
Attempt to call function for  'player1' with dice thrown face-values Array
(
    [0] => 6
)
Attempt to call static function for 'player2' with dice face-values Array
(
    [0] => 1
)
Destructor called
 */
    ?>
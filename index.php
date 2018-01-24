<?php
$d = new Paiza();

class Paiza
{
    function __construct() {
        $STDIN = fopen('./stdin.txt', 'r');
        list($this->o_y, $this->s, $this->theta) = preg_split('/ /', chop(fgets($STDIN)));
        list($this->x, $this->y, $this->a) = preg_split('/ /', chop(fgets($STDIN)));
    }
}

?>


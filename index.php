<?php
/*
 */

$p = new Paiza();
$p->init();

class Paiza
{
    public $k;
    public $s;
    public $t;

    function __construct() {
        $STDIN = fopen('./stdin.txt', 'r');
        list($this->k, $this->s, $this->t) = preg_split('/ /', chop(fgets($STDIN)));
    }

    public function init() {
        $result = '';

        echo $result;
    }
}

?>


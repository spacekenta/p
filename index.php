<?php
/*
 * 
 */


$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $n;

    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        $this->n = chop(fgets($this->STDIN));
    }

    public function init() {
        $result = 0;

        echo $result . "\n";
    }


}

?>


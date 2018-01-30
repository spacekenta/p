<?php
/*
 */
$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $a;
    public $b;
    public $n;


    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        list($this->a, $this->b, $this->n) = preg_split('/ /', chop(fgets($this->STDIN)));
    }

    public function init() {
        $result = '';


        echo $result;
    }
}

?>


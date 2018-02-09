<?php
/*
 */

$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $s;


    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        $this->s = chop(fgets($this->STDIN));
    }

    public function init() {

        echo $result;
    }


?>


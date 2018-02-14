<?php
/*
 * 
 */


$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $a;

    function __construct() {
        $this->STDIN = fopen('./s004.txt', 'r');
        $this->a = str_split(chop(fgets($this->STDIN)));
    }

    public function init() {
        $result = '';
        echo $result;
    }


}

?>


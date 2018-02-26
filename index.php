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
        $this->STDIN = fopen('./stdin.txt', 'r');
        $this->a = str_split(chop(fgets($this->STDIN)));
    }

    public function init() {
        $result = date('Y-m-d H:i:s');
        echo $result;
    }


}

?>


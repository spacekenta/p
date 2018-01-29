<?php
/*
 */
$p = new Paiza();
$p->init();

class Paiza
{
    public $m;
    public $n;
    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        list($this->m, $this->n) = preg_split('/ /', chop(fgets($this->STDIN)));
    }

    public function init() {
        $result = '';

        echo $result;
    }
}

?>


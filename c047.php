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
    public $f = array();

    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        $this->n = chop(fgets($this->STDIN));
        for ($i = 0; $i < $this->n; ++$i) {
            array_push($this->f, chop(fgets($this->STDIN)));
        }
    }

    public function init() {
        $pos = 1;
        $result = 0;


        foreach ($this->f as $n) {
            $result = $result + abs($pos - $n);
            $pos = $n;
        }

        echo $result . "\n";
    }


}

?>


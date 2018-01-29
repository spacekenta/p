<?php
/*
 */

$p = new Paiza();
$p->init();

class Paiza
{
    public $a;
    public $b;

    function __construct() {
        $STDIN = fopen('./d002.txt', 'r');
        list($this->a, $this->b) = preg_split('/ /', chop(fgets($STDIN)));
    }

    public function init() {
        $result = 'eq';

        if ($this->a < $this->b) {
            $result = $this->b;
        } else if ($this->a > $this->b) {
            $result = $this->a;
        }

        echo $result;
    }
}

?>


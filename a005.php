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

        $arr = preg_split('/ /', str_replace('G', '0', chop(fgets($this->STDIN))));

        $i = 0;
        $score = 0;
        $game = array();
        $round = 1;

        while ($i < $this->n) {
            $score = $arr[$i];
            $game[$round][] = $score;
            if (count($game[$round]) == 2 || $score == $this->b) {
                ++$round;
            }
            ++$i;
        }

        $result = 0;
        $plus_score = 0;
        foreach ($game as $n => $g) {
            if (count($g) == 1) {
                // ストライク
                if (count($game[$n + 1]) == 1) {
                    $result = $result + $g[0] + $game[$n + 1][0] + $game[$n + 2][0];
                } else {
                    $result = $result + $g[0] + $game[$n + 1][0] + $game[$n + 1][1];
                }

            } else if ($g[0] + $g[1] == $this->b) {
                // スペア
                $result = $result + $g[0] + $g[1] + $game[$n + 1][0];

            } else {
                // 通常
                $result = $result + $g[0] + $g[1];
            }
        }

        echo $result;
    }
}

?>


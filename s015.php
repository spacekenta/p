<?php
/*
 *レベル 1 の ABC 文字列は "ABC" です。
 *レベル k の ABC 文字列は "A" + (レベル k - 1 の ABC 文字列) + "B" + (レベル k - 1 の ABC 文字列) + "C" です。
 *例 : レベル 2 の ABC 文字列は "A" + "ABC" + "B" + "ABC" + "C" = "AABCBABCC" となります。
 *
 * レベル k の ABC 文字列の s 文字目から t 文字目までを出力してください。
 */

$p = new Paiza();
$p->init();

class Paiza
{
    public $k;
    public $s;
    public $t;

    function __construct() {
        $STDIN = fopen('./s015.txt', 'r');
        list($this->k, $this->s, $this->t) = preg_split('/ /', chop(fgets($STDIN)));
    }

    public function init() {
        $text = $this->getStr($this->k);
        $start = $this->s - 1;
        $end = $this->t;
        $result = mb_substr(
            $text,
            $start,
            $end - $start
        );

        echo $result;
    }

    private function getStr($lv) {
        if ($lv === 0) {
            return '';
        }
        return join($this->getStr($lv - 1), array('A','B','C'));
    }
}
?>


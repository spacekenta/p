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
    public $str = 'ABC';
    public $k;
    public $s;
    public $t;

    function __construct() {
        $STDIN = fopen('./s015.txt', 'r');
        list($this->k, $this->s, $this->t) = preg_split('/ /', chop(fgets($STDIN)));
    }

    public function init() {
        $result = '';
        $level_str_list = array();
        $level_str_list[0] = '';
        $char_list = preg_split('//u', $this->str, -1, PREG_SPLIT_NO_EMPTY);

        for ($level = 1; $level <= $this->k; $level++) {
            $level_str = join($level_str_list[$level - 1], $char_list);
            $level_str_list[$level] = $level_str;
        }

        $start = $this->s - 1;
        $end = $this->t;
        $result = mb_substr(
            $level_str_list[$this->k],
            $start,
            $end - $start
        );

        echo $result;
    }
}

?>


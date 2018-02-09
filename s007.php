<?php
/*
 */

$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $s;
    public $b;
    public $n;


    function __construct() {
        $this->STDIN = fopen('./stdin.txt', 'r');
        $this->s = chop(fgets($this->STDIN));
    }

    public function init() {

        $result = array();
        foreach (array_flip(range('a','z')) as $k => $v) {
            $result[$k] = 0;
        }

        while (preg_match('/\d/', $this->s)) {
            $total = $this->strBlock();

            foreach ($total as $k => $v) {
                if ($result[$k] > 0) {
                    $result[$k] = bcmul($result[$k], $total[$k]);
                } else {
                    $result[$k] = $total[$k];
                }
            }
        }

        // 出力
        foreach ($result as $k => $v) {
            echo $k . ' ' . $v . "\n";
        }
    }

    public function strBlock() {
        $result = array();
        foreach (array_flip(range('a','z')) as $k => $v) {
            $result[$k] = 0;
        }

        // 数字（文字列）の形に全体を統一
        while (preg_match('/(\d+)([a-z])/', $this->s, $arr)) {
            $this->s = str_replace($arr[0], $arr[1] . '(' . $arr[2] . ')', $this->s);
        }
        while (preg_match('/\)([a-z])/', $this->s, $arr)) {
            $this->s = str_replace($arr[1], '1(' . $arr[1] . ')', $this->s);
        }

        // 出て来る文字列ブロックを抽出
        preg_match_all('/\([a-z]+\)/', $this->s, $arr);

        // 文字列ブロックごとに処理
        foreach ($arr[0] as $block) {
            $text = $this->s;
            $str = preg_replace('/[\(\)]/', '', $block);

            // かかっている数値を取得
            preg_match('/(\d+)\(' . $str . '\)/', $this->s, $res);

            // ブロックの個々の文字毎に算出
            foreach (str_split($str) as $char) {
                $result[$char] = $result[$char] + $res[1];
            }

            // 処理の完了したブロックは数値の除いた文字列に置き換え
            $this->s = str_replace($res[0], $str, $this->s);
        }

        return $result;
    }

    public function init1() {
        $s = $this->s;

        while (preg_match('/(\d+?)\(([\d\w]+?)\)/', $s, $arr)) {
            $rep = '';
            for ($i = 0; $i < $arr[1]; ++$i) {
                $rep = (string)$rep . (string)$arr[2];
            }
            $s = str_replace($arr[0], $rep, $s);
        }

        while (preg_match('/(\d+)(\w)/', $s, $arr)) {
            $rep = '';
            for ($i = 0; $i < $arr[1]; ++$i) {
                $rep = (string)$rep . (string)$arr[2];
            }
            $s = str_replace($arr[0], $rep, $s);
        }

        $a = range('a','z');
        foreach ($a as $b) {
            preg_match_all('/' . $b . '/', $s, $arr);
            echo $b . ' ' . count($arr[0]) . "\n";
        }
    }
}

?>


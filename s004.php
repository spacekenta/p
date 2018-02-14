<?php
/*
 * 評価40点
 */


$p = new Paiza();
$p->init();

class Paiza
{
    public $STDIN;
    public $a;
    public $b;
    public $s;
    public $ra;
    public $rb;
    public $rs;

    function __construct() {
        $this->STDIN = fopen('./s004.txt', 'r');
        $this->a = str_split(chop(fgets($this->STDIN)));
        $this->b = str_split(chop(fgets($this->STDIN)));
        $this->s = str_split(chop(fgets($this->STDIN)));
        $this->ra = $this->a;
        $this->rb = $this->b;
        $this->rs = $this->s;
    }

    public function init() {
        $result = array();
        $res = array();

        // 選択パターン確認
        $pos = 0;
        while ($char = array_shift($this->s)) {
            $res[$pos] = array();

            $a = array_search($char, $this->a);
            if ($a !== false) {
                $res[$pos][] = 'a';
            }

            $b = array_search($char, $this->b);
            if ($b !== false) {
                $res[$pos][] = 'b';
            }
            ++$pos;
        }
        $p = array();
        foreach ($res as $char => $arr) {
            $p = $this->comb($p, $arr);
        }
        $this->s = $this->rs;

        // カードをパターンに沿って処理
        foreach ($p as $n => $arr) {
            $result[$n] = 0;

            // カウントしながらカードを取っていく
            foreach ($arr as $card) {
                $char = array_shift($this->s);
                $pos = array_search($char, $this->{$card}) + 1;
                $result[$n] = $result[$n] + $pos;
                $this->shiftCards($card, $pos);
            }

            // カードの山を戻す
            $this->s = $this->rs;
            $this->a = $this->ra;
            $this->b = $this->rb;
        } 

        // パターン中の最小値を出力
        echo min($result);
    }

    public function shiftCards($cards, $count) {
        for ($i = 0; $i < $count; ++$i) {
            array_shift($this->{$cards});
        }
    }

    public function comb($a, $b) {
        $res = array();
        if (empty($a) && !empty($b)) {
            return $b;
        } else if (!empty($a) && empty($b)) {
            return $a;
        }

        foreach ($a as $va) {
            foreach ($b as $vb) {
                $res[] = array_merge((array)$va, (array)$vb);
            }
        }
        return $res;
    }


}

?>


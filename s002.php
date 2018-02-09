<?php
/*
 * 大規模データでタイムアウト
 */
$p = new Paiza();
$p->init();

class Paiza
{
    public $m;
    public $n;
    public $STDIN;

    public $posx;
    public $posy;
    public $sposx;
    public $sposy;
    public $gposx;
    public $gposy;

    public $fields = array();
    public $move = array(
        array(-1,  0),
        array( 1,  0),
        array( 0, -1),
        array( 0,  1),
    );

    function __construct() {
        $this->STDIN = fopen('./s002.txt', 'r');
        list($this->m, $this->n) = preg_split('/ /', chop(fgets($this->STDIN)));

        $this->setFields();
        $this->setStart();
        $this->setGoal();
    }

    public function init() {
        $result = '';
        $que = array();

        $pos = array(
            'x'   => $this->sposx,
            'y'   => $this->sposy,
            'val' => $this->fields[$this->sposy][$this->sposx],
            'count' => 0,
            'ref' => array(),
        );
        $que[] = $pos;

        while ($q = array_shift($que)) {

            if ($q['val'] === 'g') {
                // gだったら即終了
                break;
            }

            foreach ($this->move as $m) {
                $x = $q['x'] + $m[0];
                $y = $q['y'] + $m[1];

                // 未定義の場所には行かない
                if (!isset($this->fields[$y][$x])) {
                    continue;
                }

                // 値が1の場所には行かない
                if ($this->fields[$y][$x] == 1) {
                    continue;
                }

                // 値がsの場所には行かない
                if ($this->fields[$y][$x] == 's') {
                    continue;
                }

                // 既に行った場所には行かない
                if (array_search($y . ',' . $x, $q['ref']) != false) {
                    continue;
                }

                // 次に移動する場所を配列へ
                $pos = array(
                    'x'     => $x,
                    'y'     => $y,
                    'val'   => $this->fields[$y][$x],
                    'count' => $q['count'] + 1,
                );
                $pos['ref'] = $q['ref'];
                $pos['ref'][] = $q['y'] . ',' . $q['x'];
                $que[] = $pos;
            }
        }

        if ($q['count'] > 0) {
            echo $q['count'];
        } else {
            echo 'Fail';
        }
    }

    public function setFields() {
        $fields = array();
        for ($n = 1; $n <= $this->n; ++$n)  {
            $this->fields[$n - 1] = preg_split('/ /', chop(fgets($this->STDIN)));
        }
    }
    public function setStart() {
        foreach ($this->fields as $n => $v)  {
            if (array_search('s', $this->fields[$n]) == true) {
                $this->sposx = array_search('s', $this->fields[$n]);
                $this->sposy = $n;
            }
        }
    }

    public function setGoal() {
        foreach ($this->fields as $n => $v)  {
            if (array_search('g', $this->fields[$n]) == true) {
                $this->gposx = array_search('g', $this->fields[$n]);
                $this->gposy = $n;
            }
        }
    }

}

?>


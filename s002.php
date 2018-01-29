<?php
/*
 * 回答に至らず
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
        $this->STDIN = fopen('./stdin.txt', 'r');
        list($this->m, $this->n) = preg_split('/ /', chop(fgets($this->STDIN)));

        $this->setFields();
        $this->setStart();
        $this->setGoal();
    }

    public function init() {
        $result = '';

        // ゴールに着くまで繰り返し
        while (1) {
            // 位置の初期化 
            $this->resetPos();

            // 進路確認
            $res = $this->searchRoot();

            if (array_search(true, $res) == false) {
                // 確認先の進路に進行可能なマスがない場合は終了
            } else {
                // 進行可能なマスがある場合は記録を残して進む
            }

        }

        echo $result;
    }

    public function resetPos() {
        $this->posx = $this->sposx;
        $this->posy = $this->sposy;
        $this->root_list = array($this->sposx . ',' . $this->sposy);
    }

    public function searchRoot() {
        while (1) {
            $this->resetPos();


            foreach ($this->move as $k => $m) {
                $check_pos[$k] = $this->checkPos($m[0], $m[1]);
            }

        }
    }

    public function movePos($check_pos) {
        foreach ($check_pos as $v) {
            if ()
        }



        return 0;

        $root_list = array();

        while (1) {
            $this->posx = $this->sposx;
            $this->posy = $this->sposy;


            foreach ($this->move as $m) {
                $check_pos = $this->checkPos($m[0], $m[1]);

                $root_list[] = array(
                    'x'   => $this->posx + $m[0],
                    'y'   => $this->posy + $m[1],
                    'res' => $check_pos,
                );


                if ($check_pos == false) {
                    continue;
                } else if ($this->fields[$this->posy + $m[1]][$this->posx + $m[0]] == 'g') {
                    return $root_list;
                } else {
                    $this->posx = $this->posx + $m[0];
                    $this->posy = $this->posy + $m[1];
                }
            }


        }
    }

    public function checkPos($x, $y) {
        $px = $this->posx;
        $py = $this->posy;
        $pos = $px . ',' . $py;

        if (!isset($this->fields[$py + $y][$px + $x])) {
            return false;
        } else if ($this->fields[$py + $y][$px + $x] === 1) {
            return false;
        } else if (array_search($pos, $this->root_list) == true) {
            return false;
        }

        return true;
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


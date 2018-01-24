<?php
$d = new Darts();
echo $d->throwDarts() . "\n";


class Darts
{
    public $o_y;   // 0 ≦ o_y[初期位置の高さ m] ≦ 100
    public $s;     // 1 ≦ [初速 m/s] ≦ 100
    public $theta; // 0 ≦ θ[度] ≦ 90
    public $x;     // 1 ≦ x[的までの距離 m] ≦ 100
    public $y;     // 0 ≦ y[的の高さ m] ≦ 100
    public $a;     // 1 ≦ a[的の直径 m] ≦ 100
    public $g = '9.8';

    public $hit = 'Hit';
    public $miss = 'Miss';

    function __construct() {
        $STDIN = fopen('./b006.txt', 'r');
        list($this->o_y, $this->s, $this->theta) = preg_split('/ /', chop(fgets($STDIN)));
        list($this->x, $this->y, $this->a) = preg_split('/ /', chop(fgets($STDIN)));
    }

    public function throwDarts() {

        $dy = $this->dy();
        $size = $this->a / 2;

        if ($dy < $this->y + $size && $dy > $this->y - $size) {
            return $this->hit . ' ' . round(abs($this->y - $dy), 1);
        } else {
            return $this->miss;
        }

    }

    private function dy() {
        $cos2theta = (cos(deg2rad($this->theta * 2)) + 1) / 2;

        $a = $this->x * tan(deg2rad($this->theta));

        $b_1 = $this->g * $this->x * $this->x;
        $b_2 = 2 * $this->s * $this->s * $cos2theta;

        $b = $b_1 / $b_2;

        $y = $this->o_y + $a - $b;
        return $y;
    }

}

?>



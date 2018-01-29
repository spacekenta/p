<?php
ini_set('memory_limit', '2048M');
$STDIN = fopen('./s015.txt', 'r');
list($k, $s, $t) = preg_split('/ /', trim(fgets($STDIN)));

$t0 = microtime(true);

$l = array('A', 'B', 'C');
$text   = '';
$lv     = 1;
while ($lv <= $k) {
    $text = join($text, $l);
    ++$lv;
}

$result = '';
$start  = $s - 1;
$end    = $t;
$result = substr($text, $start, $end - $start);
echo $result . "\n";

$t1 = microtime(true);
echo $t1 - $t0 . "\n";
exit;


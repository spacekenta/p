<?php
ini_set('memory_limit', '2048M');
$STDIN = fopen('./s015.txt', 'r');
list($k, $s, $t) = preg_split('/ /', trim(fgets($STDIN)));


$p = getBlockList($k);
echo getTargetText($k, $p, $s, $t) . "\n";
exit;
$text = getBlockText($k, $p);
echo substr($text , ($s - 1), $t - ($s - 1)) . "\n";

exit;
function getTargetText($k, $p, $s, $t) {
    $len = $t - ($s - 1); // 返す文字数
    $len_count = 0; // 位置
    $text = '';
    $res;
    $start = 0;

    if ($t <= $k) {
        // 終点が最初のブロックにある場合は即結果を返す
        $res = str_repeat('A', $len);
    } else {

        // 最初のブロック処理
        if ($s <= $k) {
            // 基点が最初のブロックに存在する場合はテキストを組み立て始める
            $add_text = str_repeat('A', $k);
            $text = $text . $add_text;
            if (empty($start)) {
                $start = $s - $len_count;
            }
        }
        $len_count = $len_count + $k;

        // 中間ブロック処理
        foreach ($p as $n) {
            // 処理される文字数
            $add_count = ($n + 1) * 2;

            // 基点があるか
            if ($s <= $len_count + $add_count) {
                // このブロックに基点が存在するならばテキストを組み立て始める
                $add_text = 'B' . str_repeat('C', $n) . 'B' . str_repeat('A', $n);
                $text = $text . $add_text;
                if (empty($start)) {
                    $start = $s - $len_count;
                }
            }

            // 終点があるか
            if ($t <= $len_count + $add_count) {
                // あればテキストを組み立てて結果を返す
                $res = substr($text ,$start - 1 , $len);
                break;
            }

            // カウントを進める
            $len_count = $len_count + $add_count;
        }

        // 最終ブロック処理
        $add_count = $k + 1;
        if (empty($res) && $t <= $len_count + $add_count) {
            $add_text = 'B' . str_repeat('C', $k);
            $text = $text . $add_text;
            if (empty($start)) {
                $start = $s - $len_count;
            }
            $res = substr($text ,$start - 1 , $len);
        }
    }

    return $res;
}
function getBlockList($k) {
    $p = array();

    if ($k <= 1) {
        return $p;
    }

    $p = array($k - 1);
    $n = $k - 2;
    if ($n <= 0) {
        return $p;
    }

    while ($n >= 1) {
        $res = array();
        $res[] = $n;

        foreach ($p as $v) {
            $res[] = $v;
            $res[] = $n;
        }

        $p = $res;
        --$n;
    }

    return $p;
}
function getBlockText($k, $p) {
    $text = str_repeat('A', $k);
    if (!empty($p) && is_array($p)) {
        foreach ($p as $n) {
            $text = $text . 'B' . str_repeat('C', $n);
            $text = $text . 'B' . str_repeat('A', $n);
        }
    }
    $text = $text . 'B' . str_repeat('C', $k);
    return $text;
}






function t($k) {
    $p = '';
    if ($k > 1) {
        $p = '%' . ($k - 1) . '%';
        $n = $k - 2;

        if ($n > 0) {
            while ($n > 1) {
                $m = '%' . $n . '%';

                if (preg_match('/,/', $p)) {
                    $p = preg_split('/,/', $p);
                } else {
                    $p = array($p);
                }

                $p = $m . join($m, $p) . $m;
                $p = str_replace('%%', '%,%', $p);

                --$n;
            }

            $p = '%1%' . join('%1%', preg_split('/,/', $p)) . '%1%';
        }

        $p = str_replace('%%', '%,%', $p);
    }
    var_dump($p);
exit;
    $text = str_repeat('A', $k);
    if (!empty($p)) {
        $p = preg_split('/,/', $p);
        foreach ($p as $n) {
            $m = str_replace('%', '', $n);
            $text = $text . 'B' . str_repeat('C', $m);
            $text = $text . 'B' . str_repeat('A', $m);
        }
    }

    $text = $text . 'B' . str_repeat('C', $k);
    return $text;
}

exit;
/////////////////////////////////////////////////////
$l = array('A', 'B', 'C');
$text   = '';
$lv     = 1;
while ($lv < $k) {
    $text = join($text, $l);
    ++$lv;
}
echo substr(join($text, $l), ($s - 1), $t - ($s - 1)) . "\n";
exit;


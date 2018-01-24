<?php
define('STDIN_FILE', './test.txt');

$STDIN = fopen(STDIN_FILE, 'r');
//$input_lines = fgets($STDIN);

$ipaddress = fgets($STDIN);
$log_lines = fgets($STDIN);

$month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$regex_parts = preg_split('/\./', chop($ipaddress));

$result = array();
$l = 0;
while ($l < $log_lines) {
    $line = fgets($STDIN);
    preg_match_all('/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3}) /', $line, $parts);

    $flag = 0;
    for ($p = 0; $p < 4; $p++) {

        if (preg_match('/^\d{1,3}$/', $regex_parts[$p]) == true) {

            // 数値での比較
            if ($parts[$p + 1][0] != $regex_parts[$p]) {
                $flag = 1;
            }

        } else if ($regex_parts[$p] != '*') {

            // 範囲指定がされている場合の比較
            $regex = preg_split('/-/', preg_replace('/[\[|\]]/', '', $regex_parts[$p]));
            if ($regex[0] > $parts[$p + 1][0] || $regex[1] < $parts[$p + 1][0]) {
                $flag = 1;
            }
        }
    }

    if ($flag == 0) {
        preg_match('/(\d{2})\/(\w{3})\/(\d{4}):(\d{2}):(\d{2}):(\d{2})/', $line, $t);
        $timestamp = mktime($t[4], $t[5], $t[6], array_search($t[2], $month) + 1, $t[1], $t[3]);

        preg_match('/GET ([^\s]*?) /', $line, $filename);

        $result[$timestamp . $l] = join(' ', array(chop($parts[0][0]), chop($t[0]), chop($filename[1])));
    }
    $l++;
}
sort($result);
echo join("\n", $result);
//不正解

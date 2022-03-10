<?php
// 時間から秒へ変換(00:00:00→00000秒)
function hour_to_sec(string $str): int
{
    $t = explode(":", $str); //配列（$t[0]（時）、$t[1]（分）、$t[2]（秒））にする
    $h = (int)$t[0];
    if (isset($t[1])) { //分の部分に値が入っているか確認
        $m = (int)$t[1];
    } else {
        $m = 0;
    }
    if (isset($t[2])) { //秒の部分に値が入っているか確認
        $s = (int)$t[2];
    } else {
        $s = 0;
    }
    return ($h * 60 * 60) + ($m * 60) + $s;
}
?>

<?php
$test1 = new DateTime('11/06/2017');
echo date_format( $test1, 'Ymd');
echo '<hr>';

$format2 = 'Y-m-d';
$test2 = DateTime::createFromFormat( $format2, '2017-06-11');
// var_dump($test2);
// echo "Format: $format;". $test2->format($format);
echo $test2->format('Ymd');
echo '<hr>';

$format3 = 'Ymd';
$test3 = DateTime::createFromFormat( $format3, '20170611');
echo $test3->format('Y-m-d') . '<br>';

$str1 = "003";
echo (int) $str1 . '<br>';

$str2 = "027";
echo (int) $str2 . '<br>';

$str3 = "013";
$num3 = (int) $str3;
echo $num3 . '<br>';

$str4 = "109";
$num4 = (int) $str4;
echo $num4 . '<br>';

$str5 = "910";
$num5 = (int) $str5;
echo $num5 . '<br>';


?>

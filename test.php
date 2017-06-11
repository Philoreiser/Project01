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
echo $test3->format('Y-m-d');

?>

<?php

include "pdo_sql.php";
include "myPhpAPIs.php";

$seat = array();

$handle = @fopen("./OpenData/seat_ver170610.txt","r");

// $handle = @fopen("http://www.railway.gov.tw/Upload/UserFiles/seat.txt","r");
$count = 0;
if ($handle) {
    while (($buffer = fgets($handle)) !== false ) {
        $seat [] = $buffer;
        $count++;
    }

    // echo '<hr>';
    // echo "count: {$count}".'<br>';

    foreach ($seat as $index=>$code) {
        
        $data = myParseSeatCode($code,$mySeatFormat);
        echo $index .":" . '<br>';
        var_dump($data);
        foreach ( $data as $key=>$val) {
            echo "{$key} : {$val} /";
        }
        echo '<br>';

        
    }

    fclose($handle);
}
?>
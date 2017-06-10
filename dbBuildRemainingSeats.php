<?php

$seat = array();

$handle = @fopen("./OpenData/seat_ver170610.txt","r");

// $handle = @fopen("http://www.railway.gov.tw/Upload/UserFiles/seat.txt","r");
$count = 0;
if ($handle) {
    while (($buffer = fgets($handle)) !== false ) {
        $seat [] = $buffer;
        $count++;
    }
    //var_dump($seat);

    // if (!eof($handle)) {
    //     echo "Error: unexpected fgets() fail\n";
    // }

    echo '<hr>';
    echo "count: {$count}".'<br>';
    foreach ($seat as $index=>$data) {
        
        $rest = substr($data, 0, 22);
        $len = strlen($rest);
        echo "{$index}=>{$rest}:{$len}" . '<br>';
        
        // $len = strlen($data);
        // echo "{$data}:{$len}" . '<br>';
    }

    fclose($handle);
}
?>
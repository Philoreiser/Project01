<?php

include "pdo_sql.php";
include "myPhpAPIs.php";

// $seat = array();

$handle = @fopen("./OpenData/seat_ver170610.txt","r");
// $handle = @fopen("http://www.railway.gov.tw/Upload/UserFiles/seat.txt","r");

if ($handle) {
    $pdo = @new pdo($pdo_dsn, $db_user, $db_password, $pdo_opt);
    $sql = "INSERT INTO Tickets( date, train, depStation, arrStation, tickets) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    
    while (($code = fgets($handle)) !== false ) {
        // $code = $buffer;
        // var_dump($code);

        $data = myParseSeatCode($code, $mySeatFormat);
        // var_dump($data);
        $stmt->execute($data);

    }

    fclose($handle);
}
?>
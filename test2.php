<?php

include "pdo_sql.php";

$date = '20170608';
$train = '754';
$depStation = '100';
$arrStation = '158';

$pdo = @new pdo($pdo_dsn, $db_user, $db_password, $pdo_opt);
$sql_tickets = "SELECT date, train, depStation, arrStation, tickets FROM Tickets WHERE date = ? AND depStation = ? AND arrStation = ?";
$sql_stnInfo = "SELECT StnChtName, StnEngName FROM StationsInfo WHERE StnCode_3 = ?";

// $depStnInfo = array();
// $arrStnInfo = array();

$stmt = $pdo->prepare($sql_stnInfo);
echo "Depart: {$depStation}".'<br>';
$stmt->execute([$depStation]);
$rs = $stmt->fetch(PDO::FETCH_ASSOC);
// $rs = $stmt->fetch(PDO::FETCH_BOTH);
foreach ($rs as $key => $val) {
    echo "$key: $val\t";
}
echo '<hr>';
echo "Arrive: {$arrStation}".'<br>';
$stmt->execute([$arrStation]);
$rs = $stmt->fetch(PDO::FETCH_ASSOC);
// $rs = $stmt->fetch(PDO::FETCH_BOTH);
foreach ($rs as $key => $val) {
    echo "$key: $val\t";
}
echo '<hr>';



$stmt = $pdo->prepare($sql_tickets);
// $stmt->execute([$date, $train]);
$stmt->execute([$date, $depStation, $arrStation]);

// var_dump($stmt);
while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    foreach ($rs as $key => $val) {
        echo "$key: $val\t";
    }
    echo "<br>";

}


?>
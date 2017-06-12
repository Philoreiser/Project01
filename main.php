<?php

include "pdo_sql.php";

$date = '20170622';
$train = '754';

$pdo = @new pdo($pdo_dsn, $db_user, $db_password, $pdo_opt);
$sql = "SELECT date, train, depStation, arrStation, tickets FROM Tickets WHERE date = ? AND train = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$date, $train]);
// var_dump($stmt);
while ( $rs = $stmt->fetch(PDO::FETCH_BOTH) ) {
    foreach ($rs as $key => $val) {
        echo "$key: $val\t";
    }
    echo "<br>";

}

?>
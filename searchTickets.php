<?php
include "pdo_sql.php";


$depStation = '';
$arrStation = '';

if (isset($_POST['date'])) {

    $uiDate = $_POST['date'];
    $depStnChtName = $_POST['depStn'];
    $arrStnChtName = $_POST['arrStn'];
    $carClass = $_POST['carClass'];

    echo '<hr>';

    // automatically date=>today as default (e.g. $uiDate = '')
    $bufferDate = new DateTime($uiDate);
    $date = date_format( $bufferDate, 'Ymd');
    echo $date . '<br>';




    $pdo = @new pdo($pdo_dsn, $db_user, $db_password, $pdo_opt);
    $sql_tickets = "SELECT date, train, depStation, arrStation, tickets FROM Tickets WHERE date = ? AND depStation = ? AND arrStation = ?";
    // $sql_stnInfo = "SELECT StnChtName, StnEngName FROM StationsInfo WHERE StnCode_3 = ?";
    $sql_stnInfo = "SELECT StnCode_3 FROM StationsInfo WHERE StnChtName = ?";



    // To get StationCode_3 of departure station
    $stmt = $pdo->prepare($sql_stnInfo);
    $stmt->execute([$depStnChtName]);
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    // $rs = $stmt->fetch(PDO::FETCH_BOTH);
    $isDepStnFetched = false; // departure station found?
    if ( $rs !== false ) {
        foreach ($rs as $key => $val) {
            // echo "$key: $val\t";
            $depStation = $val; // should be only one
            $isDepStnFetched = true;
        }
    } else {
        $isDepStnFetched = false;
    }

    // echo "Depart: {$depStnChtName}:{$depStation}".'<br>';
    echo "Depart: {$depStnChtName}".'<br>';

    echo '<hr>';

    // To get StationCode_3 of destination station
    $stmt->execute([$arrStnChtName]);
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($rs);
    // $rs = $stmt->fetch(PDO::FETCH_BOTH);
    
    $isArrStnFetched = false; // destination station found?
    if ( $rs !== false) {
        foreach ($rs as $key => $val) {
            // echo "$key: $val\t";
            $arrStation = $val; // should be also only one
            $isArrStnFetched = true;
        }
    } else {
        $isArrStnFetched = false;
    }

    // echo "Arrive: {$arrStnChtName}:{$arrStation}".'<br>';
    echo "Arrive: {$arrStnChtName}".'<br>';
    echo '<hr>';

    $isTrainFetched = false; // remaining tickets found?
    if ( $isDepStnFetched && $isArrStnFetched ) {

        $stmt = $pdo->prepare($sql_tickets);
        $stmt->execute([$date, $depStation, $arrStation]);

        while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) {

            foreach ($rs as $key => $val) {
                echo "$key: $val\t";
            }
            echo "<br>";

            $isTrainFetched = true;
        }

    }

    if ($isTrainFetched) {
        echo 'Got train'.'<br>';
    } else {
        echo 'No train'.'<br>';
    }

}

?>
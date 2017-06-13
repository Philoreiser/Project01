<?php

include "pdo_sql.php";

if (isset($_POST['date'])) {

    $udate = $_POST['date'];
    $depStnChtName = $_POST['depStn'];
    $arrStnChtName = $_POST['arrStn'];
    $carClass = $_POST['carClass'];

    if ($udate == '') {
        echo 'No date' . '<br>';
    } else {
        echo $udate . '<br>';
    }
    // echo $depStn . '<br>';
    // echo $arrStn . '<br>';
    // echo $carClass . '<br>';

    echo '<hr>';

    $date = '20170608';
    // $train = '754';
    // $depStation = '100';
    $depStation = '';
    // $arrStation = '158';
    $arrStation = '';


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
            echo "$key: $val\t";
            $depStation = $val; // should be only one
            $isDepStnFetched = true;
        }
    } else {
        $isDepStnFetched = false;
    }

    echo "Depart: {$depStnChtName}:{$depStation}".'<br>';
    echo '<hr>';

    // To get StationCode_3 of destination station
    $stmt->execute([$arrStnChtName]);
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($rs);
    // $rs = $stmt->fetch(PDO::FETCH_BOTH);
    
    $isArrStnFetched = false; // destination station found?
    if ( $rs !== false) {
        foreach ($rs as $key => $val) {
            echo "$key: $val\t";
            $arrStation = $val; // should be also only one
            $isArrStnFetched = true;
        }
    } else {
        $isArrStnFetched = false;
    }

    echo "Arrive: {$arrStnChtName}:{$arrStation}".'<br>';
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
<html>
<head>
    <title>Railway Tickets</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
</head>
<body>
    <form method = "post" >
        日期: <input type="date" name="date"/>
        <hr>
        起站:<br>
        <input type="radio" name="depStn" value="基隆"/>基隆
        <input type="radio" name="depStn" value="臺北"/>臺北
        <input type="radio" name="depStn" value="桃園"/>桃園
        <input type="radio" name="depStn" value="中壢"/>中壢
        <input type="radio" name="depStn" value="新竹"/>新竹
        <input type="radio" name="depStn" value="苗栗"/>苗栗
        <input type="radio" name="depStn" value="台中"/>台中
        <input type="radio" name="depStn" value="彰化"/>彰化
        <input type="radio" name="depStn" value="雲林"/>雲林
        <input type="radio" name="depStn" value="嘉義"/>嘉義
        <input type="radio" name="depStn" value="臺南"/>臺南
        <input type="radio" name="depStn" value="高雄"/>高雄
        <input type="radio" name="depStn" value="屏東"/>屏東
        <input type="radio" name="depStn" value="臺東"/>臺東
        <input type="radio" name="depStn" value="花蓮"/>花蓮
        <input type="radio" name="depStn" value="宜蘭"/>宜蘭
        <input type="radio" name="depStn" value="NoStn" hidden checked/>  
        <hr>
        迄站:<br>
        <input type="radio" name="arrStn" value="基隆"/>基隆
        <input type="radio" name="arrStn" value="臺北"/>臺北
        <input type="radio" name="arrStn" value="桃園"/>桃園
        <input type="radio" name="arrStn" value="中壢"/>中壢
        <input type="radio" name="arrStn" value="新竹"/>新竹
        <input type="radio" name="arrStn" value="苗栗"/>苗栗
        <input type="radio" name="arrStn" value="台中"/>台中
        <input type="radio" name="arrStn" value="彰化"/>彰化
        <input type="radio" name="arrStn" value="雲林"/>雲林
        <input type="radio" name="arrStn" value="嘉義"/>嘉義
        <input type="radio" name="arrStn" value="臺南"/>臺南
        <input type="radio" name="arrStn" value="高雄"/>高雄
        <input type="radio" name="arrStn" value="屏東"/>屏東
        <input type="radio" name="arrStn" value="臺東"/>臺東
        <input type="radio" name="arrStn" value="花蓮"/>花蓮
        <input type="radio" name="arrStn" value="宜蘭"/>宜蘭
        <input type="radio" name="arrStn" value="NoStn" hidden checked/>  
        <hr>
        對號列車車種:<br>
        <input type="checkbox" name="carClass[]" value="TC" checked/>自強號
        <input type="checkbox" name="carClass[]" value="CK"/>莒光號
        <input type="checkbox" name="carClass[]" value="FX"/>復興號
        <hr>
        <input type="submit" name="request" value="查詢"/>
        <hr>
    </form>
</body>

</html>
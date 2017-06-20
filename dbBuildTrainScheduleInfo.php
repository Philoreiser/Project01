<?php
include "pdo_sql.php";
include "myPhpAPIs.php";

foreach( glob("./OpenData/TrainSchedules/*.json", GLOB_BRACE) as $jsonFile ) {
    $bname = basename($jsonFile);
    $date = chop($bname, ".json");
    echo $date . " " . gettype($date) . strlen($date) . '<br>';
}

// $jsomPath = "./OpenData/TrainSchedules/";
$json = file_get_contents("./OpenData/TrainSchedules/20170610.json");
// var_dump($json);

$src_encoding = mb_detect_encoding($json, mb_list_encodings(), true); // not really working
echo "source encoding: " . $src_encoding . '<br>';
$result = mb_convert_encoding($json, "utf-8", $src_encoding);
$root = json_decode($result, true);
echo gettype($root) . '<br>';
// var_dump($result);

// myPrintObj('', $root["TrainInfos"], '<br>');

// var_dump($root["TrainInfos"]);


// var_dump($pdo);
$dbColList = Array();
$dbColList = [
    "date", 
    "Train", 
    "CarClass",
    "OverNightStn_4",
    "OverNightStn_3",
    "StnCode_4",
    "StnCode_3",
    "StnOrder",
    "ArrTime",
    "DepTime"];

$pdo = @new PDO($pdo_dsn, $db_user, $db_password, $pdo_opt);
$sql = myPrepareSQL("INSERT", "TrainSchedule", $dbColList);
// echo $sql . '<br>';


$trainInfos = $root["TrainInfos"];

if ( gettype($trainInfos) == "array" ) {
    // var_dump($trainInfos);
    foreach ($trainInfos as $trainInfo) {
        foreach ($trainInfo as $key=>$val) {
            // echo "{$key}: " . gettype($val) . '<br>';
            if ( $key == "TimeInfos" ) { // gettype($val) == "array"
                // var_dump($val);
                $timeInfos = $val;
                foreach ($timeInfos as $timeInfo) {
                    foreach ($timeInfo as $k => $v ) {
                        echo "{$k} => {$v}; ";
                    }
                    echo '<br>';
                }
                echo '<br>';
            } else {
                echo "{$key}: {$val}" . '<br>';
            }
        }
    }

}


?>


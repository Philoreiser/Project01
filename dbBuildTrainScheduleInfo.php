<?php
include "pdo_sql.php";
include "myPhpAPIs.php";

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

$pdo = @new PDO($pdo_dsn, $db_user, $db_password, $pdo_opt);
$sql = "";
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

$sql = myPrepareSQL("INSERT", "TrainSchedule", $dbColList);
echo $sql . '<br>';

// $db_colmn = [
//     "date" => "", 
//     "Train" => "", 
//     "CarClass" => "",
//     "OverNightStn_4" => "",
//     "OverNightStn_3" => "",
//     "StnCode_4" => "",
//     "StnCode_3" => "",
//     "StnOrder" => "",
//     "ArrTime" => "",
//     "DepTime" => "" ];




// $sql = "INSERT INTO TrainSchedule (date, Train, CarClass, OverNightStn_4 OverNightStn_3, StnCode_4, StnCode_3, StnOrder, ArrTime, DepTime) VALUES (?,?,?,?,?,?,?,?,?,?)";

// if ( gettype($root["TrainInfos"]) == "array" ) {
//     foreach ($root["TrainInfos"] as $trainInfo) {
//         $timeInfos = $trainInfo["TimeInfos"];
//         myPrintObj('', $timeInfos, '<br>');        
//     }
// }


?>


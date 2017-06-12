<?php
include "pdo_sql.php";
include "myPhpAPIs.php";

$json = file_get_contents("./OpenData/StationsInfo_ver170610.json");
// var_dump($json);

$src_encoding = mb_detect_encoding($json, mb_list_encodings(), true); // not really working
echo "source encoding: " . $src_encoding . '<br>';
$result = mb_convert_encoding($json, "utf-8", $src_encoding);
$root = json_decode($result, true);
echo gettype($root) . '<br>';
// var_dump($result);

var_dump($root);

$pdo = @new pdo($pdo_dsn, $db_user, $db_password, $pdo_opt);
$sql = "INSERT INTO StationsInfo (StnCode_4, StnChtName, StnEngName, StnCode_3, ChtName, EngName, ChtAddress, EngAddress, Tel, gps) VALUES (?,?,?,?,?,?,?,?,?,?)";
$stmt = $pdo->prepare($sql);

foreach ($root as $data) {

    $insert_val = array();
    // var_dump($data);

    foreach ($data as $key => $val) {
        // echo "{$key}: {$val}<br>";
        $insert_val [] = $val;
    }

    $stmt->execute($insert_val);
}

?>


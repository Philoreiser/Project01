<?php
include "pdo_sql.php";
include "myPhpAPIs.php";

// $json = file_get_contents("./OpenData/車站基本資料2.json");

// $json = file_get_contents("./OpenData/StationsBasicInfo.json");
// $json = file_get_contents("http://www.railway.gov.tw/Upload/UserFiles/%E8%BB%8A%E7%AB%99%E5%9F%BA%E6%9C%AC%E8%B3%87%E6%96%992.json");
$json = file_get_contents("20170610.json");

$src_encoding = mb_detect_encoding($json, mb_list_encodings(), true); // not really working
echo "source encoding: " . $src_encoding . '<br>';
$result = mb_convert_encoding($json, "utf-8", $src_encoding);
$root = json_decode($result, true);
echo gettype($root) . '<br>';
// var_dump($result);


foreach ( $root["TrainInfos"] as $Obj ) {
        foreach( $Obj as $key => $val ) {
            myPrintObj($key, $val,'<br>');
            // if ( gettype($v) != "string") {
            //     // echo "{$key} ". gettype($v) . '<br>';
            //     var_dump($v);
            //     // $branch = json_decode($v);

            //     // foreach ( $v as $element) {
            //     //     echo "{$element}<br>";
            //     // }
            // } else {
            //     echo "{$key} : {$v}<br>";

            // }
        }
        echo '<hr>';
}

?>


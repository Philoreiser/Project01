<?php

/*
 * to execute:
 * $pdo = new PDO(.......)
 * $sql = (some MySQL command with preserved parameters "?") 
 * $stmt = $pdo->prepare()
 * $stmt->execute([.......])
 */

function myPrepareSQL($myDefClass, $tableName, $colName ) {

// TODO: still need some checkform procedures for preventing input error

    $sql = "";
    $numOfCol = count($colName);

    switch ($myDefClass) {
        case "INSERT":

            $column = "(";
            $fragStr = "(";
            foreach ($colName as $col) {
                $column .=  $col . ",";
                $fragStr .= "?" . ",";
            }

            if (substr($column, -1) == ",") {
                $len = strlen($column);
                $column[$len-1] = ")";
            } else {
                $column .= ")";
            }

            if (substr($fragStr, -1) == ",") {
                $len = strlen($fragStr);
                $fragStr[$len-1] = ")";
            } else {
                $fragStr .= ")";
            }
            // echo $column . '<br>';
            // echo $fragStr . '<br>';

            $sql = "INSERT INTO {$tableName} {$column} VALUES {$fragStr}";

            break;

        default:
            echo "myPrepareSQL(): fatal error";
    }

    return $sql;
}


/*
 * to build the remaining seats database  
 */
$mySeatFormat = [
    "date" => [ "start"=>0, "length"=>8], 
    "train" => ["start"=>8, "length"=>4], 
    "depStation" => ["start"=>12, "length"=>3], 
    "arrStation" => ["start"=>15, "length"=>3], 
    "tickets" => ["start"=>18, "length"=>4] 
];

function myParseSeatCode($code, $myFormat) {
    $data = array();

    foreach ($myFormat as $key => $val) {

        // $data[$key] = substr($code, $val['start'], $val['length']);
        $str = substr($code, $val['start'], $val['length']);
        
        
        switch ($key) {
            case 'tickets':
                $data [] = str_replace("0", "", $str);
                break;
            case 'depStation':
            case 'arrStation':
                $data [] = (int) $str;
                break;
            default: // train
                $data [] = str_replace( " ", "", $str);
        }
    }
    
    return $data;
}
/******************************************/



function myPrintArray($myArray, string $terminator) {
    $type = gettype($myArray);
    if ( $type != "array") {
        echo "Variable type not matched!" . '<br>';
        return;
    }

    foreach ($myArray as $key=>$val) {
        switch (gettype($val)) {
            case "string":
                echo "{$key} : {$val}" . $terminator;
                break;
            case "array":
                echo "{$key}:" . $terminator;

                foreach ($val as $k => $v) {
                    if (gettype($v) == "string") {
                        echo "{$k} : {$v}" . $terminator;
                    } else {
                        var_dump($v);
                    }
                }
                break;
            default:
                var_dump($val);

        }
    }

}

function myPrintObj( $Obj_key, $Obj_value, string $terminator) {
    $type = gettype($Obj_value);

    switch ($type) {
        case "string":
            echo "{$Obj_key} : {$Obj_value}" . $terminator;
            break;

        case "array":
            myPrintArray($Obj_value, '<br>');

            // TODO: need to debug for the "object" case inserted in "array"
            break;

        case "object":
            echo "object:" . $terminator;
            var_dump($Obj_value);
            break;

        default:
            var_dump($Obj_value);

    }
}

?>
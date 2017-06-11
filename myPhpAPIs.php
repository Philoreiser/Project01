<?php

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
        $data[] = substr($code, $val['start'], $val['length']);

    }

    return $data;
}

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

            // foreach ($Obj_value as $key=>$val) {
            //     if ( gettype($val) == "string" ) {
            //         echo "{$key} : {$val}" . $terminator;
            //     } else if ( gettype($val) == "array") {
            //         echo "{$key}:" . $terminator;

            //         foreach ($val as $k => $v) {
            //             echo "{$k} : {$v}" . $terminator;
            //         } 

            //     }else {
            //         echo "{$key} : ";
            //         var_dump($val);
            //         echo $terminator;
            //     }
            // }

            // break;

        case "object":
            echo "object:" . $terminator;
            var_dump($Obj_value);
            break;

        default:
            var_dump($Obj_value);

    }
}

?>
<?php

function myPrintObj($Obj, string $terminator) {
    $type = gettype($Obj);

    switch ($type) {
        case "string":
            echo $Obj . $terminator;
            break;

        case "array":
            foreach ($Obj as $key=>$v) {
                if ( gettype($v) == "string" ) {
                    echo "{$key} : {$v}" . $terminator;
                } else {
                    echo "{$key} : ";
                    var_dump($v);
                    echo $terminator;
                }
            }

            break;

        default:
            var_dump($Obj);

    }
}

?>
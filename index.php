<?php
/**
 * HINT : https://www.dougv.com/2012/03/converting-latitude-and-longitude-coordinates-between-decimal-and-degrees-minutes-seconds/
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

function DDMToDecimal($degrees = 0, $minutes = 0, $direction = 'n') {
    //converts DMS coordinates to decimal
    //returns false on bad inputs, decimal on success
    //direction must be n, s, e or w, case-insensitive
    $d = strtolower($direction);
    $ok = array('n', 's', 'e', 'w');

    //degrees must be integer between 0 and 180
    if ($degrees < 0 || $degrees > 180) {
        $decimal = false;
    }
    //minutes must be integer or float between 0 and 59
    elseif ($minutes < 0 || $minutes > 60) {
        $decimal = false;
    } elseif (!in_array($d, $ok)) {
        $decimal = false;
    } else {
        //inputs clean, calculate
        $decimal = $degrees + ($minutes / 60);

        //reverse for south or west coordinates; north is assumed
        if ($d == 's' || $d == 'w') {
            $decimal *= -1;
        }
    }

    return $decimal;
}

function DMSToDecimal($degrees = 0, $minutes = 0, $seconds = 0, $direction = 'n') {
    //converts DMS coordinates to decimal
    //returns false on bad inputs, decimal on success
    //direction must be n, s, e or w, case-insensitive
    $d = strtolower($direction);
    $ok = array('n', 's', 'e', 'w');

    //degrees must be integer between 0 and 180
    if (!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
        $decimal = false;
    }
    //minutes must be integer or float between 0 and 59
    elseif (!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
        $decimal = false;
    }
    //seconds must be integer or float between 0 and 59
    elseif (!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
        $decimal = false;
    } elseif (!in_array($d, $ok)) {
        $decimal = false;
    } else {
        //inputs clean, calculate
        $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

        //reverse for south or west coordinates; north is assumed
        if ($d == 's' || $d == 'w') {
            $decimal *= -1;
        }
    }

    return $decimal;
}

$ddm = "31° 59.633' S";
$ddm = explode(" ", str_replace(array('°', "'"), "", $ddm));

$dec = DDMToDecimal($ddm[0], $ddm[1], strtolower($ddm[2]));


//$dec = DMSToDecimal($deg, $min, $sec, $dir);

echo '<pre>';
print_r($dec);






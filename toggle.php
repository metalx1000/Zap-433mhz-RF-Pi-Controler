<?php
$rfPath = '/var/www/rfoutlet/codesend ';
$outletLight = $_POST['outletId'];
$outletStatus = $_POST['outletStatus'];

if ($outletLight == "1" && $outletStatus == "on") {
    $rfCodes = array(87347);
} else if ($outletLight == "1" && $outletStatus == "off") {
    $rfCodes = array(87356);
} else if ($outletLight == "2" && $outletStatus == "on") {
    $rfCodes = array(87491);
} else if ($outletLight == "2" && $outletStatus == "off") {
    $rfCodes = array(87500);
} else if ($outletLight == "3" && $outletStatus == "on") {
    $rfCodes = array(87811);
} else if ($outletLight == "3" && $outletStatus == "off") {
    $rfCodes = array(87820);
} else if ($outletLight == "4" && $outletStatus == "on") {
    $rfCodes = array(89347);
} else if ($outletLight == "4" && $outletStatus == "off") {
    $rfCodes = array(89356);
} else if ($outletLight == "5" && $outletStatus == "on") {
    $rfCodes = array(95491);
} else if ($outletLight == "5" && $outletStatus == "off") {
    $rfCodes = array(95500);
} else if ($outletLight == "6" && $outletStatus == "on") {
    $rfCodes = array(87347,87491,87811,89347,95491);
} else if ($outletLight == "6" && $outletStatus == "off") {
    $rfCodes = array(87356,87500,87820,89356,95500);
}


foreach ($rfCodes as $rfCode) {
        shell_exec($rfPath . $rfCode);
        usleep(50000);
}

echo json_encode(array('success' => true));
?>

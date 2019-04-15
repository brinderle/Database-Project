<?php

session_start();
$result = $_SESSION['result'];
if (!$result) die("Couldn't fetch records");
$num_fields = mysql_num_fields($result);
$headers = array();
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysql_field_name($result , $i);
}

if ($fp && $result) {
    fputcsv($fp, $headers);
    while ($row = mysql_fetch_assoc($result)) {
        fputcsv($fp, $row);
    }
}

exit;
// if (!$result) die('Couldn\'t fetch records');
// $num_fields = mysql_num_fields($result);
// $headers = array();
// for ($i = 0; $i < $num_fields; $i++) {
//     $headers[] = mysql_field_name($result , $i);
// }
// $fp = fopen('php://output', 'w');
// if ($fp && $result) {
//     header('Content-Type: text/csv');
//     header('Content-Disposition: attachment; filename="export.csv"');
//     header('Pragma: no-cache');
//     header('Expires: 0');
//     fputcsv($fp, $headers);
//     while ($row = mysqli_fetch_array($result)) {
//         fputcsv($fp, array_values($row));
//     }
//     die;
// }

?>
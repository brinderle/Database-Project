<?php
// https://stackoverflow.com/questions/125113/php-code-to-convert-a-mysql-query-to-csv

session_start();
require_once('./library.php');
$con = new mysqli($SERVER, $USERNAME, $PASSWORD,
$DATABASE);
// Check connection
if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .
    mysqli_connect_error());
    return null;
}
$sql = $_SESSION['query'];
$result = mysqli_query($con,$sql);
if (!$result) die('Couldn\'t fetch records');
// $num_fields = mysql_num_fields($result);
// $headers = array();
// for ($i = 0; $i < $num_fields; $i++) {
//     $headers[] = mysql_field_name($result , $i);
// }
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $_SESSION['columns']);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
mysqli_close($con);

?>
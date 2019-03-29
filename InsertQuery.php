<?php
    require_once('./library.php');
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD,
    $DATABASE);
    // Check connection
    if (mysqli_connect_errno()) {
        echo("Can't connect to MySQL Server. Error code: " .
        mysqli_connect_error());
        return null;
    }
    // Form the SQL query (a SELECT query)
    session_start();
    $sql="INSERT INTO " . $_SESSION['Topic'] . " (";
    // get the values of the parameters passed in for each column name
    $_SESSION['parameters'] = array();
    $_SESSION['operators'] = array();
    foreach ($_SESSION['columns'] as $value) {
        array_push($_SESSION['parameters'], $_POST[$value]);
        array_push($_SESSION['operators'], $_POST[$value . 'ID']);
        $sql .= $value . ", ";
    }
    // get rid of the extra comma and space at the end of the sql part
    $sql = substr($sql, 0, -2);
    $sql .= ") VALUES (";
    // append the values to insert
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    {
        // if ($_SESSION['parameters'][$i] != '') {
        //     $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . $_SESSION['parameters'][$i];
        // }
        $sql .= $_SESSION['parameters'][$i] . ", ";
    }
    // get rid of the extra comma and space at the end of the sql part
    $sql = substr($sql, 0, -2);
    $sql .= ")";
    echo $sql . "<br>";

    $result = mysqli_query($con,$sql);
    echo 'You just made an insert with the query above.';
    // Print the data from the table row by row
    // foreach ($_SESSION['columns'] as $value) {
    //     echo $value . " ";
    // }
    // echo "<br>";
    // while($row = mysqli_fetch_array($result)) {
    //     foreach ($_SESSION['columns'] as $value) {
    //         echo $row[$value] . " ";
    //     }
    //     echo "<br>";
    // }
    mysqli_close($con);
?>
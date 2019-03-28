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
    $sql="SELECT * FROM Attraction WHERE 1=1";
    // get the values of the parameters passed in for each column name
    $_SESSION['parameters'] = array();
    foreach ($_SESSION['columns'] as $value) {
        array_push($_SESSION['parameters'], $_POST[$value]);
    }
    // append the conditions to the where clause if there was a value entered for that field
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    {
        if ($_SESSION['parameters'][$i] != '') {
            $sql .= " AND $_SESSION['columns'][$i]";
        }
    }
    echo $sql;

    // $result = mysqli_query($con,$sql);
    // // Print the data from the table row by row
    // while($row = mysqli_fetch_array($result)) {
    //     // echo $row['attraction_id'];
    //     // echo $row['name'];
    //     // echo " " . $row['park'];
    //     // echo " " . $row['region_name'];
    //     echo $row;
    //     echo "<br>";
    // }
    mysqli_close($con);
?>
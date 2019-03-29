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
    $sql="SELECT * FROM " . $_SESSION['Topic'] . " WHERE 1=1";
    // get the values of the parameters passed in for each column name
    $_SESSION['parameters'] = array();
    $_SESSION['operators'] = array();
    foreach ($_SESSION['columns'] as $value) {
        array_push($_SESSION['parameters'], $_POST[$value]);
        array_push($_SESSION['operators'], $_POST[$value . 'ID']);
    }
    // append the conditions to the where clause if there was a value entered for that field
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    {
        if ($_SESSION['parameters'][$i] != '') {
            $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . $_SESSION['parameters'][$i];
        }
    }
    echo $sql . "<br>";

    $result = mysqli_query($con,$sql);
    // Print the data from the table row by row
    foreach ($_SESSION['columns'] as $value) {
        echo $value . " ";
    }
    echo "<br>";
    while($row = mysqli_fetch_array($result)) {
        foreach ($_SESSION['columns'] as $value) {
            echo $row[$value] . " ";
        }
        echo "<br>";
    }
    mysqli_close($con);
?>
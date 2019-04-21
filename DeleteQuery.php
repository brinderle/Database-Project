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
    $sql="DELETE FROM " . $_SESSION['Topic'] . " WHERE ";
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
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . '"' . $_SESSION['parameters'][$i] . '"' . " AND ";
            } else {
                $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . $_SESSION['parameters'][$i] . " AND ";
            }
        }
    }
    // get rid of the extra AND and two spaces
    $sql = substr($sql, 0, -5);
    // echo $sql . "<br>";

    $result = mysqli_query($con,$sql);
    echo 'You just made a delete with the query above.';
    mysqli_close($con);
?>
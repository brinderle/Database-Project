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
    $sql="UPDATE " . $_SESSION['Topic'] . " SET ";
    // get the values of the parameters passed in for each column name
    $_SESSION['select_parameters'] = array();
    $_SESSION['update_parameters'] = array();
    $_SESSION['operators'] = array();
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        $value = $_SESSION['columns'][$i];
        $update_value = $_POST[$value . 'UPDATE'];
        $select_value = $_POST[$value . 'SELECT'];
        array_push($_SESSION['select_parameters'], $select_value);
        array_push($_SESSION['update_parameters'], $update_value);
        array_push($_SESSION['operators'], $_POST[$value . 'SELECT_ID']);
        if ($_SESSION['update_parameters'][$i] != '') {
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $sql .= $_SESSION['columns'][$i] . '=' . '"' . $_SESSION['update_parameters'][$i] . '"' . ', ';
            } else {
                $sql .= $_SESSION['columns'][$i] . '=' . $_SESSION['update_parameters'][$i] . ', ';
            }
        }
    }
    // get rid of the extra comma and space at the end of the sql SET part
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE ";
    // append the values to insert
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    {
        if ($_SESSION['select_parameters'][$i] != '') {
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . '"' . $_SESSION['select_parameters'][$i] . '"' . " AND ";
            } else {
                $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . $_SESSION['select_parameters'][$i] . " AND ";
            }
        }
    }
    // get rid of the extra AND and two spaces
    $sql = substr($sql, 0, -5);
    // echo $sql . "<br>";

    $result = mysqli_query($con,$sql);
    echo 'You just made an update with the query above.';
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
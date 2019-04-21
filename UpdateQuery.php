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
        // if ($_SESSION['update_parameters'][$i] != '') {
        //     if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
        //         $sql .= $_SESSION['columns'][$i] . '=' . '"' . $_SESSION['update_parameters'][$i] . '"' . ', ';
        //     } else {
        //         $sql .= $_SESSION['columns'][$i] . '=' . $_SESSION['update_parameters'][$i] . ', ';
        //     }
        // }
    }

    // get the datatypes, leave ? to bind parameters to the query
    $type_string = "";
    $parameters = array("");
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        if ($_SESSION['update_parameters'][$i] != '') {
            $sql .= $_SESSION['columns'][$i] . '=' . '?, ';
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $type_string .= "s";
            } else if ($_SESSION['column_data_types'][$i] == "double" or $_SESSION['column_data_types'][$i] == "float") {
                $type_string .= "d";
            } else {
                // assume int
                $type_string .= "i";
            }
            $parameters[] = &$_SESSION['update_parameters'][$i];
        }
    }

    // get rid of the extra comma and space at the end of the sql SET part
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE ";
    // append the values to insert
    // for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    // {
    //     if ($_SESSION['select_parameters'][$i] != '') {
    //         if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
    //             $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . '"' . $_SESSION['select_parameters'][$i] . '"' . " AND ";
    //         } else {
    //             $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . $_SESSION['select_parameters'][$i] . " AND ";
    //         }
    //     }
    // }
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        if ($_SESSION['select_parameters'][$i] != '') {
            $sql .= $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . "? AND ";
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $type_string .= "s";
            } else if ($_SESSION['column_data_types'][$i] == "double" or $_SESSION['column_data_types'][$i] == "float") {
                $type_string .= "d";
            } else {
                // assume int
                $type_string .= "i";
            }
            $parameters[] = &$_SESSION['select_parameters'][$i];
        }
    }


    // get rid of the extra AND and two spaces
    $sql = substr($sql, 0, -5);

    $parameters[0] = &$type_string;
    // if no parameters are passed, get rid of the type_string
    if (count($parameters) == 1) {
        $parameters = array();
    }

    // prepare statement and execute it
    $stmt = $con->prepare($sql);
    call_user_func_array(array($stmt, 'bind_param'), $parameters);
    $stmt->execute();

    // $result = mysqli_query($con,$sql);
    echo 'You just made an update on the database.';
    mysqli_close($con);
?>
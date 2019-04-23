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

    // get the datatypes, leave ? to bind parameters to the query
    $type_string = "";
    $parameters = array("");
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        if ($_SESSION['parameters'][$i] != '') {
            $sql .= ' ?, ';
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") or $_SESSION['column_data_types'][$i] == "date") {
                if ($_SESSION['column_data_types'][$i] == "date") {
                    $_SESSION['parameters'][$i] = strtotime($_SESSION['parameters'][$i]);
                    $_SESSION['parameters'][$i] = date("Y-m-d", $_SESSION['parameters'][$i]);
                }
                $type_string .= "s";
            } else if ($_SESSION['column_data_types'][$i] == "double" or $_SESSION['column_data_types'][$i] == "float") {
                $type_string .= "d";
            } else {
                // assume int
                $type_string .= "i";
            }
            $parameters[] = &$_SESSION['parameters'][$i];
        }
    }
    // get rid of the extra comma and space at the end of the sql part
    $sql = substr($sql, 0, -2);
    $sql .= ")";

    $parameters[0] = &$type_string;
    // if no parameters are passed, get rid of the type_string
    if (count($parameters) == 1) {
        $parameters = array();
    }

    // prepare statement and execute it
    $stmt = $con->prepare($sql);
    call_user_func_array(array($stmt, 'bind_param'), $parameters);
    $stmt->execute();


    $result = mysqli_query($con,$sql);
    // echo 'You just made an insert with the query above.';
    echo 'You just made an insert into the database';
    mysqli_close($con);
?>
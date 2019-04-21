<?php

    // style sheet
    echo "<head><link rel='stylesheet' type='text/css' href='select_styles.css'></head>";

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
    // for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    // {
    //     if ($_SESSION['parameters'][$i] != '') {
    //         $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i];
    //         if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
    //             $sql .= '"' . $_SESSION['parameters'][$i] . '"';
    //         } else {
    //             $sql .= $_SESSION['parameters'][$i];
    //         }
    //     }
    // }
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++)
    {
        if ($_SESSION['parameters'][$i] != '') {
            $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . ' ?';
            // if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
            //     $sql .= '"' . $_SESSION['parameters'][$i] . '"';
            // } else {
            //     $sql .= $_SESSION['parameters'][$i];
            // }
        }
    }
    // get the datatypes and bind parameters to the query
    $type_string = "";
    $parameters = array();
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        if ($_SESSION['parameters'][$i] != '') {
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $type_string .= "s";
            } else if ($_SESSION['column_data_types'][$i] == "double" or $_SESSION['column_data_types'][$i] == "float") {
                $type_string .= "d";
            } else {
                // assume int
                $type_string .= "i";
            }
            array_push($parameters, $_SESSION['parameters'][$i]);
        }
    }
    $stmt = $con->prepare($sql);
    $stmt->bind_param( $type_string, $parameters );

    echo $sql . "<br>";
    echo "The results from the query are shown below.  Click the Export Data button if you would like to export this data to a csv file.";
    echo "<br>";
    echo "<form action = 'export.php'><button type='submit' action='export.php'>Export to CSV</button></form>";

    // get result and format it as a table
    echo "<table>";
    echo "<tr>";
    // $result = mysqli_query($con,$sql);
    $result = $stmt->execute();
    $_SESSION['result'] = $result;
    $_SESSION['query'] = $sql;
    // Print the data from the table row by row
    foreach ($_SESSION['columns'] as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($_SESSION['columns'] as $value) {
            echo "<td>" . $row[$value] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($con);
?>
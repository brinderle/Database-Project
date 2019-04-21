<?php
    // https://www.pontikis.net/blog/dynamically-bind_param-array-mysqli for some prepared statement knowledge and code
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

    // get the datatypes, leave ? to bind parameters to the query
    $type_string = "";
    $parameters = array("");
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        if ($_SESSION['parameters'][$i] != '') {
            $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i] . ' ? ';
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
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
    $parameters[0] = &$type_string;
    // if no parameters are passed, get rid of the type_string
    if (count($parameters) == 1) {
        $parameters = array();
    }

    // prepare statement and execute it
    $stmt = $con->prepare($sql);
    call_user_func_array(array($stmt, 'bind_param'), $parameters);
    $stmt->execute();



    echo $sql . "<br>";
    echo "The results from the query are shown below.  Click the Export Data button if you would like to export this data to a csv file.";
    echo "<br>";
    echo "<form action = 'export.php'><button type='submit' action='export.php'>Export to CSV</button></form>";

    // set up column variables and pass references of them to the bind_result function
    $column_references = array();
    for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
        ${'col'.$i};
        $column_references[] = &${'col'.$i};
    }

    $result = call_user_func_array(array($stmt, 'bind_result'), $column_references);
    $_SESSION['result'] = $result;
    $_SESSION['query'] = $sql;

    // start making table with results from query
    echo "<table>";
    echo "<tr>";

    // print the columns in the table
    foreach ($_SESSION['columns'] as $value) {
        echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
 
    // print the rows in the table
    while ($stmt->fetch()) {
        echo "<tr>";
        for ($i=0;$i<sizeof($_SESSION['columns']);$i++) {
            echo "<td>" . ${'col'.$i} . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    $stmt->close();
    mysqli_close($con);
?>
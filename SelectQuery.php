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
            $sql .= " AND " . $_SESSION['columns'][$i] . $_SESSION['operators'][$i];
            if ($_SESSION['column_data_types'][$i] == "varchar" or $_SESSION['column_data_types'][$i] == "datetime") {
                $sql .= '"' . $_SESSION['parameters'][$i] . '"';
            } else {
                $sql .= $_SESSION['parameters'][$i];
            }
        }
    }
    echo $sql . "<br>";
    echo "The results from the query are shown below.  Click the Export Data button if you would like to export this data to a csv file.";
    echo "<button onclick=echo 'hello'>Export Data</button>";

    // get result and format it as a table
    echo "<table>";
    echo "<tr>";
    $result = mysqli_query($con,$sql);
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
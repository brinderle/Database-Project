<html>
    <body>
        <p> made it</p>
        <?php

        $selected_username = $_POST['username'];  
        $selected_password = $_POST['password'];  

        echo "Your username:" .$selected_username; 
        echo "Your password:" .$selected_password; 

        require_once('./library.php');

        $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
        // Check connection
        if (mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " .
            mysqli_connect_error());
            return null;
        }
        
        session_start();
        $columns = array();
        $column_data_types = array();
        $role = "";

        // if($selected_username == 'admin' && $selected_password = 'password'){
        //     $role = 'admin';
        //     $_SESSION['loggedIn'] = True;
        // }

        //when users table is set up properly:
        $sql="SELECT * FROM Users WHERE username = $selected_username AND password = $selected_password";
        $result = mysqli_query($con,$sql);
        // Print the data from the table row by row
        $i = 0;
        echo "<p> made it here </p>";

        while($row = mysqli_fetch_array($result)) {
            if($i>1){
                echo "System Error";
                break;
            } else {
                $role = $row["role'"];
                $i++;
            }
        }
        if($i == 0 || $i>1) {
            echo "No User Found";
        }
        else {
            $_SESSION["loggedIn"] = True;
            switch ($role) {
                case 'admin':
                    $_SESSION["role"] = 'admin';
                    header( 'Location: ActionPage.html');
                    break;
                case 'client':
                    $_SESSION["role"] = 'client';
                    header( 'Location: client.php');
                    break;
            }
        }
        mysqli_close($con);


        //delete when database is set up properly
        // switch ($role) {
        //     case 'admin':
        //         $_SESSION['role'] = 'admin';
        //         header( 'Location: ActionPage.html');
        //         break;
        //     case 'client':
        //         $_SESSION['role'] = 'client';
        //         header( 'Location: client.php');
        //         break;
        //     case '':
        //         $_SESSION['loggedIn'] = False;
        //         echo "Login Failed. Please try again.";
        //         break;
        // }

        exit;
        ?>
    </body>
</html>
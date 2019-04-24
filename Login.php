<html>
    <body>
        <!-- <p> made it</p> -->
        <?php

        $selected_username = $_POST['username'];  
        $selected_password = $_POST['password'];  

        // echo "Your username:" .$selected_username; 
        // echo "Your password:" .$selected_password; 

        require_once('./library.php');

        $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
        // Check connection
        if (mysqli_connect_errno()) {
            echo("Can't connect to MySQL Server. Error code: " .
            mysqli_connect_error());
            return null;
        }

        $selected_username = mysqli_real_escape_string($con, $selected_username);
        $selected_password = mysqli_real_escape_string($con, $selected_password);
        
        session_start();
        $columns = array();
        $column_data_types = array();
        $role = "";

        //when users table is set up properly:
        $sql="SELECT * FROM Users WHERE username = '$selected_username' AND password = '$selected_password'";
        $result = mysqli_query($con,$sql);
        // Print the data from the table row by row
        // $i = 0;

        // while($row = mysqli_fetch_array($result)) {
        //     echo "<p> made it here hello</p>";

        //     if($i>1){
        //         echo "System Error";
        //         break;
        //     } else {
        //         echo "<p> made it here hello</p>";
        //         $role = $row["role"];
        //         $i++;
        //     }
        // }
        // if($i == 0 || $i>1) {
        //     echo "No User Found";
        //     echo $i;
        // }
        // else {
        //     $_SESSION["loggedIn"] = True;
        //     $_SESSION['role'] = $role;
        //     switch ($role) {
        //         case 'admin':
        //             header( 'Location: ActionPageAdmin.html');
        //             break;
        //         case 'employee':
        //             header( 'Location: ActionPageManager.html');
        //             break;
        //         case 'guest':
        //             header( 'Location: ActionPageGuest.html');
        //             break;
        //     }
        // }

        // got some of this code from https://www.tutorialspoint.com/php/php_mysql_login.htm
        $count = mysqli_num_rows($result);
      
        // If result matched $myusername and $mypassword, table row must be 1 row
        
        if($count == 1) {
            $row = mysqli_fetch_array($result);
            $role = $row["role"];
            $_SESSION["loggedIn"] = True;
            $_SESSION['role'] = $role;
            switch ($role) {
                case 'admin':
                    header( 'Location: ActionPageAdmin.html');
                    break;
                case 'employee':
                    header( 'Location: ActionPageManager.html');
                    break;
                case 'guest':
                    header( 'Location: ActionPageGuest.html');
                    break;
            }
        } else {
            $error = "Your Login Name or Password is invalid. Go back to the login page and try again!";
            echo $error;
        }
        mysqli_close($con);

        exit;
        ?>
    </body>
</html>
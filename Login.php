<html>
    <body>
        <?php

        echo "You have pressed submit on the Login.php page, but something went wrong";

        $selected_username = $_POST['username'];  
        $selected_password = $_POST['password'];  

        echo "Your username:" .$selected_username ; 
        echo "Your password:" .$selected_password; 

        //Check here if the user login is valid
        //IF So, then:
        header('Location: ActionPage.html');

        exit;
        ?>
    </body>
</html>
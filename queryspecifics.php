<html>
    <body>
        <?php
        if(isset($_POST['submit'])){
        $selected_val = $_POST['QueryTopic'];  
        echo "You have selected :" .$selected_val;  
        }
        ?>
    </body>
</html>
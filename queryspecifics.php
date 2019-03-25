<html>
    <body>
        <?php

        echo "You have reached the queryspecifics.php\n";

        $selected_topic = $_POST['Topic'];  
        $selected_action = $_POST['QueryTopic'];  

        echo "You have selected the action:" .$selected_action ; 
        echo "You have selected the Topic:" .$selected_topic; 

         if(isset($_POST['QueryTopic']) == "Insert")
         {
            header('Location: Insert.html');
         }
         if(isset($_POST['QueryTopic']) == "Select")
         {
            header('Location: Select.html');
         }
         if(isset($_POST['QueryTopic']) == "Update")
         {
            header('Location: Update.html');
         }
         if(isset($_POST['QueryTopic']) == "Delete")
         {
            header('Location: Delete.html');
         }

        exit;
        ?>
    </body>
</html>
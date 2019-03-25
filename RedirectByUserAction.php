<html>
    <body>
        <?php

        echo "You have reached the queryspecifics.php\n";

        $selected_topic = $_POST['Topic'];  
        $selected_action = $_POST['QueryTopic'];  

        echo "You have selected the action:" .$selected_action ; 
        echo "You have selected the Topic:" .$selected_topic; 

         if($selected_action == "Insert")
         {
            header('Location: Insert.html');
         }
         else if($selected_action == "Select")
         {
            header('Location: Select.html');
         }
         else if($selected_action == "Update")
         {
            header('Location: Update.html');
         }
         else if($selected_action == "Delete")
         {
            header('Location: Delete.html');
         }

        exit;
        ?>
    </body>
</html>
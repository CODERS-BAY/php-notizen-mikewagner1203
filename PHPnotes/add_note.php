<?php
    $database = new mysqli("localhost", "webuser", "12345", "notes");
    if($database->connect_errno) {
        printf("Verbindung fehlgeschlagen".$database->connect_error); 
        exit();
    }

    if($_POST['entrynumber'] == '') {
            
        $insert = $database->prepare("INSERT INTO entries(text) VALUES(?)");
        $insert->bind_param("s", $text);

        $text = $_POST['entry_text'];

        if($insert->execute()){
            echo "true";
        } else {
            echo "false";
        };    
        $insert->close();
    } else {
        $update = "UPDATE entries SET text='".$_POST['entry_text']."' WHERE entry_number=".$_POST['entrynumber'];
        if($database->query($update)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    $database->close();
?>       

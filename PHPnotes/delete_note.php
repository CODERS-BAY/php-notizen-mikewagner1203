<?php
    $database = new mysqli("localhost", "webuser", "12345", "notes");
    if($database->connect_errno) {
        printf("Verbindung fehlgeschlagen".$database->connect_error); 
        exit();
    }

    $select = "SELECT * FROM entries WHERE entry_number='".$_POST['entrynumber']."'";
    $result = $database->query($select);

    if($result->num_rows > 0) {
        $delete = "DELETE FROM entries WHERE entry_number='".$_POST['entrynumber']."'";
        
        if($database->query($delete)) {
            echo "true";
        } else {
            $database->query($delete);
            echo "false";
        }
    } else {
        $database->query($delete);
        echo "false";
    }        
    $database->close();
?>
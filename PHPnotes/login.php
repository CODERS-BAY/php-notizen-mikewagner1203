
<?php

    $database = new mysqli("localhost", "webuser", "12345", "notes");
    if($database->connect_errno) {
        printf("Verbindung fehlgeschlagen".$database->connect_error); 
        exit(); 
    }

    $select = $database->prepare("SELECT * FROM user WHERE password=? AND username=?;");

    $select->bind_param("ss", $password, $username);
    $password = $_POST['password'];
    $username = $_POST['username'];

    $select->execute();
    $result = $select->get_result();

    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['color'] = $row['color'];
                $_SESSION['userimage'] = $row['image'];
            }                
        
        echo "true";                               

    } else {
        echo "false";
    }  

    $select->close();
    $database->close();       
?>    


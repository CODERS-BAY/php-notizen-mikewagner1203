<?php
    include_once('header.php');
?>

<main>


    <?php
        $fileuploaded = false;

        if(is_uploaded_file($_FILES['user_image']['tmp_name'])) {
            move_uploaded_file($_FILES['user_image']['tmp_name'], 'images/'. $_FILES['user_image']['name']);
            $fileuploaded = true;
        } else {
            echo '<h3>Fileupload fehlgeschlagen</h3>';
        }


            $database = new mysqli ('localhost', 'webuser', '12345', 'notes');
            if($database->connect_errno) {
                echo "Verbindung fehlgeschlagen".$mysqli->connect_error;
                exit();
            }
            $update = "UPDATE user SET color='".$_POST['color']."' WHERE username='".$_POST['username']."'";

            if($database->query($update)) {
                session_start();
                $_SESSION['color'] = $_POST['color'];
                $_SESSION['userimage'] = $_FILES['user_image']['name'];
                echo "<h3>User wurde aktualisiert<div class='popup_button button'><a href='index.php'/>OK</div></h3>";
            } else {
                echo "<h3>User Update fehlgeschlagen<div class='popup_button button'><a href='index.php'/>OK</div></h3>";              
            }
            $database->close();        
                   

    ?>


</main>



<?php
    include_once('footer.php');
?>
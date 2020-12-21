<?php 
    include_once('header.php');
?>

<main>
    <div class="form_box">
        <?php
            session_start();
            session_unset(); // löscht alle Variablen $_SESSION['username'] etc...
            
            echo "<h3>Du wurdest ausgeloggt<div class='popup_button button'><a href='index.php'/>OK</div></h3>";
        ?>    
    </div>    
</main>

<?php 
    include_once('footer.php');
?>
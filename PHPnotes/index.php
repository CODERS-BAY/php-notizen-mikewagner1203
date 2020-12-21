<?php 
    include_once('header.php');
?>

<main>
    <?php
        session_start();
        $color_class = '';
        if(isset($_SESSION['color'])) {
            $color_class = $_SESSION['color'];
        }        
        if(!isset($_SESSION['username'])) :
    ?>

    <div class="form_box">
        <h2>Login</h2>
        <form id="loginbutton" method="POST">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" value="einloggen">
        </form>
    </div>        

    <!-- Wenn eingeloggt - Nachrichten hier -->

    <?php else: ?>

    <div id="top_bar">
        <?php
            if(isset($_SESSION['username'])) {
                echo '<div id="loginname">'.'<p>'.$_SESSION['username'].'</p>'.'<img id="userimage" src="images/'.$_SESSION['userimage'].'"/>'.'</div>';
            }
        ?>
        <nav>
            <ul>
                <li><a href="userupdate.php">Userfarben ändern</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>

    <div id="entries">
        <?php
            $database = new mysqli('localhost', 'webuser', '12345', 'notes');
            if($database->connect_errno) {
                printf("Verbindung fehlgeschlagen".$database->connect_error); 
                exit(); // skript wird gestoppt.
            }
            $select = "SELECT * FROM entries";
            $result = $database->query($select);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    echo "<div class='entry notiz ".$color_class."' data-id='".$row['entry_number']."'>
                            <div class='delete_button'>X</div>
                            <div class='edit_button'>e</div>
                            <p class='entry_text'>".$row['text']."</p>
                        </div>";
               }       

            } else {
                echo "<h3>Keine Einträge vorhanden</h3>";
            };        
            
            $database->close();
        ?>

    </div> 
        <form id="formaddentries" method="POST">
            <textarea name="entry_text" placeholder="Neue Notiz ..."></textarea>
            <input type="hidden" name="entrynumber" value="">
            <input type="submit" value="Notiz hinzufügen">
        </form>   
    <?php endif; ?>    

</main>
<?php 
    include_once('footer.php');
?>
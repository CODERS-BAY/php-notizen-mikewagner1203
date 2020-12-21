<?php
    include_once('header.php');
?>

<main>
    <?php
        session_start();
        if(isset($_SESSION['username'])) :     
    ?>

    <div class="form_box">
        <h2>Color Update</h2>
        <form action="database_update_user.php" method="POST" enctype="multipart/form-data">
        <?php echo $_SESSION['username']; ?>
            <select name="color">
                <option value="rosa">Rosa</option>
                <option value="blau">Blau</option>
                <option value="gruen">Grün</option>
                <option value="orange">Orange</option>
            </select>
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"/>
            <input type="file" name="user_image">
            <input type="submit" value="Update User"/>
        </form>
        <?php endif; ?>
    </div>
</main>


<?php
    include_once('footer.php');
?>

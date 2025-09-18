<?php include 'connection.php'; ?>
<style>
    body {
        background-color: #B6CEB4;
    }
</style>
<?php

echo $_SESSION['email'];

if((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')){
    header('location:login.php');
}
?>
<a href="logout.php">Logout</a>
<h1>WELCOME TO THE HOME PAGE <?php echo $_SESSION['email']; ?><h1>
        <h2>THIS IS WHERE YOU ADD INFORMATION</h2>
        <p>Add Information</p>




        <form action="admin_process_form.php" method="POST">
            <br>
            <label for="name">first_name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <br>
            <label for="usertype">User Type:</label>
            <select name="usertype" id="usertype">
                <option value="None" selected>
                    <?PHP if ($resultusertype->num_rows > 0) {
                        if ($resultusertype->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultusertype->fetch_assoc()) {
                                echo '<option value=' .$row['usertype']. '>' . $row['usertype'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <button type="submit" name="update">Update</button>
        </form>
        <a href="superupdate.php">admin update</a>
        <a href="test.php">admin page</a>
        <a href="superassign.php">assign roles</a>
<?php include 'connection.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body {
        background-color: #B6CEB4;
    }

    .heading {
        position: absolute;
        right: 0;
    }
</style>
<div class="heading">
    <?php

    echo $_SESSION['email'];

    if ((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
</div>
<h1>WELCOME TO THE HOME PAGE <?php echo $_SESSION['email']; ?><h1>
        <h2>THIS IS WHERE YOU ADD INFORMATION</h2>
        <p>Add Information</p>




        <form action="admin_process_form.php" method="POST">
            <br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <br>
            <label for="usertype">User Type:</label>
            <select name="usertype" id="usertype">
                <option value="None" selected>
                    <?PHP if ($resultusertype->num_rows > 0) {
                        if ($resultusertype->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultusertype->fetch_assoc()) {
                                $userTypeText = '';
                                switch ($row['usertype']) {
                                    case '3':
                                        $userTypeText = 'user';
                                        break;
                                    case '2':
                                        $userTypeText = 'admin';
                                        break;
                                    default:
                                        $userTypeText = 'unknown'; 
                                }
                                echo '<option value="' . $row['usertype'] . '">' . $row['usertype'] . ' - ' . $userTypeText . '</option>';

                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>
        <a href="superupdate.php" class="btn btn-success">admin update</a>
        <a href="test.php" class="btn btn-success">admin page</a>
        <a href="superassign.php" class="btn btn-success">assign roles</a>
        <a href="superapprove.php" class="btn btn-success">approve users</a>
        <?php include 'footer.php'; ?>
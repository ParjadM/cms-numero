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

    if (!$_SESSION['email']) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
    <br>
</div>
<h1>WELCOME TO THE HOME PAGE <?php echo $_SESSION['email']; ?><h1>
        <h2>THIS IS WHERE YOU ADD INFORMATION</h2>
        <hr>
        <p>Add Information</p>

        <form action="process_form.php" method="POST">
            <label for="first_name">first_name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <br>

            <label for="last_name">last_name:</label>
            <input type="last_name" id="last_name" name="last_name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="date_started">Date:</label>
            <input type="date" id="date_started" name="date_started" required>

            <br>
            <label for="genderid">Gender:</label>
            <select name="genderid" id="genderid">
                <option value="None" selected>
                    <?PHP if ($resultgender->num_rows > 0) {
                        if ($resultgender->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultgender->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . ' = ' . $row['gender'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <label for="shirtsizeid">Shirt Size:</label>
            <select name="shirtsizeid" id="shirtsizeid">
                <option value="None" selected>
                    <?PHP if ($resultshirtsize->num_rows > 0) {
                        if ($resultshirtsize->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultshirtsize->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . ' = ' . $row['shirtsize'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <label for="departmentid">Department:</label>
            <select name="departmentid" id="departmentid">
                <option value="None" selected>
                    <?PHP if ($resultdepartment->num_rows > 0) {
                        if ($resultdepartment->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultdepartment->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . ' = ' . $row['departments'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <label for="regionid">Region:</label>
            <select name="regionid" id="regionid">
                <option value="None" selected>
                    <?PHP if ($resultregion->num_rows > 0) {
                        if ($resultregion->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultregion->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . ' = ' . $row['regions'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <label for="positionId">Position:</label>
            <select name="date_started" id="date_started">
                <option value="None" selected>
                    <?PHP if ($resultposition->num_rows > 0) {
                        if ($resultposition->num_rows > 0) {
                            // output data of each row
                            while ($row = $resultposition->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . ' = ' . $row['position'] . ': ' . $row['salary'] . '</option>';
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>
            <label for="assign">Assigned:</label>
            <select name="assign" id="assign">
                <option value="None" selected>
                    <?PHP 
                    $name = '';
                    if ($resultassign->num_rows > 0) {
                        if ($resultassign->num_rows > 0) {
                            while ($row = $resultassign->fetch_assoc()) {
                                if ($row['email'] == $_SESSION['email']) {
                                    $name = $row['name'];
                                    break;
                                }
                            }
                            //resets the fetch_assoc pointer to the beginning
                            $resultassign->data_seek(0);


                            // output data of each row
                            while ($row = $resultassign->fetch_assoc()) {
                                if ($row['assign'] == $name) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            }
                        } else {
                            echo "<option value='None' selected>";
                        }
                    }
                    ?>
            </select>
            <br>

            <button type="submit" class="btn btn-success">Submit</button>

        </form>

        <a href="update.php" class="btn btn-success">Update</a>
        <a href="userhome.php" class="btn btn-secondary">User page</a>
        <a href="department.php" class="btn btn-primary">Department</a>
        <a href="gender.php" class="btn btn-primary">Gender</a>
        <a href="position.php" class="btn btn-primary">Position</a>
        <a href="region.php" class="btn btn-primary">Region</a>
        <a href="shirtsize.php" class="btn btn-primary">Shirt Size</a>
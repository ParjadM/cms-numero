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
    //need to fix this
    if (!$_SESSION['email']) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
    <br>
</div>

<?php include 'connection.php';
$s_id = $_GET['id'];
$get_sql = "SELECT id,first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId FROM info WHERE id='$s_id'";

$query = mysqli_query($conn, $get_sql);

$Onerow = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $s_ids = $_GET['id'];
    $s_id = $_POST['id'];
    $s_first_name = $_POST['first_name'];
    $s_last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_started = $_POST['date_started'];
    $genderid = $_POST['genderid'];
    $shirtsizedid = $_POST['shirtsizeid'];
    $departmentid = $_POST['departmentid'];
    $regionId = $_POST['regionid'];
    $positionId = $_POST['positionId'];
    
    $update_sql = "Update info set id='$s_id', first_name='$s_first_name', last_name='$s_last_name', email='$email', date_started='$date_started', genderid='$genderid', shirtsizeid='$shirtsizedid', departmentid='$departmentid', regionId='$regionId', positionId='$positionId' where id='$s_ids'";

    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: update.php");
}
?>
<h1>Update this page</h1>




<form action="" method="POST">
    <label for="id">id:</label>
    <input type="number" name="id" value="<?php echo $Onerow['id']; ?>">
    <br>
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $Onerow['first_name']; ?>">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $Onerow['last_name']; ?>">
    <br>
    <label for="first_name">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $Onerow['email']; ?>">
    <br>
    <label for="date_started">Date Started:</label>
    <input type="date" id="date_started" name="date_started" value="<?php echo $Onerow['date_started']; ?>">
    <br>
    <label for="genderid">Gender:</label>
    <select name="genderid" id="genderid">
        <option value="None" selected>
            <?PHP if ($resultgender->num_rows > 0) {
                if ($resultgender->num_rows > 0) {
                    // output data of each row
                    while ($row = $resultgender->fetch_assoc()) {
                        if ($row['id'] == $Onerow['genderid']) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['gender'] . '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['gender'] . '</option>';
                        }
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
                        if ($row['id'] == $Onerow['shirtsizeid']) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['shirtsize'] . '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['shirtsize'] . '</option>';
                        }
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
                        if ($row['id'] == $Onerow['departmentid']) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['departments'] . '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['departments'] . '</option>';
                        }
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
                        if ($row['id'] == $Onerow['regionId']) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['regions'] . '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['regions'] . '</option>';
                        }
                    }
                } else {
                    echo "<option value='None' selected>";
                }
            }
            ?>
    </select>
    <br>
    <label for="positionId">Position:</label>
    <select name="positionId" id="positionId">
        <option value="None" selected>
            <?PHP if ($resultposition->num_rows > 0) {
                if ($resultposition->num_rows > 0) {
                    // output data of each row
                    while ($row = $resultposition->fetch_assoc()) {
                        if ($row['id'] == $Onerow['positionId']) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['position'] .  '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['position'] . '</option>';
                        }
                    }
                } else {
                    echo "<option value='None' selected>";
                }
            }
            ?>
    </select>
    <br>
    <button type="submit" name="update" class="btn btn-success">Update</button>
</form>
<a href="update.php" class="btn btn-info">Back</a>
<?php include 'footer.php'; ?>
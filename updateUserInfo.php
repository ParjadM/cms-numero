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

    if ((!isset($_SESSION['email']))) {
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
    $shirtsizedid = $_POST['shirtsizeid'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $update_sql = "Update info set shirtsizeid='$shirtsizedid', first_name='$first_name', last_name='$last_name', email='$email' where id='$s_ids'";

    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: userhome.php");
}
?>
<h1>Update this page</h1>
<form action="" method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $Onerow['first_name']; ?>">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $Onerow['last_name']; ?>">
    <br>
    <label for="first_name">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $Onerow['email']; ?>">
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
    <button type="submit" name="update" class="btn btn-success">Update</button>
</form>
<a href="userhome.php" class="btn btn-info">Back</a>











<?php include 'footer.php'; ?>
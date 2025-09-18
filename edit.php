<style>
body {
  background-color: #B6CEB4;
}
</style>
<a href="logout.php">Logout</a>

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
    $positionId = $_POST['positionid'];

    $update_sql = "Update info set id='$s_id', first_name='$s_first_name', last_name='$s_last_name', email='$email', date_started='$date_started', genderid='$genderid', shirtsizeid='$shirtsizedid', departmentid='$departmentid', regionId='$regionId', positionId='$positionId' where id='$s_ids'";

    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: update.php");
}
?>
<p>Update this page</p>




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
    <input type="text" id="genderid" name="genderid" value="<?php echo $Onerow['genderid']; ?>">
    <br>
    <label for="shirtsizeid">Shirt Size:</label>
    <input type="text" id="shirtsizeid" name="shirtsizeid" value="<?php echo $Onerow['shirtsizeid']; ?>">
    <br>
    <label for="departmentid">Department:</label>
    <input type="text" id="departmentid" name="departmentid" value="<?php echo $Onerow['departmentid']; ?>">
    <br>
    <label for="regionid">Region:</label>
    <input type="text" id="regionid" name="regionid" value="<?php echo $Onerow['regionId']; ?>">
    <br>
    <label for="positionid">Position:</label>
    <input type="text" id="positionid" name="positionid" value="<?php echo $Onerow['positionId']; ?>">
    <br>
    <button type="submit" name="update">Update</button>
</form>
<a href="update.php">Back</a>
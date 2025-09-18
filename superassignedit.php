<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<?php include 'connection.php'; ?>
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

<?php 

// if ((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')) {
//     header('location:login.php');
// }
$s_id = $_GET['id'];
$get_sql = "SELECT id,name, email , usertype FROM info WHERE id='$s_id'";

$query = mysqli_query($conn, $get_sql);

$Onerow = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $s_ids = $_GET['id'];
    $admin = $Onerow['name'];
    $user_id = $_POST['userid'];
    
    $admin_name = $Onerow['name']; 

    $update_sql = "UPDATE info SET assign ='$admin_name' WHERE id = '$user_id'";
    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: superassign.php");
}
?>
<p>Update this page</p>




<form action="" method="POST">
    <label for="id">id:</label>
    <label type="number" name="id"><?php echo $Onerow['id']; ?></label>
    <br>
    <label for="name">First Name:</label>
    <label type="text" id="name" name="name"><?php echo $Onerow['name']; ?></label>
    <br>
    <label for="email">Email:</label>
    <label type="email" id="email" name="email"><?php echo $Onerow['email']; ?></label>
    <br>
    <label for="userid">Users:</label>
    <select name="userid" id="userid">
        <option value="None" selected>
            <?PHP if ($resultuser->num_rows > 0) {
                if ($resultuser->num_rows > 0) {
                    // output data of each row
                    while ($row = $resultuser->fetch_assoc()) {
                        echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
                    }
                } else {
                    echo "<option value='None' selected>";
                }
            }
            ?>
    </select>
    <button type="submit" name="update" class="btn btn-success">Update</button>
</form>
<a href="superupdate.php" class="btn btn-primary">Back</a>
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
$get_sql = "SELECT departments FROM department WHERE id='$s_id'";

$query = mysqli_query($conn, $get_sql);

$Onerow = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $s_ids = $_GET['id'];
    $s_departments = $_POST['departments'];

    $update_sql = "Update department set departments='$s_departments' where id='$s_ids'";

    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: department.php");
}
?>
<h1>Update this page</h1>




<form action="" method="POST">
    <label for="departments">Department Name:</label>
    <input type="text" id="departments" name="departments" value="<?php echo $Onerow['departments']; ?>">
    <br>
    <button type="submit" name="update" class="btn btn-success">Update</button>
</form>
<a href="update.php"  class="btn btn-info">Back</a>
<?php include 'footer.php'; ?>
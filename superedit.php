<style>
body {
  background-color: #B6CEB4;
}
</style>
<a href="logout.php">Logout</a>

<?php include 'connection.php';

if((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')){
    header('location:login.php');
}
$s_id = $_GET['id'];
$get_sql = "SELECT id,name, email , usertype FROM info WHERE id='$s_id'";

$query = mysqli_query($conn, $get_sql);

$Onerow = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $s_ids = $_GET['id'];
    $s_id = $_POST['id'];
    $s_name = $_POST['name'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

    $update_sql = "Update info set id='$s_id', name='$s_name', email='$email', usertype='$usertype' where id='$s_ids'";;

    $data = mysqli_query($conn, $update_sql);

    if ($data) {
        echo "<script>alert('data updated sucessful');</script>";
    }
    header("Location: superupdate.php");
}
?>
<p>Update this page</p>




<form action="" method="POST">
    <label for="id">id:</label>
    <input type="number" name="id" value="<?php echo $Onerow['id']; ?>">
    <br>
    <label for="name">First Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $Onerow['name']; ?>">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $Onerow['email']; ?>">
    <br>
    <label for="usertype">User Type:</label>
    <input type="text" id="usertype" name="usertype" value="<?php echo $Onerow['usertype']; ?>">
    <br>
    <button type="submit" name="update">Update</button>
</form>
<a href="superupdate.php">Back</a>
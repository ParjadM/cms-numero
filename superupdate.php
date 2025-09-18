<?php include 'connection.php'; ?>
<style>
body {
  background-color: #B6CEB4;
}
</style>
<?php

echo $_SESSION['email'];

if((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '`')){
    header('location:login.php');
}
?>
<a href="logout.php">Logout</a>
<?php 
    if(isset($_GET['id']))
    {
        $s_delete = $_GET['id'];
        $del_sql = "Delete from info where id='$s_delete'";

        $dataD = mysqli_query($conn,$del_sql);
        header("Location: superupdate.php");
    }
?>
<h1>Super User page</h1>
<p>id -- name -- email -- usertype -- assign</p>
<?PHP 

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<p>' . $row['id'] . ' - ' . $row['name'] . ' - ' . $row['email'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'];
            echo '<a href="superedit.php?id=' . $row['id'] . '">update</a>';
            echo '<a href="superupdate.php?id=' . $row['id'] . '">delete</a>';
        }
    } else {
        echo "There is no data";
    }

?>
<a href="superadmin.php">Home Page</a>
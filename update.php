<?php include 'connection.php'; ?>
<style>
body {
  background-color: #B6CEB4;
}
</style>
<?php

echo $_SESSION['email'];

if(!$_SESSION['email']){
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
        header("Location: test.php");
    }
?>
<h1>Info page</h1>
<p>first_name, - last_name - email - date_started - genderid - shirtsizeid - departmentid - regionId - positionId</p>
<?PHP 

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId']  . '</p>';
            echo '<a href="edit.php?id=' . $row['id'] . '">update</a>';
            echo '<a href="update.php?id=' . $row['id'] . '">delete</a>';
        }
    } else {
        echo "There is no data";
    }

?>
<a href="test.php">Home Page</a>
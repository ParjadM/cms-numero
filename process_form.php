<style>
body {
  background-color: #B6CEB4;
}
</style>
<?php include 'connection.php';?>
<?php

echo $_SESSION['email'];

if(!$_SESSION['email']){
    header('location:login.php');
}
?>    
<a href="logout.php">Logout</a>
<?php 


$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$date_started = mysqli_real_escape_string($conn, $_POST['date_started']);
$genderid = mysqli_real_escape_string($conn, $_POST['genderid']);
$shirtSizeid = mysqli_real_escape_string($conn, $_POST['shirtsizeid']);
$departmentid = mysqli_real_escape_string($conn, $_POST['departmentid']);
$regionid = mysqli_real_escape_string($conn, $_POST['regionid']);
$positionid = mysqli_real_escape_string($conn, $_POST['date_started']);



$sql = "INSERT INTO info (first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId) 
        VALUES ('$first_name', '$last_name', '$email', '$date_started', '$genderid', '$shirtSizeid', '$departmentid','$regionid','$positionid')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header('location:test.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
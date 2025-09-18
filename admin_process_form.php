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


$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$usertype = mysqli_real_escape_string($conn, $_POST['usertype']);



$sql = "INSERT INTO info (name,email, usertype) 
        VALUES ('$name', '$email', '$usertype')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header('location:superadmin.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
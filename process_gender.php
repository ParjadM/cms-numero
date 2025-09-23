<?php include 'connection.php'; ?>
<?php 
$genderid = mysqli_real_escape_string($conn, $_POST['id']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

$sql3 = "INSERT INTO gender (id, gender) 
        VALUES ('$genderid', '$gender')";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
    header('location:gender.php');
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
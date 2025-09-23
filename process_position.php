<?php include 'connection.php'; ?>
<?php 
$positionid = mysqli_real_escape_string($conn, $_POST['id']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$salary = mysqli_real_escape_string($conn, $_POST['salary']);

$sql3 = "INSERT INTO position ( position, salary) 
        VALUES ( '$position', '$salary')";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
    header('location:position.php');
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
<?php include 'connection.php'; ?>
<?php 
$regionid = mysqli_real_escape_string($conn, $_POST['id']);
$regions = mysqli_real_escape_string($conn, $_POST['regions']);

$sql3 = "INSERT INTO region (regions) 
        VALUES ( '$regions')";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
    header('location:region.php');
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
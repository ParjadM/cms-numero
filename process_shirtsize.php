<?php include 'connection.php'; ?>
<?php 
$shirtsizeid = mysqli_real_escape_string($conn, $_POST['id']);
$shirtsize = mysqli_real_escape_string($conn, $_POST['shirtsize']);

$sql3 = "INSERT INTO shirt_size (shirtsize) 
        VALUES ('$shirtsize')";

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
    header('location:shirtsize.php');
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
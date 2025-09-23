<?php include 'connection.php'; ?>
<?php 


$departmentid = mysqli_real_escape_string($conn, $_POST['id']);
$departmentname = mysqli_real_escape_string($conn, $_POST['departments']);





$sql2 = "INSERT INTO department (id, departments) 
        VALUES ('$departmentid', '$departmentname')";




if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
    header('location:department.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

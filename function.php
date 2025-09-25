<?php
$s_id = $_GET['id'];

include 'connection.php';


$ids = $_GET['id'];
$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$date_started = $_POST['date_started'];
$genderid = $_POST['genderid'];
$shirtsizedid = $_POST['shirtsizeid'];
$departmentid = $_POST['departmentid'];
$regionId = $_POST['regionid'];
$positionId = $_POST['positionId'];
$usertype = $_POST['usertype'];
$assign = $_POST['assign'];
$password = $_POST['password'];
$name = $_POST['name'];

$sql = "INSERT INTO info (first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId, usertype, assign, password, name)
    SELECT first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId, usertype, assign, password, name
    FROM info2;";

$sql2 = "UPDATE approval SET approval = '1' WHERE user_id = '$s_id'";

$sql3 = "DELETE FROM info2 WHERE id = '$s_id'";



if ($conn->query($sql) === TRUE) {
    if ($conn->query($sql2) === TRUE) {
        if ($conn->query($sql3) === TRUE) {
            echo "New record created successfully";
            header('location:superapprove.php');
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

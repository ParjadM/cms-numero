
<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mockdb";


$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT id,first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId, usertype, assign, password, name FROM info";
$sql1 = "SELECT id,name,email, usertype, assign FROM user";
$result = $conn->query($sql);
//$result1 = $conn->query($sql1);


//super admin
$sqlname = "SELECT id,name from info";
$resultname = $conn->query($sqlname);


$sqlemail = "SELECT id,email from info";
$resultemail = $conn->query($sqlemail);


$sqlusertype = "SELECT DISTINCT usertype FROM info WHERE usertype!='1'";
$resultusertype = $conn->query($sqlusertype);

$sqluser = "SELECT id,name,email,assign FROM info WHERE usertype = '3'";
$resultuser = $conn->query($sqluser);

$sqladmin = "SELECT name,email FROM user WHERE usertype = '2'";
$resultadmin = $conn->query($sqladmin);




//admin
$sqlgender = "Select id, gender from gender";
$resultgender = $conn->query($sqlgender);


$sqlshirtsize = "Select id, shirtsize from shirt_size";
$resultshirtsize = $conn->query($sqlshirtsize);

///////
$sqldepartmentid = "Select id, departments from department";
$resultdepartment = $conn->query($sqldepartmentid);

$sqlregionid = "Select id, regions from region";
$resultregion = $conn->query($sqlregionid);

$sqlpositionid = "Select id, position, salary from position";
$resultposition = $conn->query($sqlpositionid);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

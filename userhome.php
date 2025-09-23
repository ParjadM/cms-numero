<?php include 'connection.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body {
        background-color: #B6CEB4;
    }

    .heading {
        position: absolute;
        right: 0;
    }
    
</style>
<?php include 'header.php'; ?>
<div class="heading">
    <?php

    echo $_SESSION['email'];

    if (!$_SESSION['email']) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
    <br>
</div>
<?php
if (isset($_GET['id'])) {
    $s_delete = $_GET['id'];
    $del_sql = "Delete from info where id='$s_delete'";

    $dataD = mysqli_query($conn, $del_sql);
    header("Location: test.php");
}
?>
<h1>Info page</h1>
<p>first_name, - last_name - email - date_started - genderid - shirtsizeid - departmentid - regionId - positionId</p>
<?PHP

if ($result->num_rows > 0) {
    $email = $_SESSION['email'];
    $name = '';
    while ($row = $result->fetch_assoc()) {
        if ($row['email'] == $email) {
            $name = $row['name'];
        }
    }
    //resets the fetch_assoc pointer to the beginning
    $result->data_seek(0);
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row['assign'] == $name) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId']  . '</p>';
        } else if ($row['email'] == $email) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId']  . '</p>';
        }
    }
    $result->data_seek(0);
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($_SESSION['usertype'] == '1') {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId']  . '</p>';
        } 
    }
} else {
    echo "There is no data";
}

?>
<?PHP
 if ($_SESSION['usertype'] == '1' || $_SESSION['usertype'] == '2') {
    echo '<a href="update.php" class="btn btn-success">Update Info Page</a>';
    echo '<a href="test.php" class="btn btn-success">Home Page</a>';
 }

?>
<?php include 'footer.php'; ?>
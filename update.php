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
<div class="heading">
    <?php

    echo $_SESSION['email'];

    if ((!isset($_SESSION['email']) || ($_SESSION['usertype'] !== '1' && $_SESSION['usertype'] !== '2'))) {
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
    header("Location: update.php");
}
?>
<h1>Info page</h1>
<p>first_name, - last_name - email - date_started - genderid - shirtsizeid - departmentid - regionId - positionId - usertype - assign - name</p>
<?PHP

if ($result->num_rows > 0) {
    // output data of each row
    $email = $_SESSION['email'];
    $name = '';
    while ($row = $result->fetch_assoc()) {
        if ($row['email'] == $email) {
            $name = $row['name'];
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'] .  ' - ' . $row['name'] . '</p>';
            echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
            echo '<a href="update.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
        }
    }
    //resets the fetch_assoc pointer to the beginning
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        if ($row['assign'] == $name) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'] .  ' - ' . $row['name'] . '</p>';
            echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
            echo '<a href="update.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
        }
        if ($_SESSION['usertype'] == '1') {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['genderid'] . ' - ' . $row['shirtsizeid'] . ' - ' . $row['departmentid'] . ' - ' . $row['regionId'] . ' - ' . $row['positionId'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'] .  ' - ' . $row['name'] . '</p>';
            echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
            echo '<a href="update.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
        }
    }
} else {
    echo "There is no data";
}

?>
<br>
<a href="test.php" class="btn btn-success">Home Page</a>
<?php include 'footer.php'; ?>
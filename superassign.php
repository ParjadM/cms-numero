<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php include 'connection.php'; ?>
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

    if ((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
</div>
<?php
if (isset($_GET['id'])) {
    $s_delete = $_GET['id'];
    $del_sql = "Delete from info where id='$s_delete'";

    $dataD = mysqli_query($conn, $del_sql);
    header("Location: superassign.php");
}
?>
<h1>Super User page</h1>
<p>id -- name -- email -- usertype -- assign</p>
<?PHP

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row['usertype'] === '2') {
            echo '<p>' . $row['id'] . ' - ' . $row['name'] . ' - ' . $row['email'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'];
            echo '<a href="superassignedit.php?id=' . $row['id'] . '" class="btn btn-warning">update</a>';
            echo '<a href="superassign.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
        }
    }
} else {
    echo "There is no data";
}

?>
<br>
<a href="superadmin.php" class="btn btn-success">Home Page</a>
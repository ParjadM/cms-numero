<?php include 'connection.php'; ?>
<?php include 'function.php'; ?>
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
<p>first_name, - last_name - email - date_started - genderid - shirtsize - departmentid - regionId - positionId</p>
<?PHP

// The corrected SQL query with a JOIN to get the shirtsize name
$sql = "SELECT i.id, i.first_name, i.last_name, i.email, i.date_started, i.usertype, i.assign, i.password, i.name,g.gender,s.shirtsize,d.departments,r.regions,p.position
        FROM info i
        LEFT JOIN gender g ON i.genderid = g.id
        LEFT JOIN shirt_size s ON i.shirtsizeid = s.id
        LEFT JOIN department d ON i.departmentid = d.id
        LEFT JOIN region r ON i.regionId = r.id
        LEFT JOIN position p ON i.positionId = p.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $email = $_SESSION['email'];
    $name = '';
    
    //avoid multiple database calls
    $all_rows = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($all_rows as $row) {
        if ($row['email'] == $email) {
            $name = $row['name'];
            break;
        }
    }

    //loop through the data and print based on user type or assign.
    foreach ($all_rows as $row) {
        
        if ($row['assign'] === $name) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['gender'] . ' - ' . $row['shirtsize'] . ' - ' . $row['departments'] . ' - ' . $row['regions'] . ' - ' . $row['position'] . '</p>';
        }

        if ($row['email'] == $email) {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['gender'] . ' - ' . $row['shirtsize'] . ' - ' . $row['departments'] . ' - ' . $row['regions'] . ' - ' . $row['position'] . '</p>';
            echo '<a href="updateUserInfo.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
        }
    }
    
    // Super admin section
    foreach ($all_rows as $row) {
        if ($_SESSION['usertype'] == '1') {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['gender'] . ' - ' . $row['shirtsize'] . ' - ' . $row['departments'] . ' - ' . $row['regions'] . ' - ' . $row['position'] . '</p>';
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
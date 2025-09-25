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

    if ((!isset($_SESSION['email']) || $_SESSION['usertype'] !== '1')) {
        header('location:login.php');
    }
    ?>
    <a href="logout.php" class="btn btn-warning">Logout</a>
</div>
<?PHP
$sql = "SELECT i.id, i.first_name, i.last_name, i.email, i.date_started, i.usertype, i.assign, i.password, i.name,g.gender,s.shirtsize,d.departments,r.regions,p.position
        FROM info2 i
        LEFT JOIN gender g ON i.genderid = g.id
        LEFT JOIN shirt_size s ON i.shirtsizeid = s.id
        LEFT JOIN department d ON i.departmentid = d.id
        LEFT JOIN region r ON i.regionId = r.id
        LEFT JOIN position p ON i.positionId = p.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //resets the fetch_assoc pointer to the beginning
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {   
        if ($_SESSION['usertype'] == '1') {
            echo '<p>' . $row['id'] . ' - ' . $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'] . ' - ' . $row['date_started'] . ' - ' . $row['gender'] . ' - ' . $row['shirtsize'] . ' - ' . $row['departments'] . ' - ' . $row['regions'] . ' - ' . $row['position'] . ' - ' . $row['usertype'] . ' - ' . $row['assign'] .  ' - ' . $row['name'] . '</p>';
            echo '<a href="function.php?id=' . $row['id'] . '" class="btn btn-primary">approve</a>';

        }
    }
} else {
    echo "There is no data";
}

?>

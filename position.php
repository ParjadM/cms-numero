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
    $del_sql = "Delete from position where id='$s_delete'";

    $dataD = mysqli_query($conn, $del_sql);
    header("Location: position.php");
}
?>

<h1>WELCOME TO THE Position PAGE <?php echo $_SESSION['email']; ?><h1>
        <h2>THIS IS WHERE YOU UPDATE Position</h2>
        <hr>
        <p>View Position</p>
        <?PHP

        if ($positiontable->num_rows > 0) {
            while ($row = $positiontable->fetch_assoc()) {
                echo '<p>' . $row['position'] . ' - ' . $row['salary'] . '</p>';
                echo '<a href="updateposition.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
                echo '<a href="position.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
            }
        } else {
            echo "There is no data";
        }

        ?>
        <br>
        <p>ADD Position</p>
        <form action="process_position.php" method="POST">
            <label for="position">Position Name:</label>
            <input type="text" id="position" name="position" required>
            <br>
            <label for="salary">Salary:</label>
            <input type="text" id="salary" name="salary" required>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <a href="test.php" class="btn btn-success">Back To Admin</a>
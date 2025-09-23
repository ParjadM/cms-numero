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
    $del_sql = "Delete from shirt_size where id='$s_delete'";

    $dataD = mysqli_query($conn, $del_sql);
    header("Location: shirtsize.php");
}
?>

<h1>WELCOME TO THE Shirt Size PAGE <?php echo $_SESSION['email']; ?><h1>
        <h2>THIS IS WHERE YOU UPDATE Shirt Size</h2>
        <hr>
        <p>View Shirt Size</p>
        <?PHP

        if ($shirtsizetable->num_rows > 0) {
            while ($row = $shirtsizetable->fetch_assoc()) {
                echo '<p>' . $row['id'] . ' - ' . $row['shirtsize'] . '</p>';
                echo '<a href="updateshirtsize.php?id=' . $row['id'] . '" class="btn btn-primary">update</a>';
                echo '<a href="shirtsize.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a>';
            }
        } else {
            echo "There is no data";
        }

        ?>
        <br>
        <p>ADD Shirt Size</p>
        <form action="process_shirtsize.php" method="POST">
            <label for="id">Shirt Size ID:</label>
            <input type="text" id="id" name="id" required>
            <br>
            <label for="shirtsize">Shirt Size Name:</label>
            <input type="text" id="shirtsize" name="shirtsize" required>
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <a href="test.php" class="btn btn-success">Back To Admin</a>
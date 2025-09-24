<?php include 'connection.php'; ?>
<?php
if (isset($_GET['id'])) {
    $s_delete = $_GET['id'];
    $del_sql = "Delete from info where id='$s_delete'";

    $dataD = mysqli_query($conn, $del_sql);
    header("Location: test.php");
}
?>

<?php 
 $sql2 = "SELECT i.id, i.first_name, i.last_name, i.email, i.date_started, 
                   i.genderid, i.shirtsizeid, i.departmentid, i.regionId, 
                   i.positionId, i.usertype, i.assign, i.password, i.name,
                   s.shirtsize, d.department, r.region, p.position
            FROM info i
            INNER JOIN shirtsize s ON i.shirtsizeid = s.id
            INNER JOIN department d ON i.departmentid = d.id
            INNER JOIN region r ON i.regionId = r.id
            INNER JOIN position p ON i.positionId = p.id
            WHERE i.id = ?"; 


function gender($id) {
    
}

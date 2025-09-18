<style>
body {
  background-color: #B6CEB4;
}
</style>

<?php

include 'connection.php';

if(isset($_POST['register'])){
 $username=$_POST['name'];
 $email=$_POST['email'];
 $password=$_POST['password'];
 $sql1="INSERT INTO info (name,email,password) VALUES ('$username','$email','$password') ";

 $result= mysqli_query($conn,$sql1);
 if($result){
    header('location:login.php');
 }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        .form_pos
        {
            padding-top: 200px;
        }
        label
        {
            display: inline-block;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .form_deg {
            background-color: skyblue;
            width: 500px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
        .title
        {
            background-color: black;
            color: white;
            width: 500px;
            font-size: 25px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="form_pos">
        <center>
            <div class="title">Register</div>

            <form  action="register.php" method="POST" class="form_deg">
                <div>
                    <label>Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="submit" class="btn btn-success"  name="register" value="Register">
                </div>
            </form>
        </center>
    </div>
</body>

</html>
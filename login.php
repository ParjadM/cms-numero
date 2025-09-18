<?php
include 'connection.php';
if (isset($_POST['login'])) {
    ob_start();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql1 = "SELECT * FROM info WHERE email='" . $email . "' AND password='" . $pass . "'";
    $result = mysqli_query($conn, $sql1);

    $row1 = mysqli_fetch_array($result);

    if ($row1['usertype'] === '2') {
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = '2';
        header('Location:test.php');
        exit();
    } else if ($row1['usertype'] === '3') {
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = '3';
        header('Location:userhome.php');
        exit();
    } else if ($row1['usertype'] === '1') {
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = '1';
        header('Location:superadmin.php');
        exit();
    } else {
        echo "Email or Password do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        body {
            background-color: #B6CEB4;
        }

        .form_pos {
            padding-top: 200px;
        }

        label {
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

        .form_deg {
            background: rgba(255, 0, 0, 0.25);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0px 8px 32px 0px rgba(0, 0, 0, 0.37);
            color: #fff;
            padding: 1.5rem;
        }

        .title {
            background-color: black;
            color: white;
            width: 500px;
            font-size: 25px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: bold;
        }

        .title {
            background: rgba(255, 0, 0, 0.25);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0px 8px 32px 0px rgba(0, 0, 0, 0.37);
            color: #fff;
            padding: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="form_pos">
        <center>
            <div class="title">Login</div>

            <form action="login.php" method="POST" class="form_deg">
                <div>
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <input type="submit" class="btn btn-success" name="login" value="Login">
                    <a href="register.php" class="btn btn-danger">Register</a>
                </div>
            </form>
        </center>
    </div>
</body>
</html>
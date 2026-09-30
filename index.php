<?php
session_start();
include "config/db.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();

    } else {
        echo "<script>alert('Username or Password incorrect');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ورود سیستم</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>ورود به سیستم</h4>
                </div>

                <div class="card-body">

                    <form method="POST" autocomplete="on">

                        <div class="mb-3">
                            <label>نام کاربری</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>رمز عبور</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
                            ورود
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Login System</h4>
                </div>

                <div class="card-body">

                    <form method="POST" autocomplete="off">

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required >
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->


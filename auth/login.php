<?php
session_start();
include "../config/db.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header("Location: ../dashboard.php");
        exit();
    } else {
        $error = "نام کاربری یا رمز اشتباه است";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود سیستم</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">

        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

            <div class="card shadow p-4">

                <h4 class="text-center mb-3">ورود به سیستم</h4>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form method="POST">

                    <div class="mb-3">
                        <label>نام کاربری</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>رمز عبور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100" name="login">
                        ورود
                    </button>

                </form>

            </div>

        </div>

    </div>
    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>
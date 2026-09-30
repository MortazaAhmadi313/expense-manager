<?php include "../assets/components/navbar.php"; ?>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

if (isset($_POST['save'])) {

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $sql = "INSERT INTO expenses (title, amount, expense_date)
            VALUES ('$title', '$amount', '$date')";

    if ($conn->query($sql)) {
        $success = "مصرف با موفقیت ثبت شد";
    } else {
        $error = "خطا در ثبت مصرف";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>افزودن مصرف</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card p-4 shadow">

                    <h4 class="mb-3">افزودن مصرف جدید</h4>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php } ?>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>عنوان مصرف</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>مقدار</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>تاریخ</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <button class="btn btn-danger w-100" name="save">
                            ثبت مصرف
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
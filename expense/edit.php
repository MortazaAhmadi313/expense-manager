<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

$id = $_GET['id'];

$result = $conn->query("
    SELECT *
    FROM expenses
    WHERE id = $id
");

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $expense_date = $_POST['expense_date'];

    $sql = "
        UPDATE expenses
        SET
            title='$title',
            amount='$amount',
            expense_date='$expense_date'
        WHERE id=$id
    ";

    if ($conn->query($sql)) {
        header("Location: list.php");
        exit();
    } else {
        echo "خطا در ویرایش";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ویرایش مصرف</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h3 class="mb-4">
                ویرایش مصرف
            </h3>

            <form method="POST">

                <div class="mb-3">
                    <label>عنوان مصرف</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?php echo $row['title']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>مقدار</label>

                    <input
                        type="number"
                        name="amount"
                        class="form-control"
                        value="<?php echo $row['amount']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>تاریخ</label>

                    <input
                        type="date"
                        name="expense_date"
                        class="form-control"
                        value="<?php echo $row['expense_date']; ?>"
                        required>
                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-success">
                    ذخیره تغییرات
                </button>

                <a href="list.php" class="btn btn-secondary">
                    بازگشت
                </a>

            </form>

        </div>

    </div>

</body>

</html>
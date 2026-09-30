<?php include "../assets/components/navbar.php"; ?>
<?php
include "../config/db.php";

if (isset($_POST['save'])) {

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $sql = "INSERT INTO incomes (title, amount, income_date)
            VALUES ('$title', '$amount', '$date')";

    $conn->query($sql);

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>افزودن درآمد</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4">

        <h4 class="mb-3">
            <i class="bi bi-cash-coin"></i> افزودن درآمد
        </h4>

        <form method="POST">

            <div class="mb-3">
                <label>عنوان درآمد</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>مقدار (افغانی)</label>
                <input type="number" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>تاریخ</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <button class="btn btn-success w-100" name="save">
                <i class="bi bi-check-circle"></i> ذخیره
            </button>

        </form>

    </div>

</div>

</body>
</html>
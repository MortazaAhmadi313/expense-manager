<?php

include "../config/db.php";

$id = $_GET['id'];

$result = $conn->query("
    SELECT *
    FROM incomes
    WHERE id = $id
");

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $income_date = $_POST['income_date'];

    $sql = "
        UPDATE incomes
        SET
            title='$title',
            amount='$amount',
            income_date='$income_date'
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

    <title>ویرایش درآمد</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h3 class="mb-4">
                ویرایش درآمد
            </h3>

            <form method="POST">

                <div class="mb-3">

                    <label>عنوان</label>

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
                        name="income_date"
                        class="form-control"
                        value="<?php echo $row['income_date']; ?>"
                        required>

                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-success">

                    ذخیره تغییرات

                </button>

                <a href="list.php"
                    class="btn btn-secondary">

                    بازگشت

                </a>

            </form>

        </div>

    </div>

</body>

</html>
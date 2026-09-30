<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

$id = (int)$_GET['id'];

$result = $conn->query("
    SELECT *
    FROM loans
    WHERE id = $id
");

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $person_name = $_POST['person_name'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $loan_date = $_POST['loan_date'];
    $note = $_POST['note'];

    $sql = "
        UPDATE loans
        SET
            person_name='$person_name',
            type='$type',
            amount='$amount',
            loan_date='$loan_date',
            note='$note'
        WHERE id=$id
    ";

    if ($conn->query($sql)) {
        header('Location: list.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ویرایش قرض</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h3 class="mb-4">ویرایش قرض</h3>

            <form method="POST">

                <div class="mb-3">
                    <label>نام شخص</label>
                    <input type="text"
                        name="person_name"
                        class="form-control"
                        value="<?php echo $row['person_name']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>نوع قرض</label>

                    <select name="type" class="form-control">

                        <option value="borrowed"
                            <?php if ($row['type'] == 'borrowed') echo 'selected'; ?>>
                            قرض گرفته شده
                        </option>

                        <option value="lent"
                            <?php if ($row['type'] == 'lent') echo 'selected'; ?>>
                            قرض داده شده
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>مقدار</label>
                    <input type="number"
                        name="amount"
                        class="form-control"
                        value="<?php echo $row['amount']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>تاریخ</label>
                    <input type="date"
                        name="loan_date"
                        class="form-control"
                        value="<?php echo $row['loan_date']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>یادداشت</label>
                    <textarea name="note"
                        class="form-control"
                        rows="3"><?php echo $row['note']; ?></textarea>
                </div>

                <button type="submit"
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
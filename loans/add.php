<?php include "../assets/components/navbar.php"; ?>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

if (isset($_POST['save'])) {

    $person = $_POST['person'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $note = $_POST['note'];
    $date = $_POST['date'];

    $sql = "INSERT INTO loans (person_name, type, amount, note, loan_date)
            VALUES ('$person', '$type', '$amount', '$note', '$date')";

    if ($conn->query($sql)) {
        $success = "قرض با موفقیت ثبت شد";
    } else {
        $error = "خطا در ثبت قرض";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>ثبت قرض</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card p-4 shadow">

                    <h4 class="mb-3">ثبت قرض جدید</h4>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php } ?>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>نام شخص</label>
                            <input type="text" name="person" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>نوع</label>
                            <select name="type" class="form-control" required>
                                <option value="borrowed">قرض گرفته شده</option>
                                <option value="lent">قرض داده شده</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>مقدار</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>یادداشت</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>تاریخ</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <button class="btn btn-warning w-100" name="save">
                            ثبت قرض
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
<?php include "../assets/components/navbar.php"; ?>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";
$search = '';

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if (!empty($search)) {

    $search = $conn->real_escape_string($search);

    $result = $conn->query("
        SELECT *
        FROM loans
        WHERE person_name LIKE '%$search%'
        ORDER BY person_name ASC
    ");
} else {

    $result = $conn->query("
        SELECT *
        FROM loans
        ORDER BY person_name ASC
    ");
}
// $result = $conn->query("
//     SELECT * FROM loans
//     WHERE archived = 0
//     ORDER BY person_name ASC
// ");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لیست قرض‌ها</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">

        <h3 class="mb-4">لیست قرض‌ها</h3>
        <form method="GET" class="mb-4">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="جستجوی نام شخص..."
                    value="<?php echo $search; ?>">

                <button class="btn btn-primary">
                    جستجو
                </button>

            </div>

        </form>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>نام شخص</th>
                    <th>نوع</th>
                    <th>مقدار</th>
                    <th>تاریخ</th>
                    <th>یاد داشت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>

                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['person_name']; ?></td>

                        <td>
                            <?php
                            echo $row['type'] == 'borrowed'
                                ? 'قرض گرفته شده'
                                : 'قرض داده شده';
                            ?>
                        </td>

                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['loan_date']; ?></td>
                        <td><?php echo $row['note']; ?></td>

                        <td>
                            <?php if ($row['status'] == 'paid') { ?>
                                <span class="badge bg-success">پرداخت شده</span>
                            <?php } else { ?>
                                <span class="badge bg-warning">پرداخت نشده</span>
                            <?php } ?>
                        </td>

                        <td>

                            <?php if ($row['status'] == 'unpaid') { ?>

                                <a href="edit.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-sm btn-warning">
                                    ✏ ویرایش
                                </a>

                                <a href="mark_paid.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-sm btn-success">
                                    پرداخت شد
                                </a>

                            <?php } else { ?>

                                <button class="btn btn-sm btn-secondary">
                                    کامل شده
                                </button>

                                <a href="delete.php?id=<?php echo $row['id']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('آیا از حذف این قرض مطمئن هستید؟');">
                                    حذف
                                </a>

                            <?php } ?>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</body>

</html>
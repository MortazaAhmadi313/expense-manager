<?php
include "../config/db.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$where = "WHERE archived = 0";

if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where .= " AND title LIKE '%$search%'";
}

$result = $conn->query("
    SELECT * FROM incomes
    $where
    ORDER BY id ASC
");

$total = $conn->query("
    SELECT SUM(amount) as total
    FROM incomes
    WHERE archived = 0
")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لیست درآمدها</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include "../assets/components/navbar.php"; ?>

    <div class="container mt-4">

        <h4>📋 لیست درآمدها</h4>

        <div class="alert alert-success">
            مجموع درآمد: <b><?php echo $total['total']; ?></b>
        </div>

        <div class="table-responsive" style="overflow-x:auto;">
            <form method="GET" class="mb-4">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="جستجو در درآمد..."
                        value="<?php echo $search; ?>">

                    <button class="btn btn-primary">
                        جستجو
                    </button>

                </div>

            </form>
            <table class="table table-bordered table-hover">

                <tr class="table-dark">
                    <th>#</th>
                    <th>عنوان</th>
                    <th>مقدار</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['income_date']; ?></td>
                        <td>

                            <a href="edit.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-warning btn-sm">
                                ✏ ویرایش
                            </a>

                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('آیا مطمئن هستید؟')">
                                🗑 حذف
                            </a>

                        </td>
                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
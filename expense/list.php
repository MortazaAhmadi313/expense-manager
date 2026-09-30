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
        SELECT * FROM expenses
        WHERE title LIKE '%$search%'
        ORDER BY id ASC
    ");
} else {

    $result = $conn->query("
        SELECT * FROM expenses
        ORDER BY id ASC
    ");
}

// $result = $conn->query("
//     SELECT * FROM expenses
//     WHERE archived = 0
//     ORDER BY id ASC
// ");
// 
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لیست مصارف</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">

        <h3 class="mb-4">لیست مصارف</h3>
        <form method="GET" class="mb-4">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="جستجو در مصارف..."
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
                    <th>عنوان</th>
                    <th>مقدار</th>
                    <th>تاریخ</th>
                    <th>حذف</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['expense_date']; ?></td>
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

            </tbody>

        </table>

    </div>

</body>

</html>
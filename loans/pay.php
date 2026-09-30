<?php include "../assets/components/navbar.php"; ?>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

if (isset($_POST['pay'])) {

    $id = $_POST['id'];
    $payAmount = $_POST['pay_amount'];

    // گرفتن اطلاعات قرض
    $loan = $conn->query("SELECT * FROM loans WHERE id=$id")->fetch_assoc();

    $newPaid = $loan['paid_amount'] + $payAmount;
    $total = $loan['amount'];

    // اگر بیشتر از قرض شد
    if ($newPaid >= $total) {
        $newPaid = $total;
        $status = 'paid';
    } else {
        $status = 'unpaid';
    }

    $today = date('Y-m-d');

    $sql = "UPDATE loans 
            SET paid_amount='$newPaid',
                status='$status',
                paid_date='$today'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: list.php");
        exit();
    } else {
        echo "خطا در پرداخت";
    }
}
?>
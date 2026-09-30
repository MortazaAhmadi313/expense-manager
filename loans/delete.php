<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    // فقط قرض‌های پرداخت شده حذف شوند
    $check = $conn->query(
        "SELECT * FROM loans 
         WHERE id = $id 
         AND status='paid'"
    );

    if ($check->num_rows > 0) {

        $conn->query(
            "DELETE FROM loans 
             WHERE id = $id"
        );
    }

    header("Location: list.php");
    exit();
}

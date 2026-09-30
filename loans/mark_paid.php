<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "UPDATE loans SET status='paid' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: list.php");
        exit();
    } else {
        echo "خطا در تغییر وضعیت";
    }
}

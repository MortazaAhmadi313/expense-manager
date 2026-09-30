<?php
$host = "localhost";
$dbname = "expense_db";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("خطا در اتصال دیتابیس" .
        $conn->connect_error);
}

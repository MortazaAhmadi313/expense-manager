<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit();
}

include "config/db.php";

$incomeQuery = $conn->query("SELECT SUM(amount) AS total_income FROM incomes");
$incomeData = $incomeQuery->fetch_assoc();

$totalIncome = isset($incomeData['total_income'])
    ? $incomeData['total_income']
    : 0;

$expenseQuery = $conn->query("SELECT SUM(amount) AS total_expense FROM expenses");
$expenseData = $expenseQuery->fetch_assoc();

$totalExpense = isset($expenseData['total_expense'])
    ? $expenseData['total_expense']
    : 0;

$balance = $totalIncome - $totalExpense;
?>
<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Topbar */

        .topbar {
            background: #ffffff;
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        /* Date Time */


        .datetime-box {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #0d6efd;
            padding-top: 8px;
        }

        /* Search */

        .search-box input {
            height: 45px;
            border-radius: 10px;
            border-radius: 12px;
            padding: 10px;
        }

        /* Welcome Card */

        .welcome-card {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
            overflow: hidden;
        }

        .welcome-card h2 {
            font-size: 30px;
            font-weight: 700;
        }

        .welcome-card p {
            font-size: 16px;
            opacity: .9;
        }

        .welcome-icon {
            font-size: 90px;
            opacity: .4;
        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <!-- <img src="./assets/img/profile.jpg" round> -->
                <h4 class="sidebar-title">
                    <i class="bi bi-wallet2"></i>
                    سیستم مدیریت مصارف
                </h4>

                <a href="dashboard.php">
                    <i class="bi bi-speedometer2"></i>
                    داشبورد
                </a>

                <a href="income/add.php">
                    <i class="bi bi-plus-circle"></i>
                    افزودن درآمد
                </a>

                <a href="income/list.php">
                    <i class="bi bi-cash-stack"></i>
                    لیست درآمدها
                </a>

                <a href="expense/add.php">
                    <i class="bi bi-cart-dash"></i>
                    افزودن مصرف
                </a>

                <a href="expense/list.php">
                    <i class="bi bi-list-ul"></i>
                    لیست مصارف
                </a>
                <a href="loans/add.php">
                    <i class="bi bi-person-plus"></i>
                    قرض جدید
                </a>

                <a href="loans/list.php">
                    <i class="bi bi-people"></i>
                    لیست قرض‌ها
                </a>

                <a href="auth/logout.php">
                    <i class="bi bi-box-arrow-right red"></i>
                    خروج
                </a>

            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content p-4">
                <!-- Top Navbar -->

                <div class="topbar mb-4">

                    <div class="row align-items-center">

                        <div class="col-md-6">

                            <div class="search-box">

                                <input type="text"
                                    class="form-control"
                                    placeholder="جستجو...">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="datetime-box">

                                <i class="bi bi-calendar3"></i>

                                <span id="currentDate"></span>

                                |

                                <i class="bi bi-clock"></i>

                                <span id="currentTime"></span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Welcome Card -->

                <div class="welcome-card mb-4">

                    <div class="row align-items-center">

                        <div class="col-md-9">

                            <h2 class="mb-2">
                                خوش آمدید،
                                <?php echo $_SESSION['user']; ?>
                            </h2>

                            <p class="mb-0">
                                مدیریت کامل درآمدها، مصارف و قرض‌ها
                            </p>

                        </div>

                        <div class="col-md-3 text-center">

                            <i class="bi bi-person-circle welcome-icon"></i>

                        </div>

                    </div>

                </div>

                <!-- <h2 class="mb-4">
                    خوش آمدید،
                    <?php echo $_SESSION['user']; ?>
                </h2> -->

                <div class="row">

                    <!-- Income -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card stat-card bg-success text-white shadow">
                            <div class="card-body text-center">
                                <i class="bi bi-cash-stack fs-1"></i>

                                <h5 class="mt-3">
                                    مجموع درآمد
                                </h5>

                                <h3>
                                    <?php echo number_format($totalIncome); ?>
                                </h3>

                                <small>افغانی</small>
                            </div>
                        </div>
                    </div>

                    <!-- Expense -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card stat-card bg-danger text-white shadow">
                            <div class="card-body text-center">
                                <i class="bi bi-cart-x fs-1"></i>

                                <h5 class="mt-3">
                                    مجموع مصارف
                                </h5>

                                <h3>
                                    <?php echo number_format($totalExpense); ?>
                                </h3>

                                <small>افغانی</small>
                            </div>
                        </div>
                    </div>

                    <!-- Balance -->
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card stat-card bg-primary text-white shadow">
                            <div class="card-body text-center">
                                <i class="bi bi-wallet-fill fs-1"></i>

                                <h5 class="mt-3">
                                    موجودی فعلی
                                </h5>

                                <h3>
                                    <?php echo number_format($balance); ?>
                                </h3>

                                <small>افغانی</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function updateClock() {

            let now = new Date();

            document.getElementById("currentDate").innerHTML =
                now.toLocaleDateString('fa-IR');

            document.getElementById("currentTime").innerHTML =
                now.toLocaleTimeString('fa-IR');
        }

        setInterval(updateClock, 1000);

        updateClock();
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quickbite";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sales_query = "SELECT SUM(amount) AS total_sales FROM sales";
$expenses_query = "SELECT SUM(amount) AS total_expenses FROM expenses";
$income_query = "SELECT SUM(amount) AS total_income FROM income";

$sales_result = $conn->query($sales_query);
$expenses_result = $conn->query($expenses_query);
$income_result = $conn->query($income_query);

$sales_data = $sales_result->fetch_assoc();
$expenses_data = $expenses_result->fetch_assoc();
$income_data = $income_result->fetch_assoc();

$target_sales = 1000000;
$target_expenses = 500000;
$target_income = 1500000;

$sales_percentage = ($sales_data['total_sales'] / $target_sales) * 100;
$expenses_percentage = ($expenses_data['total_expenses'] / $target_expenses) * 100;
$income_percentage = ($income_data['total_income'] / $target_income) * 100;

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="dashboard_body.css">
     <title>Document</title>
</head>
<body>
    <?php
    include './dashboard_header.php';
    include './dashboard_sidebar.php';

     ?>
    <main>
        <div class="insights">
            <div class="sales">
                <span class="material-symbols-outlined">analytics</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Sales</h3>
                        <h3>Rs.<?= number_format($sales_data['total_sales'], 2) ?></h3>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($sales_percentage, 2) ?>%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Last Month</small>
                <a href="http://localhost/QuickBite/dashboard/data_sales.php" class="add-btn">Add Sales</a>
            </div>

            <div class="expenses">
                <span class="material-symbols-outlined">bar_chart</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Expenses</h3>
                        <h3>Rs.<?= number_format($expenses_data['total_expenses'], 2) ?></h3>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($expenses_percentage, 2) ?>%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Last Month</small>
                <a href="http://localhost/QuickBite/dashboard/data_sales.php" class="add-btn">Add Expenses</a>
            </div>

            <div class="income">
                <span class="material-symbols-outlined">credit_score</span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Income</h3>
                        <h3>Rs.<?= number_format($income_data['total_income'], 2) ?></h3>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($income_percentage, 2) ?>%</p>
                        </div>
                    </div>
                </div>
                <small class="text-muted">Last Month</small>
                <a href="http://localhost/QuickBite/dashboard/data_sales.php" class="add-btn">Add Income</a>
            </div>
        </div>
    </main>
</body>

</html>
<?php
 $servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quick_main";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $current_month_start = date('Y-m-01'); 
$current_month_end = date('Y-m-t'); 

// Modified queries to filter by current month
$sales_query = "SELECT SUM(amount) AS total_sales FROM sales 
                WHERE date BETWEEN '$current_month_start' AND '$current_month_end'";
$expenses_query = "SELECT SUM(amount) AS total_expenses FROM expenses 
                   WHERE date BETWEEN '$current_month_start' AND '$current_month_end'";
$income_query = "SELECT SUM(amount) AS total_income FROM income 
                 WHERE date BETWEEN '$current_month_start' AND '$current_month_end'";

 $sales_result = $conn->query($sales_query);
$expenses_result = $conn->query($expenses_query);
$income_result = $conn->query($income_query);

// Fetch data
$sales_data = $sales_result->fetch_assoc();
$expenses_data = $expenses_result->fetch_assoc();
$income_data = $income_result->fetch_assoc();

// Handle null values (when no records exist for the month)
$total_sales = $sales_data['total_sales'] ?: 0;
$total_expenses = $expenses_data['total_expenses'] ?: 0;
$total_income = $income_data['total_income'] ?: 0;

// Monthly targets
$target_sales = 1000000;
$target_expenses = 500000;
$target_income = 1500000;

$sales_percentage = $target_sales > 0 ? min(($total_sales / $target_sales) * 100, 100) : 0;
$expenses_percentage = $target_expenses > 0 ? min(($total_expenses / $target_expenses) * 100, 100) : 0;
$income_percentage = $target_income > 0 ? min(($total_income / $target_income) * 100, 100) : 0;

 $conn->close();

 $current_month_name = date('F Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="dashboard-body-part.css">
       <title>QuickBite Financial Dashboard</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #eef2f7;
    margin: 0;
    padding: 0;
}

main {
    padding: 2rem;
    margin-left: 30px;
    max-width: 100%;
    transition: margin-left 0.3s;
}

.active-sidebar~main {
    margin-left: 200px;
}

.insights > div {
    background: white;
    padding: 3rem; 
    border-radius: 1.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 300ms ease;
    width: 100%;
    max-width: 700px;  
    text-align: center;
}

.insights {
    height: 400px;
    width: 1150px;
    display: flex;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));  
    gap: 2.5rem; 
    margin-top: 2rem;
    justify-content: center;
}
.insights > div:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}

.icon {
    display: flex;
    justify-content: center;
    align-items: center;
     height: 70px;
    width: 70px;
    background-color: black;
     border-radius: 50%;
}
 

.material-symbols-outlined:hover {
    background: rgba(40, 199, 111, 0.2);
    transform: scale(1.1);
}

.progress {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 1rem auto;
    border-radius: 50%;
    background: radial-gradient(closest-side, white 79%, transparent 80% 100%), 
                conic-gradient(var(--progress-color) var(--progress-value), #dfe6ee 0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1rem;
    transition: background 0.3s ease-in-out;
}

.number {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

 .progress {
    --progress-color: 
         hsl(calc(120 * var(--progress-value) / 100), 80%, 50%);
}

.sales .progress {
    --progress-value: <?= $sales_percentage ?>%;
    --progress-color:rgb(32, 135, 84);
    height: 90px;
    width: 90px;
}

.expenses .progress {
    --progress-value: <?= $expenses_percentage ?>%;
    --progress-color:rgb(20, 128, 160);
    height: 90px;
    width: 90px;
}

.income .progress {
    --progress-value: <?= $income_percentage ?>%;
    --progress-color:rgb(94, 33, 169);
    height: 90px;
    width: 90px;
}

 

.middle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 1.5rem 0;
}

.left h3:first-child {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    color: #555;
}

.left h3:last-child {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
}

.add-btn {
    display: inline-block;
    background:rgb(7, 7, 9);
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 0.5rem;
    text-decoration: none;
    margin-top: 1rem;
    font-weight: bold;
    transition: all 300ms ease;
}

.add-btn:hover {
    background:rgb(26, 68, 126);
}

.material-symbols-outlined {
    background: rgba(249, 250, 252, 0.1); 
     border-radius: 50%; 
    color:rgb(238, 240, 241);  
   }

.expenses .material-symbols-outlined {
    color:rgb(229, 218, 218);
    background: rgba(234, 84, 85, 0.1);
    
}

.income .material-symbols-outlined {
    color:rgb(226, 234, 229);
    background: rgba(40, 199, 111, 0.1);
     
}



</style>
<body>
    
<?php include 'dashboard_header.php'; ?>
<?php include 'dashboard_sidebar.php'; ?>
    <main>
        <h1> Dashboard - <?= $current_month_name ?></h1>
        
        <div class="insights">
            <div class="sales">
                <div class="icon"> 
                <span class="material-symbols-outlined">analytics</span>
                </div>
                <div class="middle">
                    <div class="left">
                        <h3>Total Sales</h3>
                        <h4>Rs.<?= number_format($total_sales, 2) ?></h4>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($sales_percentage, 1) ?>%</p>
                        </div>
                    </div>
                </div>
                  <a href="http://localhost/QuickBite/dashboard/admin_add.php" class="add-btn">Add Sales</a>
             </div>

            <div class="expenses">
            <div class="icon"> 
                <span class="material-symbols-outlined">bar_chart</span>
            </div>
                <div class="middle">
                    <div class="left">
                        <h3>Total Expenses</h3>
                        <h4>Rs.<?= number_format($total_expenses, 2) ?></h4>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($expenses_percentage, 1) ?>%</p>
                        </div>
                    </div>
                </div>
                  <a href="http://localhost/QuickBite/dashboard/admin_add.php" class="add-btn">Add Expenses</a>
             </div>

            <div class="income">
            <div class="icon"> 
                <span class="material-symbols-outlined">credit_score</span>
            </div>
                <div class="middle">
                    <div class="left">
                        <h3>Total Income</h3>
                        <h4>Rs.<?= number_format($total_income, 2) ?></h4>
                    </div>
                    <div class="progress">
                        <div class="number">
                            <p><?= number_format($income_percentage, 1) ?>%</p>
                        </div>
                    </div>
                </div>
                  <a href="http://localhost/QuickBite/dashboard/admin_add.php" class="add-btn">Add Income</a>
             </div>
        </div>
    </main>
</body>
</html>
 
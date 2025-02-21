<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quick_main";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    if ($category == "sales") {
        $insert_query = "INSERT INTO sales (amount, date) VALUES ('$amount', '$date')";
    } elseif ($category == "expenses") {
        $insert_query = "INSERT INTO expenses (amount, date) VALUES ('$amount', '$date')";
    } elseif ($category == "income") {
        $insert_query = "INSERT INTO income (amount, date) VALUES ('$amount', '$date')";
    }
    
    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Record added successfully'); window.location.href='';</script>";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$sales_query = "SELECT * FROM sales ORDER BY date DESC";
$sales_result = $conn->query($sales_query);
$total_sales_count = $sales_result->num_rows;
$total_sales_amount = 0;
while ($row = $sales_result->fetch_assoc()) {
    $total_sales_amount += $row['amount'];
}

$expenses_query = "SELECT * FROM expenses ORDER BY date DESC";
$expenses_result = $conn->query($expenses_query);
$total_expenses_amount = 0;
while ($row = $expenses_result->fetch_assoc()) {
    $total_expenses_amount += $row['amount'];
}

$income_query = "SELECT * FROM income ORDER BY date DESC";
$income_result = $conn->query($income_query);
$total_income_amount = 0;
while ($row = $income_result->fetch_assoc()) {
    $total_income_amount += $row['amount'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Management</title>
    <link rel="stylesheet" href="admin_add.css">
</head>
<body>
<?php include 'dashboard_header.php'; ?>
    <div class="container">
        <h3>Financial Management</h3>
        
        <h3>Add New Record</h3>
        <form method="POST">
            <div class="form-group">
                <label>Amount:</label>
                <input type="number" name="amount" required>
            </div>
            <div class="form-group">
                <label>Category:</label>
                <select name="category" required>
                    <option value="sales">Sales</option>
                    <option value="expenses">Expenses</option>
                    <option value="income">Income</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" required>
            </div>
            <div id="submit-btn"> 
            <button type="submit">Submit</button>
            </div>
        </form>
        
        <h3>Summary</h3>
        <p>Total Sales: Rs. <?php echo number_format($total_sales_amount, 2); ?></p>
        <p>Total Expenses: Rs. <?php echo number_format($total_expenses_amount, 2); ?></p>
        <p>Total Income: Rs. <?php echo number_format($total_income_amount, 2); ?></p>

         
    </div>
</body>
</html>

  
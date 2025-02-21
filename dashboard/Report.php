<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quick_main";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id']) && isset($_POST['table'])) {
    $id = intval($_POST['delete_id']);
    $table = $conn->real_escape_string($_POST['table']);
    
    if (in_array($table, ['sales', 'expenses', 'income'])) {
        $delete_query = "DELETE FROM $table WHERE id = $id";
        if ($conn->query($delete_query) === TRUE) {
            echo "<script>alert('Record deleted successfully'); window.location.href='';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

$sales_query = "SELECT * FROM sales ORDER BY date DESC";
$sales_result = $conn->query($sales_query);
$total_sales_count = $sales_result->num_rows;

$expenses_query = "SELECT * FROM expenses ORDER BY date DESC";
$expenses_result = $conn->query($expenses_query);

$income_query = "SELECT * FROM income ORDER BY date DESC";
$income_result = $conn->query($income_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Information Details</title>
    <link rel="stylesheet" href="Report.css">
</head>
<body>
<?php include 'dashboard_header.php'; ?>

<h2>All Information Details</h2>
<a href="http://localhost/QuickBite/dashboard/admin_add.php" class="add-btn">Add Sales</a>

 

<section>
    <h2>Sales Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $sales_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>Rs. <?php echo number_format($row['amount'], 2); ?></td>
                <td>
                    <?php
                     setlocale(LC_TIME, 'ne_NP.UTF-8');
                    echo strftime('%d %B %Y', strtotime($row['date']));
                    ?>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="table" value="sales">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>

<section>
    <h2>Expenses Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $expenses_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>Rs. <?php echo number_format($row['amount'], 2); ?></td>
                <td>
                    <?php
                     setlocale(LC_TIME, 'ne_NP.UTF-8');
                    echo strftime('%d %B %Y', strtotime($row['date']));
                    ?>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="table" value="expenses">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>

<section>
    <h2>Income Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $income_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>Rs. <?php echo number_format($row['amount'], 2); ?></td>
                <td>
                    <?php
                     setlocale(LC_TIME, 'ne_NP.UTF-8');
                    echo strftime('%d %B %Y', strtotime($row['date']));
                    ?>
                </td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="table" value="income">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>

</body>

</html>

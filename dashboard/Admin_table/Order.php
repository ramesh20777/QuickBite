<?php
 
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quickbite";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order_id'])) {
    $order_id = intval($_POST['delete_order_id']);

    $stmt = $conn->prepare("DELETE FROM `order_details` WHERE id = ?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order Deleted Successfully!'); window.location.href='Order.php';</script>";
    } else {
        echo "<script>alert('Error deleting order!');</script>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
    :root {
        --primary-color: #426a96;
        --secondary-color:rgb(232, 238, 235);
        --text-color: #333;
        --background-color: #f4f4f9;
        --header-color: #2c3e50;
        --danger-color: #d32f2f;
    }

    .order-section {
        margin-top: 20px;
        background: var(--secondary-color);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 1200px;
        width: 100%;
    }

    .order-section h2 {
        text-align: center;
        color: var(--primary-color);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
    }

    thead {
        background-color: var(--primary-color);
        color: white;
    }

    thead th,
    tbody td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tbody tr:hover {
        background-color: #f0f0f0;
    }

    .delete-order-btn {
        padding: 8px 15px;
        background-color: var(--danger-color);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-order-btn:hover {
        background-color: #b71c1c;
    }
    </style>
</head>

<body>

    <?php include '../dashboard_header.php'; ?>
    <?php include '../dashboard_sidebar.php'; ?>

    <div class="order-section" id="recentOrders">
        <h2>Order List</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `order_details`";
                $result = $conn->query($sql);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                        echo "<td>Rs. " . htmlspecialchars($row['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        echo "<td>Rs. " . htmlspecialchars($row['total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                        echo "<td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='delete_order_id' value='" . $row['id'] . "'>
                                    <button type='submit' class='delete-order-btn'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
 ?>
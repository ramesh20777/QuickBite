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
    <link rel="stylesheet" href="view_order.css">
    <title>Orders</title>
</head>

<body>
    <?php
    include 'sel_header.php';
    ?>
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
    <?php
    include 'Footer.php';
    ?>

</body>

</html>

<?php
 ?>
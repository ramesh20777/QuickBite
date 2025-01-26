<?php
 session_start();

 include '../connection.php';  

 $query = "SELECT * FROM `order_details` WHERE 1";
$result = $conn->query($query);

 if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
    font-size: 2em;
    color: #333;
}

table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th {
    background-color: rgb(6, 8, 6);
    color: white;
    padding: 10px;
    text-align: left;
}

td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background-color: #f1f1f1;
}

a {
    color: #fff;
    background-color: rgb(10, 12, 10);
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
}

a:hover {
    background-color: #45a049;
}

@media (max-width: 768px) {
    table {
        width: 100%;
        margin: 10px;
    }

    th,
    td {
        font-size: 14px;
        padding: 8px;
    }

    h1 {
        font-size: 1.5em;
    }
}
</style>

<body>
    <?php
    include 'selhead.php';
    ?>

    <?php if (isset($_SESSION['message'])): ?>
    <div style="text-align: center; padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 10px;">
        <?= htmlspecialchars($_SESSION['message']); ?>
    </div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <h1>Pending Orders</h1>
    <table border="1">
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
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= htmlspecialchars($row['customer_id']) ?></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td><?= htmlspecialchars($row['total']) ?></td>
                <td><?= htmlspecialchars($row['phone_number']) ?></td>
                <td>
                    <form method="POST" action="process.php">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="status" value="Pending">
                        <button type="submit" name="update_status">Process Order</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
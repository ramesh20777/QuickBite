<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quickbite";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $sql = "SELECT * FROM payments ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <link rel="stylesheet" href="message.css">
</head>
<body>
    <?php
    include './dashboard_header.php';
    ?>
    <h1>Payment Messages</h1>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green; font-weight: bold;">Payment successfully recorded!</p>
    <?php endif; ?>

    <div class="message-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="message-box">
                    <h3>Customer Name: <?php echo htmlspecialchars($row['customer_name']); ?></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p class="amount">Amount: NRP <?php echo htmlspecialchars($row['amount']); ?></p>
                    <span class="timestamp"><?php echo htmlspecialchars($row['timestamp']); ?></span>
                </div>
        <?php
            }
        } else {
            echo '<p class="no-message">No payment messages available.</p>';
        }
        ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>

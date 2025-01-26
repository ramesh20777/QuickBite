<?php
include 'connection.php';  

 $sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}
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
    <?php include 'admin_header.php'; ?>
    <div class="message-container">
        <h1>Messages</h1>
        <div class="message-box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="message">';
                    echo '<h3>Order ID: ' . htmlspecialchars($row['order_id']) . '</h3>';
                    echo '<p><strong>Customer:</strong> ' . htmlspecialchars($row['customer_name']) . '</p>';
                    echo '<p><strong>Message:</strong> ' . htmlspecialchars($row['message']) . '</p>';
                    echo '<span class="timestamp">' . htmlspecialchars($row['timestamp']) . '</span>';
                    echo '</div>';
                }
            } else {
                echo '<p>No messages to display.</p>';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
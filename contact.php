<?php
include 'connection.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $order_id = $conn->real_escape_string($_POST['order_id']);
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $message = $conn->real_escape_string($_POST['message']);

     $sql = "INSERT INTO messages (order_id, customer_name, message) VALUES ('$order_id', '$customer_name', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Error: Successfull your message!" . $conn->error;

         exit();
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Form</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <?php include 'menu_header.php'; ?>
    <div class="form-container">
        <h1>Send a Message</h1>
        <form action="contact.php" method="POST">
            <div class="form-group">
                <label for="order_id">Order ID:</label>
                <input type="text" id="order_id" name="order_id" placeholder="Enter Order ID" required>
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" placeholder="Enter Customer Name" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Send Message</button>
            </div>
        </form>
    </div>
</body>
</html>

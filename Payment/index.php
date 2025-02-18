<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "quickbite";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['amount'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $amount = htmlspecialchars($_POST['amount']);
    
     $transaction_id = uniqid("txn_"); 
    $order_id = uniqid("ord_"); 

     $stmt = $conn->prepare("INSERT INTO payments (order_id, transaction_id, customer_name, email, amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $order_id, $transaction_id, $name, $email, $amount);

    if ($stmt->execute()) {
         header("Location: payment_success.php?name=$name&email=$email&amount=$amount&success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment.css">
    <title>eSewa Payment Integration</title>
</head>
<body>
    <div class="container">
        <h1>Food Delivery Payment</h1>

        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="amount">Amount (NRP):</label>
            <input type="number" id="amount" name="amount" required>

            <button type="submit">Pay with eSewa</button>
        </form>
    </div>
</body>
</html>

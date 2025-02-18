<?php
if (isset($_GET['name'], $_GET['email'], $_GET['amount'])) {
    $name = htmlspecialchars($_GET['name']);
    $email = htmlspecialchars($_GET['email']);
    $amount = htmlspecialchars($_GET['amount']);
} else {
    header("Location: payment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payment_success.css">
    <title>Payment Successful</title>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Amount Paid (NRP):</strong> <?php echo $amount; ?></p>
        <p style="color: green; font-weight: bold;">Your payment has been successfully recorded.</p>
        <a href="index.php" class="btn">Go Back to Homepage</a>
    </div>
</body>
</html>

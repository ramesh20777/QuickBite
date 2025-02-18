<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['email'], $_POST['amount'])) {
     $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];

 
     header("Location: payment_success.php?name=" . urlencode($name) . "&email=" . urlencode($email) . "&amount=" . urlencode($amount));
    exit();
}
?>

<?php
session_start();  
 $servername = "localhost";  
$username = "root"; 
$password = ""; 
$dbname = "quickbite"; 

 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['password']) && !isset($_POST['amount'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

     $stmt = $conn->prepare("SELECT * FROM accounts WHERE user_id = ? AND password = ?");
    $stmt->bind_param("ss", $user_id, $password);   
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
         $_SESSION['user_id'] = $user_id; 
        $login_success = true;
    } else {
         $login_error = "Invalid user ID or password";
    }
}

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['amount']) && isset($_SESSION['user_id'])) {
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];  

     $payment_success = "Payment Successful!";
    $total_amount = "NPR. " . htmlspecialchars($amount);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment Page</title>
    <link rel="stylesheet" href="Payment.css">
</head>
<body>
    <div class="container">
         <div class="payment-section">
            <div class="logo">
                <h2>EPAYTEST</h2>
                <img src="img/esewa-logo-png_seeklogo-469833.png" alt="eSewa Logo">
            </div>
            <div class="amount-details">
                <p>Total Amount</p>
                <h3>
                    <?php
                     if (isset($total_amount)) {
                        echo $total_amount;
                    } else {
                        echo "NPR. 100.00";
                    }
                    ?>
                </h3>
            </div>
            <div class="advertisement">
                <img src="img/london-3794348_640.jpg" alt="Advertisement">
            </div>
        </div>

         <div class="login-section" id="login-section" style="display: <?php echo isset($login_success) ? 'none' : 'block'; ?>;">
            <h2>Login to your account</h2>
            <form id="login-form" method="POST">
                <div class="input-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" placeholder="Enter your user ID" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="login">
                    <button>Login</button>
                 </div>
                <button type="submit">Payment</button>
                 
            </form>
            <div class="links">
                <a href="#">Forgot Password?</a>
            </div>
            <button class="cancel-btn">PAYMENT</button>
        </div>

        <!-- Verification Section -->
        <div class="verify-section" id="verify-section" style="display: <?php echo isset($login_success) ? 'block' : 'none'; ?>;">
            <p>Please type a total amount and save.</p>
            <form id="verify-form" method="POST">
                <div class="input-group">
                    <label for="amount">Total Amount</label>
                    <input type="text" id="amount" name="amount" placeholder="Enter your Amount" required>
                </div>
                <button type="submit">Save</button>
            </form>
            <div class="links">
                <button class="done-btn" onclick="location.href='Payment.php'">Back to Home</button>
            </div>
         </div>

        <!-- Payment Success Message -->
        <?php
        if (isset($payment_success)) {
            echo "<div class='success-message'>$payment_success</div>";
        }
        ?>
    </div>

    <script>
         const loginForm = document.getElementById('login-form');
        const loginSection = document.getElementById('login-section');
        const verifySection = document.getElementById('verify-section');

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();  
            loginSection.style.display = 'none'; 
            verifySection.style.display = 'block'; 
        });
    </script>
</body>
</html>

<?php
$conn->close();  
?>

<?php
// Database connection
$host = 'localhost'; // Replace with your host
$user = 'root';      // Replace with your database username
$pass = '';          // Replace with your database password
$dbname = 'quickbite'; // Replace with your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validation
    if (empty($username) || empty($password)) {
        echo "Both fields are required.";
    } else {
        // Fetch user from database
        $query = "SELECT * FROM `seller_accounts` WHERE `username` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Validate password (assuming plain text password for now)
            if ($password === $user['password']) {
                // Set session variables
                $_SESSION['seller_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to seller dashboard
                header("Location: Seller.php");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <link rel="stylesheet" href="seller_login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Seller Login</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p class="signup-link">Don't have an account? <a href="signin.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>

</html>
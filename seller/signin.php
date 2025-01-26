<?php
 $host = 'localhost';  
$user = 'root';       
$pass = '';          
$dbname = 'quickbite'; 

$conn = new mysqli($host, $user, $pass, $dbname);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

     if (empty($fullname) || empty($email) || empty($phone) || empty($username) || empty($password)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo "Phone number must be 10 digits.";
    } else {
         $check_query = "SELECT * FROM `seller_accounts` WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username or email already exists.";
        } else {
             $insert_query = "INSERT INTO `seller_accounts` (fullname, email, phone, username, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('sssss', $fullname, $email, $phone, $username, $password);

            if ($stmt->execute()) {
                 header("Location: seller_login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
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
    <title>Seller Sign Up</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Seller Sign Up</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Choose a username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>
                <button type="submit" class="signup-btn">Sign Up</button>
                <p class="login-link">Already have an account? <a href="login.html">Log In</a></p>
            </form>
        </div>
    </div>
</body>
</html>

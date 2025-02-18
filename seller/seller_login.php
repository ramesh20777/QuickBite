<?php
 session_start();
 $servername = "localhost";
$db_username = "root";   
$db_password = "";       
$db_name = "quickbite";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

 }  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM sellers WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["seller"] = $row["name"];
            header("Location: seller_index.php");
        } else {
            echo "<script>alert('Invalid Password!');</script>";
        }
    } else {
        echo "<script>alert('No account found with this email!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <link rel="stylesheet" href="signup_login.css">
</head>
<body>
    <div class="form-container">
        <h2>Seller Login</h2>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter Email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="seller_signup.php">Sign Up</a></p>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];  

     $conn = new mysqli('localhost', 'root', '', 'quickbite');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     $checkStmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Error: Email already exists. Please use a different email.');</script>";
    } else {
         $hashed_password = password_hash($password, PASSWORD_DEFAULT);

         $stmt = $conn->prepare("INSERT INTO `users`(`username`, `email`, `password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Redirecting to login page.');</script>";
            header("Refresh: 2; URL=login.php");
            exit();
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>

<body>
    <div class="form-container">
        <h2>Register</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Register</button>
            <div class="link">
                <a href="login.php">Already have an account? Login</a>
            </div>
        </form>
    </div>
</body>

</html>
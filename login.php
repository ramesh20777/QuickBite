<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

     $conn = new mysqli('localhost', 'root', '', 'quickbite');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

         if (password_verify($password, $hashed_password)) {
             $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;

             echo "<script>
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email. Please register.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Login</title>
</head>

<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
            <div class="link">
                <a href="register.php">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</body>

</html>
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
<style>
     body {
    font-family: Arial, sans-serif;
     margin: 0;
    padding: 0;
    background-image: linear-gradient(to bottom, rgba(19, 19, 14, 0.62), rgba(25, 124, 177, 0.8));

}
.form-container {
    width: 100%;
    max-width: 350px;
    margin: 30px auto;
    padding: 40px;
    background: #f7f7f8;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(246, 244, 244, 0.1);
}
h2 {
    font-size: 30px;
    text-align: center;
    color: #0e0c0c;
}
.form-group {
    margin-bottom: 20px;
}
label {
    display: block;
    margin-bottom: 5px;
    color: #0f0d0d;
}
input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    font-size: 12px;
    padding: 10px;
    border: 1px solid #390953;
    border-radius: 30px;
}
button {
    font-size: 16px;
    width: 100%;
    padding: 10px;
    background: #121312;
    color: rgb(240, 241, 241);
    border: none;
    border-radius: 30px;
    cursor: pointer;
}
button:hover {
    background: #5f1386;
} 

.link {
    text-align: center;
    margin-top: 15px;
}

.link a {
    text-decoration: none;
    color: #0a1017;
    font-weight: bold;
    font-size: 16px;
    transition: text-decoration 0.3s ease, color 0.3s ease;
}

.link a:hover {
    text-decoration: underline;
    color: #a01b67;
}
</style>

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
<?php
 $servername = "localhost";
 $db_username = "root";   
 $db_password = "";       
 $db_name = "quickbite";
 
  $conn = new mysqli($servername, $db_username, $db_password, $db_name);
 
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 
  }  
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO sellers (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: seller_login.php?signup=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Signup</title>
    <link rel="stylesheet" href="signup_login.css">
</head>
<body>
    <div class="form-container">
        <h2>Seller Signup</h2>
        <form action="" method="POST">
            <label for="name">User Name:</label>
            <input type="text" name="name" placeholder="Enter Name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter Email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account?</p>
        </form>
    </div>
</body>
</html>

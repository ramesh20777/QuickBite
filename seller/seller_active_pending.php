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
    $status = $_POST['status'];
    $count = $_POST['count'];

    $sql = "INSERT INTO deliveries (status, count) VALUES ('$status', $count)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Order added successfully!'); window.location='seller_index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

 $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="seller_active_pending.css">
    <title>Add Order</title>        
</head>
<body>
<?php
include 'sel_header.php';
 ?>
<div class="container">
    <h2>Add Order</h2>
    <form action="" method="POST">
        <label for="status">Order Status:</label>
        <select name="status">
            <option value="active">Active</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>

        <label for="count">Order Count:</label>
        <input type="number" name="count" min="1" required>

        <button type="submit" class="btn">Add Order</button>
    </form>
</div>

</body>
</html>

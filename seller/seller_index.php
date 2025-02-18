<?php
 $servername = "localhost";
 $db_username = "root";   
 $db_password = "";       
 $db_name = "quickbite";
 
  $conn = new mysqli($servername, $db_username, $db_password, $db_name);
 
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 
  }  
 $sql = "SELECT status, count FROM deliveries";
$result = $conn->query($sql);

$orders = ['active' => 0, 'pending' => 0, 'completed' => 0];

while ($row = $result->fetch_assoc()) {
    $orders[$row['status']] = $row['count'];
}

 $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_seller.css">
    <title>Delivery Dashboard - FoodHub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
         
    </style>
</head>
<body>
<?php
include 'sel_header.php';
?>
    <div class="hero-banner">
        <img src="image/istockphoto-1152170259-612x612.jpg" alt="Delivery Banner">
        <p>Manage your deliveries efficiently and track your orders in real-time!</p>
    </div>

    <div class="dashboard-container">
    <div class="dashboard-content">
        <div class="dashboard-card">
            <h2>Order Details</h2>
             <a href="view_order.php"><button class="btn">View Orders</button></a>
        </div>
        <div class="dashboard-card">
            <h2>Pending Orders</h2>
            <p>Orders waiting for delivery: <?= $orders['pending']; ?></p>
            <a href="seller_active_pending.php"><button class="btn">Add</button></a>
        </div>
        <div class="dashboard-card">
            <h2>Completed Deliveries</h2>
            <p>Successful deliveries today: <?= $orders['completed']; ?></p>
            <a href="seller_active_pending.php"><button class="btn">Add</button></a>
        </div>
    </div>
</div>
<?php
include  'Footer.php';
?>
</body>
</html>

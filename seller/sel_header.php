<?php
session_start();
if (!isset($_SESSION["seller"])) {
    header("Location: seller_login.php");
    exit();
}
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sel_header.css">
    <title>Document</title>
 </head>
 <body>
 <nav class="navbar">
    <div class="logo"><i class="fas fa-truck"></i> FoodHub Delivery</div>
    <div class="profile">
        <span><?php echo $_SESSION["seller"]; ?></span>
        <a href="seller_logout.php" class="logout-btn">Logout</a>
    </div>
</nav>
 </body>
 </html>
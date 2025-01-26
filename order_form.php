<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Form</title>
    <link rel="stylesheet" href="order_form.css">
</head>
<body>
    <?php
    include 'menu_header.php';
    ?>
     <div class="form-container">
        <h1>Food Order</h1>
        <form action="#" method="post">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            
            <label for="food-item">Select Food Item:</label>
            <input type="text" id="food-item" name="food-item" placeholder="Enter Food Name" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" placeholder="Enter quantity" required>
            
            <label for="address">Delivery Address:</label>
            <input type="address" name="address" id="address" placeholder="Enter Your Address" required>
             
            <button type="submit">Place Order</button>
        </form>
        
    </div>
    
</body>
</html>

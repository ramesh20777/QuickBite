

<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo Offers</title>
    <link rel="stylesheet" href="combo.css">
    <style>
         
      
         #order-form-section {
             display: none;
            background-color: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
        }
        #order-form-section h2 {
            margin-bottom: 30px;
        }
        #order-form-section input,
        #order-form-section select,
        #order-form-section button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            margin-bottom: 10px;
            border: 1px solid black;
            border-radius: 35px;
        }
        #order-form-section button {
            background-color:rgb(9, 11, 10);
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
        }
        #order-form-section button:hover {
            background-color:rgb(111, 50, 157);
        }
    </style>
</head>
<body>
    <header>
         <div class="header-container">
             <div class="logo">🍴 Quick Bite - Combo Offers</div>
              <nav>
                <ul>
                    <li><a href="Quick_home.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="combo-offers">
        <h2>Exclusive Combo Offers for You!</h2>
        <div class="offers-container">
            <div class="offer-item" id="offer1">
                <img src="img/istockphoto-burger.jpg" alt="Combo 1">
                <h3>Combo 1</h3>
                <p>Combo includes a burger, fries, and a soft drink.</p>
                <span class="price">₹199</span>
                <button class="order-button" onclick="showOrderForm(1)">Order Now</button>
            </div>

            <div class="offer-item" id="offer2">
                <img src="img/istockphoto-pizza.jpg" alt="Combo 2">
                <h3>Combo 2</h3>
                <p>Combo includes pizza, garlic bread, and a soft drink.</p>
                <span class="price">₹499</span>
                <button class="order-button" onclick="showOrderForm(2)">Order Now</button>
            </div>

            <div class="offer-item" id="offer3">
                <img src="img/istockphoto-dear.jpg" alt="Combo 3">
                <h3>Combo 3</h3>
                <p>Combo includes pasta, salad, and a cold drink.</p>
                <span class="price">₹350</span>
                <button class="order-button" onclick="showOrderForm(3)">Order Now</button>
            </div>
        </div>
    </section>

        <?php
include 'connection.php';  

function getPrice($combo) {
    $prices = [
        'combo1' => 199,
        'combo2' => 499,
        'combo3' => 350
    ];
    return $prices[$combo] ?? 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $combo = $_POST['combo'];
    $price = getPrice($combo);

    $stmt = $conn->prepare("INSERT INTO orders (name, address, phone, combo, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $address, $phone, $combo, $price);
    $stmt->execute();
     echo 'successfully your order!!';
    exit;

 }
?>

 
<div id="order-form-section">
        <h2>Place Your Order</h2>
        <form method="POST" action="">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Delivery Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="combo">Selected Combo:</label>
            <select id="combo" name="combo" required>
                <option value="" disabled selected>Select Combo</option>
                <option value="combo1">Combo 1 - ₹199</option>
                <option value="combo2">Combo 2 - ₹499</option>
                <option value="combo3">Combo 3 - ₹350</option>
            </select>

            <button type="submit">Place Order</button>
        </form>
    </div>

 
        </div>
 
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Online Food Ordering System</p>
        </div>
    </footer>

    <script>
        function showOrderForm(comboId) {
            document.getElementById('order-form-section').style.display = 'block';
            document.getElementById('combo').value = 'combo' + comboId;
        }
    </script>
</body>
</html>

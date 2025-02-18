<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="menu.css">
    <title>Food Ordering System</title>
</head>
 
<body>

    <?php 
include 'menu_header.php';
?>

<div class="menu-header">
    <h2>Food Categories</h2>
    <form method="POST">
        <div class="filter-options">
            <select name="category-filter">
                <option value="all">All Categories</option>
                <option value="pizza">Pizza</option>
                <option value="burgers">Burgers</option>
                <option value="chinese">Chinese</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="rice">Rice</option>
                <option value="chicken">Chicken</option>
                <option value="mutton">Mutton</option>
                <option value="buff">Buff</option>
                <option value="pork">Pork</option>
            </select>

            <select name="price-filter">
                <option value="all">Price Range</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <select name="rating-filter">
                <option value="all">Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
    </form>
</div>


    <div id="cart-notification" class="hidden">
        <div class="notification-content">
            <h3>Item Added to Cart</h3>
            <p>Your item has been successfully added to the cart.</p>
            <a href="cart/card.php"><button id="view-cart">View Cart</button></a>
            <button id="close-notification">Close</button>
        </div>
    </div>
    <div class="food-items">
        <div class="food-item">
            <img src="img/istockphoto-pizza.jpg" alt="Pizza">
            <h3>Deluxe Pizza</h3>
            <p class="price">Rs.450</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-chees.jpg" alt="Burger">
            <h3>Cheeseburger</h3>
            <p class="price">Rs.300</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-kung.jpg" alt="Chinese Food">
            <h3>Kung Pao Chicken</h3>
            <p class="price">Rs.400</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-veg.jpg" alt="Vegetarian Food">
            <h3>Vegetable Stir Fry</h3>
            <p class="price">Rs.250</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/fried-rice-967081_640.jpg" alt="Rice">
            <h3>Fried Rice</h3>
            <p class="price">Rs.200</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/ai-generated-8542471_640.jpg" alt="Chicken">
            <h3>Grilled Chicken</h3>
            <p class="price">Rs.350</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-2043767125-612x612.jpg" alt="Mutton">
            <h3>Mutton Curry</h3>
            <p class="price">Rs.500</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1193255251-612x612.jpg" alt="Buff">
            <h3>Buff Steak</h3>
            <p class="price">Rs.250</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1191425441-612x612.jpg" alt="Pork">
            <h3>Pork Ribs</h3>
            <p class="price">Rs.360</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1494080845-612x612.jpg" alt="Pork">
            <h3>Moshroom Chilly</h3>
            <p class="price">Rs.280</p>
            <button class="add-to-cart">Add to Cart<span class="material-symbols-outlined">
                    shopping_cart</span></button>
        </div>
    </div>
    </section>

     <?php
     include 'Footer.php';
     ?>
    <script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            showNotification();
        });
    });

    function showNotification() {
        const notification = document.getElementById('cart-notification');
        const overlay = document.createElement('div');
        overlay.className = 'overlay';
        document.body.appendChild(overlay);

        notification.classList.remove('hidden');

        document.getElementById('close-notification').addEventListener('click', () => {
            notification.classList.add('hidden');
            document.body.removeChild(overlay);
        });

        document.getElementById('view-cart').addEventListener('click', () => {
            alert("Navigating to cart page...");
            notification.classList.add('hidden');
            document.body.removeChild(overlay);
        });
    }

    const viewCartButton = document.getElementById('view-cart');
    const orderSection = document.getElementById('order-section');
    const paymentSection = document.getElementById('payment-section');
    document.getElementById('placeOrderButton').style.display = 'inline-block';


    viewCartButton.addEventListener('click', () => {
        orderSection.style.display = 'block';
        paymentSection.style.display = 'none';
    });

    placeOrderButton.addEventListener('click', () => {
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        if (name && phone) {
            paymentSection.style.display = 'block';
            orderSection.style.display = 'none';

            document.getElementById('payment-name').value = name;
            document.getElementById('payment-phone').value = phone;
        } else {
            alert('Please fill in all fields.');
        }
    });

    function placeOrder() {
        document.getElementById('order-section').style.display = 'none';

        document.getElementById('successMessage').style.display = 'block';
    }
    </script>


</body>

</html>
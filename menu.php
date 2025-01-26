<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <title>Food Ordering System</title>
</head>
<style>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F5F5F5;
    color: #333333;
}

.hidden {
    display: none;
}

#cart-notification {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    width: 300px;
    padding: 20px;
    text-align: center;
}

.notification-content h3 {
    font-size: 1.5rem;
    color: #FF6F61;
    margin-bottom: 10px;
}

.notification-content p {
    font-size: 1rem;
    color: #333;
    margin-bottom: 20px;
}

.notification-content button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 5px;
}

#view-cart {
    background-color: #FF6F61;
    color: white;
}

#close-notification {
    background-color: #ddd;
    color: black;
}

#view-cart:hover {
    background-color: #FF9478;
}

#close-notification:hover {
    background-color: #ccc;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}


header {
    text-align: center;
    background-color: #FF6F61;
    color: white;
    padding: 20px 0;
}

header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

header p {
    font-size: 1.2rem;
}

#order-section, #payment-section {
            display: none;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #2d8f31;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color:rgb(14, 14, 14);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color:rgb(67, 39, 162);
        }


.container {
    text-align: center;
}

.message-box {
    background-color:rgb(85, 106, 121);
    color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    margin-bottom: 20px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #fff;
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #45a049;
    color: white;
}

        #view-cart {
            width: 150px;
            margin: 20px auto;
            display: block;
            padding: 10px;
            text-align: center;
            background-color:rgb(13, 14, 16);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        #view-cart:hover {
            background-color: #0056b3;
        }

      .order-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    max-width: 400px;
    width: 100%;
}
 
.order-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    max-width: 400px;
    width: 100%;
}

.food-item {
    margin-bottom: 20px;
}

.food-image {
    width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 8px;
}

h1 {
    color: #333;
}

.price {
    font-size: 1.5em;
    color: #007bff;
    font-weight: bold;
}

.order-button {
    background-color:rgb(9, 13, 10);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
    margin: 5px;
}

.order-button:hover {
    background-color:rgb(83, 33, 136);
}

.confirmation-message {
    margin-top: 20px;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    font-size: 1.2em;
}

.confirmation-message {
    margin-top: 20px;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    font-size: 1.2em;
}

.menu-section {
    padding: 20px;
}

.menu-header {
    text-align: center;
    margin-bottom: 20px;
}

.menu-header h2 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #FF6F61;
}

.filter-options select {
    padding: 10px;
    margin: 5px;
    border: 1px solidrgb(253, 255, 249);
    border-radius: 5px;
    background-color:rgb(65, 76, 81);
    color:rgb(246, 243, 243);
    font-weight: bold;
}

.food-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.food-item {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.food-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.food-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
}

.food-item h3 {
    margin: 10px 0;
    font-size: 1.5rem;
    color: #FF6F61;
}

.food-item .price {
    font-size: 1.2rem;
    margin: 10px 0;
    color:rgb(73, 78, 63);
    font-weight: bold;
}

.add-to-cart {
    padding: 10px 20px;
    background:rgb(4, 18, 23);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
}

.add-to-cart:hover {
    background-color: #FF9478;
}


  
.footer {
  background: linear-gradient(45deg,rgb(132, 57, 147),rgb(80, 36, 107));
  color: #ecf0f1; 
    padding: 50px 20px;
    font-family: 'Arial', sans-serif;
  }
  
  .footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }
  
  
  .footer-section {
    flex: 1;
    min-width: 250px;
    padding: 20px;
    box-sizing: border-box;
    margin: 10px;
  }
  
  .footer-section h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #f39c12;  
    position: relative;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  .footer-section h3::after {
    content: '';
    display: block;
    height: 3px;
    width: 60%;
     margin-top: 5px;
    transition: width 0.4s ease;
  }
  
  .footer-section h3:hover::after {
    width: 100%;
  }
  
  
  .footer-section ul {
    list-style: none;
    padding: 0;
  }
  
  .footer-section ul li {
    margin: 10px 0;
  }
  
  .footer-section ul li a {
    text-decoration: none;
    color: #bdc3c7;  
    font-size: 1rem;
    transition: color 0.3s ease, padding-left 0.3s ease;
  }
  
  .footer-section ul li a:hover {
    color: #f39c12;  
    padding-left: 10px;  
  }
  
  .footer-section p {
    font-size: 1rem;
    color: #bdc3c7;  
    margin-top: 5px;
  }
  
  .footer-section p a {
    color: #ecf0f1; 
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
  }

 


</style>
<body>

<?php 
include 'menu_header.php';
?>
 
<section class="menu-section">
    <div class="menu-header">
        <h2>Food Categories</h2>
        <div class="filter-options">
            <select id="category-filter">
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

            <select id="price-filter">
                <option value="all">Price Range</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            <select id="rating-filter">
                <option value="all">Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>
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
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-chees.jpg" alt="Burger">
            <h3>Cheeseburger</h3>
            <p class="price">Rs.300</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-kung.jpg" alt="Chinese Food">
            <h3>Kung Pao Chicken</h3>
            <p class="price">Rs.400</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-veg.jpg" alt="Vegetarian Food">
            <h3>Vegetable Stir Fry</h3>
            <p class="price">Rs.250</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/fried-rice-967081_640.jpg" alt="Rice">
            <h3>Fried Rice</h3>
            <p class="price">Rs.200</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/ai-generated-8542471_640.jpg" alt="Chicken">
            <h3>Grilled Chicken</h3>
            <p class="price">Rs.350</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-2043767125-612x612.jpg" alt="Mutton">
            <h3>Mutton Curry</h3>
            <p class="price">Rs.500</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1193255251-612x612.jpg" alt="Buff">
            <h3>Buff Steak</h3>
            <p class="price">Rs.250</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1191425441-612x612.jpg" alt="Pork">
            <h3>Pork Ribs</h3>
            <p class="price">Rs.360</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="food-item">
            <img src="img/istockphoto-1494080845-612x612.jpg" alt="Pork">
            <h3>Moshroom Chilly</h3>
            <p class="price">Rs.280</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>Quick Bite</h3>
        <p>&copy; 2024 Online Food Ordering System. All rights reserved.</p>
      </div>
      <div class="footer-section">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="#">Terms & Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Cart</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Follow Us</h3>
        <ul class="social-links">
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">LinkedIn</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Contact</h3>
        <p>Email: support@quickbite.com</p>
        <p>Phone: 123-456-7890</p>
      </div>
    </div>
  </footer>

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

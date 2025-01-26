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
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="Quick_home.css">
</head>
<style>
.add_btn {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 0;
}

.add_btn a {
    text-decoration: none;
    display: inline-block;
    padding: 12px 20px;
    background-color: rgb(6, 8, 11);
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.add_btn a:hover {
    background-color: rgb(130, 57, 17);
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

.add_btn a:active {
    background-color: #004085;
    transform: translateY(0);
    box-shadow: 0 3px 4px rgba(0, 0, 0, 0.2);
}
</style>

<body>

    <header class="main-header">
        <div class="logo">🍴 Quick Bite</div>
        <nav class="nav-links">
            <a href="Quick_home.php">Home</a>
            <a href="#about">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="menu.php">Menu</a>
            <a href="combo.php">Offers</a>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <li id="logoutButton">
                <a href="logout.php" onclick="return confirmLogout()">Logout</a>
            </li>
            <?php else: ?>
            <li id="loginButton">
                <a href="login.php">Login</a>
            </li>
            <?php endif; ?>
        </nav>
        <div class="menu-toggle" id="menuToggle">
            ☰
        </div>
    </header>


    <section class="hero">
        <div class="banner-image">
            <img src="img/istockphoto-2142625083-612x612.jpg" alt="Delicious Food">
        </div>
        <div class="banner-overlay"></div>
        <div class="hero-content">
            <h2>Savor Every Bite, Anytime</h2>
            <p>Discover the joy of delicious meals delivered to your doorstep. Fresh, fast, and made just for you.</p>
        </div>
    </section>

    <section class="promotions">
        <h2 class="section-heading">Special Promotions Just for You!</h2>
        <div class="add_btn">
            <a href="combo.php">View All</a>
        </div>
        <div class="promotion-container">
            <div class="promotion-item">
                <h3>Limited Time Offer!</h3>
                <p>Get 20% off on your first order. Use code <strong>FIRST20</strong></p>
            </div>
            <div class="promotion-item">
                <h3>Combo Deal</h3>
                <p>Buy one pizza, get a free soda. Perfect for a treat!</p>
            </div>
            <div class="promotion-item">
                <h3>Free Delivery</h3>
                <p>Enjoy free delivery on orders above 30. No code needed!</p>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <h1>About Us</h1>
        <div class="container">
            <p>
                At Quick Bite, we strive to bring you the best dining experience. From fresh ingredients to swift
                deliveries,
                we ensure every meal you order is a delight. Our mission is to make food ordering seamless and enjoyable
                for everyone.
            </p>
        </div>
    </section>

    <section class="featured">
        <h3>Featured Dishes</h3>
        <div class="add_btn">
        </div>
        <div class="container">
            <div class="featured-item">
                <div class="card">
                    <img src="img/istockphoto-pizza.jpg" alt="Pizza">
                    <div class="card-content">
                        <h4>Pizza</h4>
                        <p>Price: Rs.400</p>
                        <a href="menu.php">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="featured-item">
                <div class="card">
                    <img src="img/istockphoto-burger.jpg" alt="Burger">
                    <div class="card-content">
                        <h4>Burger</h4>
                        <p>Price: Rs.300</p>
                        <a href="menu.php">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="featured-item">
                <div class="card">
                    <img src="img/istockphoto-rice.jpg" alt="Rice">
                    <div class="card-content">
                        <h4>Rice</h4>
                        <p>Price: Rs.200</p>
                        <a href="menu.php">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="featured-item">
                <div class="card">
                    <img src="img/istockphoto-fish.jpg" alt="Fish">
                    <div class="card-content">
                        <h4>Fish</h4>
                        <p>Price: Rs.350</p>
                        <a href="menu.php">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h2>Customer Reviews</h2>
        <div class="container">
            <div class="review-list">
                <?php
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickbite";

$conn = new mysqli($servername, $username, $password, $dbname);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `reviews` WHERE 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='review-item'>";
        echo "<div class='review-content'>";
        echo "<p class='review-text'>" . htmlspecialchars($row['review_text']) . "</p>";
        echo "<div class='rating'>";
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= $row['rating'] ? "<span class='star'>★</span>" : "<span class='star'>☆</span>";
        }
        echo "</div>";
        echo "<p class='customer-name'>" . htmlspecialchars($row['customer_name']) . "</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No reviews yet.";
}

$conn->close();
?>

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
    document.addEventListener('DOMContentLoaded', () => {
        const isLoggedIn =
            <?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'true' : 'false'; ?>;

        const loginButton = document.getElementById('loginButton');
        const logoutButton = document.getElementById('logoutButton');

        if (isLoggedIn) {
            if (loginButton) loginButton.style.display = 'none';
            if (logoutButton) logoutButton.style.display = 'block';
        } else {
            if (loginButton) loginButton.style.display = 'block';
            if (logoutButton) logoutButton.style.display = 'none';
        }
    });

    function toggleAdminForm() {
        const loginForm = document.getElementById('admin-login-form');
        if (loginForm.style.display === 'none' || loginForm.style.display === '') {
            loginForm.style.display = 'block';
        } else {
            loginForm.style.display = 'none';
        }
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('profile-preview');
            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
    </script>

</body>

</html>
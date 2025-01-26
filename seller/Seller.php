<?php
// Start session
session_start();

// Check if the seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

// Retrieve username from session
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page</title>
    <link rel="stylesheet" href="Seller.css">
</head>
<style>
:root {
    --primary-color: rgb(28, 140, 205);
    --secondary-color: #FDCB6E;
    --background-color: #F8F9FA;
    --text-color: #2D3436;
    --white: #FFFFFF;
    --accent-color: rgb(71, 25, 108);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
}

.navbar {
    background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    color: var(--white);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .logo {
    font-size: 1.8rem;
    font-weight: bold;
}

.navbar .nav-links {
    list-style: none;
    display: flex;
    gap: 1.5rem;
}

.navbar .nav-links a {
    color: var(--white);
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar .nav-links a:hover {
    color: var(--secondary-color);
}

main {
    padding: 2rem;
}

.section {
    margin: 2rem 0;
    background-color: var(--white);
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.section:hover {
    transform: scale(1.02);
}

.section h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.dashboard {
    height: 400px;
    text-align: center;
    margin-bottom: 2rem;
    background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    color: var(--white);
    padding: 3rem;
    border-radius: 10px;
}

.dashboard h1 {
    color: white;
    font-size: 2.5rem;
}

.dashboard p {
    color: white;
    font-size: 2rem;
}

.btn {
    display: inline-block;
    background-color: var(--primary-color);
    color: var(--white);
    padding: 0.8rem 1.5rem;
    margin: 0.5rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
}

footer {
    text-align: center;
    background-color: var(--primary-color);
    color: var(--white);
    padding: 1rem;
    margin-top: 2rem;
    font-size: 0.9rem;
}

footer p {
    margin: 0;
}
</style>

<body>

    <header>

        <nav class="navbar">
            <div class="logo">🍴 Food Ordering</div>
            <ul class="nav-links">
                <div class="dashboard-container">
                    </form>
                </div>
                <li><a href="#manage-products">Manage Products</a></li>
                <li><a href="seller_profile.php">Profile</a></li>
                <li><a href="seller_logout.php">Logout</a></li>
                <p class="welcome">Welcome, <?php echo htmlspecialchars($username); ?>!</p>

            </ul>

        </nav>
    </header>

    <main>
        <section id="dashboard" class="dashboard">
            <h1>Welcome, Seller!</h1>
            <p>Manage your products, view orders, and update your profile all in one place.</p>
        </section>

        <section id="orders" class="section">
            <h2>Orders</h2>
            <div class="btn-container">
                <a href="seller_pending.php" class="btn">View Pending Orders</a>
                <a href="orderhistory.php" class="btn">Order History</a>
            </div>
        </section>

        <section id="profile" class="section">
            <h2>Update Profile</h2>
            <div class="btn-container">
                <a href="seller_edit.php" class="btn">Edit Profile</a>
                <a href="seller_profile.php" class="btn">View Profile</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Food Hub. All rights reserved.</p>
    </footer>
</body>

</html>
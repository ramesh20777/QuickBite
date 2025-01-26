<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next-Level Header</title>
    <link rel="stylesheet" href="header.css">
</head>
<style>
     body, h1, a {
    margin: 0;
    padding: 0;
    text-decoration: none;
    color: inherit;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

 .main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: linear-gradient(45deg,rgb(13, 14, 14),rgb(91, 42, 125));
    color: #ffffff;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

 .logo {
    font-size: 24px;
    font-weight: bold;
    letter-spacing: 1px;
}

 .nav-links {
    display: flex;
    gap: 20px;
    align-items: center;
}

.nav-links a {
    font-size: 16px;
    color: #ffffff;
    background-color: transparent;
    padding: 10px 15px;
    border-radius: 20px;
    transition: all 0.3s ease-in-out;
    font-weight: bold;
}

 .nav-links a:hover {
    background-color: #ffccbc;
    color: #ff6f61;
}

 .menu-toggle {
    display: none;
    font-size: 24px;
    cursor: pointer;
    color: #ffffff;
}

 @media (max-width: 768px) {
    .nav-links {
        display: none;
        flex-direction: column;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        position: absolute;
        top: 70px;
        right: 20px;
        width: 200px;
        padding: 10px 0;
        z-index: 999;
    }

    .nav-links.show-menu {
        display: flex;
    }

    .nav-links a {
        color: #ff6f61;
        padding: 10px 15px;
        background: transparent;
        text-align: center;
    }

    .nav-links a:hover {
        background-color: #ff6f61;
        color: #ffffff;
    }

    .menu-toggle {
        display: block;
    }
}

 .page-title {
    margin-top: 20px;
    text-align: center;
    font-size: 28px;
    color: #ff6f61;
    font-weight: bold;
}

</style>
<body>
    <?php 
    
    ?>
    <header class="main-header">
        <div class="logo">🍴 Quick Bite</div>
        <nav class="nav-links">
        <a href="Quick_home.php">Home</a>
          <a href="Quick_home.php">About Us</a>
           <a href="menu.php">Menu</a>
           <a href="review.php">Review</a>
          <a href="combo.php">Offers</a>
          <a href="contact.php">Contact</a>
           <a href="login.php">Login</a>
        </nav>
        <div class="menu-toggle" id="menuToggle">
            ☰
        </div>
    </header>
     
    <script>
         const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.querySelector('.nav-links');
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('show-menu');
        });
    </script>
</body>
</html>

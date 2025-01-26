<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next-Level Header</title>
    <link rel="stylesheet" href="selhead.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">🍴 Food Ordering</div>
        <nav class="nav-links">
            <a href="pending-orders.html">Manage Products</a>
            <a href="order-history.html">profile</a>
            <a href="add-product.html">Logout</a>
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

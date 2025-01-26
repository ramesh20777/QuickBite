<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: rgb(198, 198, 206);
    color: #333;
}

.dashboard-container {
    width: 100%;
    margin: 10px auto;
    border: px solid black;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header {
    background: linear-gradient(45deg, rgb(13, 14, 14), rgb(91, 42, 125));
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    font-size: 2.5rem;
}

header nav a {
    text-decoration: none;
    color: white;
    margin-left: 15px;
    transition: color 0.5rem;
    font-size: 16px;
}

header nav a:hover {
    color: rgb(14, 14, 12);
}
</style>

<body>
    <div class="dashboard-container">
        <header>
            <h1>Dashboard</h1>
            <nav>
                <a href="Admin.php">Home</a>
                <a href="QuickBite\contact.php">Contact</a>
                <a href="#">Orders</a>
                <a href="#">Reports</a>
                <a href="#">Logout</a>
            </nav>
        </header>
    </div>
</body>

</html>
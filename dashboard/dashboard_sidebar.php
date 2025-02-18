<?php
include '../connection.php';  

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $sql = "SELECT COUNT(*) AS message_count FROM messages WHERE status = 'unread'";
$result = $conn->query($sql);

 if ($result && $row = $result->fetch_assoc()) {
    $message_count = $row['message_count']; 
} else {
    $message_count = 0; 
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="Assets/dashboard_sidebar.css">
    <title>Document</title>
</head>
<style>
@import url('https://fonts.cdnfonts.com/css/poppins');


:root {
    --primary-color: rgb(8, 10, 10);
    --color-danger: #ff7782;
    --secondary-color: rgb(245, 248, 246);
    --accent-color: #1b328d;
    --background-color: #f4f4f9;
    --text-color: #333;
    --header-color: #2c3e50;
    --color-info-light: #dce;
    --color-warning: #ffbb55;
    --color-variant: #677483;
    --color-success: #3d0606;
    --color-dark: #a22e2e;
    --card-border-radius: 2rem;
    --border-radius-1: 0.4rem;
    --border-radius-2: 0.4rem;
    --border-radius-3: 1.2rem;
    --card-padding: 1.8rem;
    --padding-1: 1.2rem;
    --box-shadow: 0 2rem 3rem rgba(0, 0, 0, 0.1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}

.container {
    display: flex;
    width: 100vw;
    margin: 0 auto;
}

aside {
    width: 20%;
    background: rgb(4, 4, 5);
    color: #fff;
    padding: 10px;
    height: 100vh;
    display: flex;
    flex-direction: column;
}

aside .logo {
    margin-top: 15px;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

aside .logo img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

aside .sidebar {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

aside .sidebar a {
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 1rem;
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-1);
}

aside .sidebar a:hover,
aside .sidebar a.active {
    color: var(--primary-color);
    background: var(--color-info-light);
}

aside .sidebar .message-count {
    background: var(--color-danger);
    color: white;
    padding: 0.2rem 0.6rem;
    font-size: 0.8rem;
    border-radius: var(--border-radius-1);
}

@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    aside {
        width: 100%;
        height: auto;
        padding: 10px;
    }

    aside .sidebar {
        flex-direction: row;
        justify-content: space-around;
    }

    aside .sidebar a {
        font-size: 0.9rem;
        padding: 0.4rem;
    }
}

#messageLink {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
}

#messageLink h3 {
    margin-left: 10px;
}

.material-symbols-outlined {
    font-size: 24px;
}

.message-count {
    background-color: dark red;
    color: white;
    padding: 3px 8px;
    border-radius: 50%;
    font-size: 14px;
    margin-left: 10px;
}

@media (max-width: 1024px) {
    .container {
        flex-direction: column;
    }

    aside {
        width: 100%;
        height: auto;
        padding: 10px;
    }
}

@media (max-width: 768px) {
    .insights {
        grid-template-columns: 1fr;
    }

    .main-content {
        width: 100%;
    }
}

@media (max-width: 480px) {
    input {
        width: 100%;
    }
}
</style>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="http://localhost/QuickBite/img/istockphoto-1308743818-612x612 copy.jpg" alt="Logo">
                    <h2>Quick<span class="danger">Bite</span></h2>
                </div>
            </div>

            <div class="sidebar">
                <a href="http://localhost/QuickBite/dashboard/dashboard_body.php"
                    class="<?= $section == 'dashboard' ? 'active' : '' ?>" id="dashboardLink">
                    <span class="material-symbols-outlined">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="http://localhost/QuickBite/dashboard/Admin_table/Customer.php" id="customerTableLink">
                    <span class="material-symbols-outlined">person_outline</span>
                    <h3>Customer</h3>
                </a>
                <a href="http://localhost/QuickBite/dashboard/Admin_table/Order.php" id="ordersLink">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="http://localhost/QuickBite/dashboard/message.php">
                    <span class="material-symbols-outlined">mail_outline</span>
                    <h3>Message</h3>
                 </a>
                <a href="http://localhost/QuickBite/dashboard/Admin_table/Report.php" id=" reportLink">
                    <span class="material-symbols-outlined">report_gmailerrorred</span>
                    <h3>Reports</h3>
                </a>
                <a href="http://localhost/QuickBite/dashboard/Admin_table/Combo_offers.php" id="order-summaryLink">
                    <span class="material-symbols-outlined">add</span>
                    <h3>Offers</h3>
                </a>
                <a href="../logout.php"><span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>

            </div>
        </aside>
</body>

</html>
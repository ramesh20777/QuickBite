<?php
session_start();


if (!isset($_SESSION['username'])) {
    $_SESSION['profile_image'] = $newFileName;  
    $profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : '';  
    header("Location: Admin_login.php");
    exit;
}

if (isset($_SESSION['profile_image']) && isset($_SESSION['username'])) {
    $profile_image = $_SESSION['profile_image'];  
    $username = $_SESSION['username'];            
} else {
    $profile_image = null;
    $username = 'Guest';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="Assets/dashboard_header.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
    <style>
    :root {
        --primary-color: rgb(2, 2, 2);
        --secondary-color: rgb(233, 235, 234);
        --accent-color: #1b328d;
        --background-color: #f4f4f9;
        --header-bg-color: #2c3e50;
        --header-text-color: #ffffff;
        --profile-bg-color: #f8f9fa;
        --profile-border-color: #ccc;
        --profile-text-color: #333;
        --profile-photo-border: #1b328d;
        --box-shadow-color: rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
    }

    header {
        height: 80px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--header-bg-color);
        color: black;
        padding: 1rem 2rem;
        box-shadow: 0 4px 6px var(--box-shadow-color);
    }

    header h1 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-right: 1090px;
    }

    header.profile {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--profile-bg-color);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid var(--secondary-color);
        box-shadow: 0 2px 4px var(--box-shadow-color);
    }

    header.profile .right {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    header.profile .profile-info {
        text-align: right;
        color: var(--profile-text-color);
    }

    header.profile .profile-info p {
        margin: 0;
        font-size: 1rem;
        font-weight: bold;
    }

    header.profile .profile-photo {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--profile-photo-border);
        box-shadow: 0 2px 4px var(--box-shadow-color);
    }

    header.profile .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .menu-btn {
        color: black;
        border: none;
        border-radius: 0.5rem;
        padding: 0.8rem 1.2rem;
        font-size: 1.5rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: white;
    }

    .menu-btn:hover {
        background-color: var(--header-bg-color);
        transform: scale(1.05);
    }

    .menu-btn:active {
        transform: scale(0.95);
    }

    .search-container {
        display: flex;
        align-items: center;
        border-radius: 8px;
        padding: 5px;
        margin-right: 15px;
    }

    .search-input {
        border: 2px solid #333;
        padding: 8px;
        font-size: 14px;
        outline: none;
        width: 200px;
        border-radius: 20px;
    }

    .search-btn {
        margin-left: 10px;
        background: black;
        color: white;
        border: ;
        padding: 8px;
        border-radius: 20px;
        cursor: pointer;
        transition: 0.3s;
        width: 100px;
    }

    .search-btn:hover {
        background: #14307b;
    }
    </style>
</head>

<body>
    <header class="profile">
        <a href="http://localhost/QuickBite/dashboard/dashboard_body.php"><button class="menu-btn"
                id="menuBtn">&#9776;</button>
        </a>
        <h1>Dashboard</h1>
        <div class="right"> 
                <div class="profile-info">
                    <p><?php echo htmlspecialchars($username); ?></p>
                </div>
                <div class="profile-photo">
                    <?php if (!empty($profile_image)): ?>
                    <img src="http://localhost/QuickBite/dashboard/uploads/<?php echo htmlspecialchars($profile_image); ?>"
                        alt="Profile Image" width="100">
                    <?php else: ?>
                    <p>No Profile Image</p>
                    <?php endif; ?>
                </div>
            
    </header>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuBtn = document.getElementById("menuBtn");
        menuBtn.addEventListener("click", () => {
            alert("Sidebar functionality will be added soon!");
        });
    });
    </script>
</body>

</html>
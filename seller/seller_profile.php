<?php
 $conn = new mysqli("localhost", "root", "", "quickbite");

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $sql = "SELECT * FROM sellers WHERE id=1 LIMIT 1";  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $seller = $result->fetch_assoc();
} else {
    die("No seller data found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
    <link rel="stylesheet" href="seller_edit.css">
</head>

<body>
    <?php include 'selhead.php'; ?>
    <div class="profile-container">
        <h1 class="title">Seller Profile</h1>
        <div class="profile-card">
            <img src="<?php echo $seller['profile_picture'] ?: 'default-profile.png'; ?>" alt="Seller Profile"
                class="profile-image">
            <div class="profile-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($seller['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($seller['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($seller['phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($seller['address']); ?></p>
            </div>
            <a href="seller_edit.php" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>

</html>
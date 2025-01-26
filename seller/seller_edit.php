<?php
 $conn = new mysqli("localhost", "root", "", "quickbite");

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

     $uploadDir = 'uploads/';
    
     if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  
    }

     $profilePicture = null;
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile']['tmp_name'];
        $fileName = basename($_FILES['profile']['name']);
        $newFileName = uniqid() . '-' . $fileName;
        $destinationPath = $uploadDir . $newFileName;

         if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            $profilePicture = $destinationPath;
        } else {
            echo "<p style='color: red;'>Error uploading profile picture.</p>";
        }
    }

     $sql = "UPDATE sellers 
            SET name='$name', email='$email', phone='$phone', address='$address', 
                profile_picture=IF('$profilePicture' IS NULL, profile_picture, '$profilePicture') 
            WHERE id=1";  
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Profile updated successfully!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seller Profile</title>
    <link rel="stylesheet" href="seller_edit.css">
</head>

<body>
    <?php include 'selhead.php'; ?>
    <div class="edit-container">
        <h1 class="title">Edit Seller Profile</h1>
        <form action="#" method="POST" class="edit-form" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter Your Phone Number" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required>

            <label for="profile">Upload Profile Picture:</label>
            <input type="file" id="profile" name="profile" accept="image/*">

            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
</body>

</html>
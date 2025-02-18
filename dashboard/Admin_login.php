<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php';  

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

     $checkQuery = "SELECT * FROM `admin_profile` WHERE `username` = ? OR `email` = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
         echo "Username or email already taken, please choose another.";
    } else {
         if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profileImage']['tmp_name'];
            $fileName = $_FILES['profileImage']['name'];
            $fileSize = $_FILES['profileImage']['size'];
            $fileType = $_FILES['profileImage']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadFileDir = './uploads/';
                $newFileName = $username . "_" . time() . '.' . $fileExtension;
                $destPath = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                     $stmt = $conn->prepare("INSERT INTO `admin_profile` (`username`, `email`, `password`, `profile_image`, `created_at`) VALUES (?, ?, ?, ?, NOW())");
                    $stmt->bind_param("ssss", $username, $email, $password, $newFileName);

                    if ($stmt->execute()) {
                        $_SESSION['username'] = $username;
                        $_SESSION['profile_image'] = $newFileName;
                        header("Location: dashboard_body.php");
                        exit;
                    } else {
                        echo "Error saving user data.";
                    }
                } else {
                    echo "Failed to move uploaded file.";
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        } else {
            echo "No file uploaded or upload error occurred.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Image Upload</title>
    <link rel="stylesheet" href="Admin_login.css">
 </head>
<body>
    <div class="profile-container">
        <div class="profile-circle" id="profileDisplay">
            <img src="default-profile.png" alt="Profile" id="profileImage">
        </div>
        <h1>Admin Login</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profileImageUpload">Upload Profile Image</label>
                <input type="file" id="profileImageUpload" name="profileImage" accept="image/*"
                    onchange="displayImage(this)" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="upload-button">Login</button>
        </form>
    </div>

    <script>
    function displayImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>

</html>
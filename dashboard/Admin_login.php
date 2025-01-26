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
                        header("Location: Admin.php");
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
    <link rel="stylesheet" href="styles.css">
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    background-image: linear-gradient(to bottom, rgba(19, 19, 14, 0.62), rgba(149, 25, 177, 0.8)), url("img/istockphoto-1446478805-612x612.jpg");
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.profile-container {
    background-color: rgb(247, 246, 250);
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
    position: relative;
}

.profile-circle {
    width: 120px;
    height: 120px;
    background-color: #f0f0f0;
    border: 2px solid #ddd;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.profile-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

input[type="file"] {
    padding: 5px;
}

input:focus {
    border-color: rgb(3, 4, 4);
    outline: none;
    box-shadow: 0 0 5px rgba(9, 13, 17, 0.5);
}

.upload-button {
    width: 100%;
    padding: 12px;
    background-color: rgb(9, 10, 11);
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.upload-button:hover {
    background-color: #0056b3;
}
</style>

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
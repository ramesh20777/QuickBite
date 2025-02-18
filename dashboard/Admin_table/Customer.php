<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Credentials</title>
    <link rel="stylesheet" href="customer.css">
</head>

<body>
    <?php
    include '../dashboard_header.php';   
    include '../dashboard_sidebar.php';  

     if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        
         include '../connection.php';
        
         $delete_sql = "DELETE FROM `users` WHERE `id` = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $user_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('User deleted successfully'); window.location.href='Customer.php';</script>";
        } else {
            echo "<script>alert('Error deleting user');</script>";
        }
        
        $stmt->close();
        $conn->close();
    }
    ?>

    <div class="table-container">
        <h2>User Credentials</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../connection.php';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `users` WHERE 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>
                                    <a href='?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete?\");'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
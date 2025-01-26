<?php
session_start();
$servername = "localhost";
$db_username = "root";   
$db_password = "";       
$db_name = "quickbite";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  

 if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

     $sql = "UPDATE `order_details` SET `status` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $order_id); // 's' for string, 'i' for integer

     if ($stmt->execute()) {
         $_SESSION['message'] = "Order status updated to $status.";
        header("Location: seller_pending.php");
        exit;
    } else {
         echo "Error updating record: " . $conn->error;
    }
}
?>


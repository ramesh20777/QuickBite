<?php
include './connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $order_id = intval($_POST['id']);

    $sql = "DELETE FROM order_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
}
$conn->close();
?>

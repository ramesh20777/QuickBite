<?php
$servername = "localhost";
$db_username = "root";   
$db_password = "";       
$db_name = "quickbite";

$conn = new mysqli($servername, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM reports WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    echo $stmt->execute() ? "success" : "error";
    exit();
}

 if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $sql = "UPDATE reports SET item_name=?, category=?, price=?, stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $item_name, $category, $price, $stock, $id);
    echo $stmt->execute() ? "success" : "error";
    exit();
}

 $sql = "SELECT * FROM reports";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Report.css">
     <title>Food Delivery System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
 
     <?php include '../dashboard_header.php'; ?>
  
<div class="container">
    <div class="card">
        <h2>Report Management</h2>
        <button class="btn btn-primary" onclick="location.href='report_add.php'">Add New Item</button>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { ?>
                    <tr id="row-<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td contenteditable="true" class="edit-item" data-id="<?php echo $row['id']; ?>" data-field="item_name"><?php echo $row['item_name']; ?></td>
                        <td>
                            <select class="edit-category" data-id="<?php echo $row['id']; ?>">
                                <option value="Main Course" <?php echo ($row['category'] == "Main Course") ? "selected" : ""; ?>>Main Course</option>
                                <option value="Appetizer" <?php echo ($row['category'] == "Appetizer") ? "selected" : ""; ?>>Appetizer</option>
                                <option value="Dessert" <?php echo ($row['category'] == "Dessert") ? "selected" : ""; ?>>Dessert</option>
                                <option value="Beverage" <?php echo ($row['category'] == "Beverage") ? "selected" : ""; ?>>Beverage</option>
                            </select>
                        </td>
                        <td contenteditable="true" class="edit-price" data-id="<?php echo $row['id']; ?>"><?php echo number_format($row['price'], 2); ?></td>
                        <td contenteditable="true" class="edit-stock" data-id="<?php echo $row['id']; ?>"><?php echo $row['stock']; ?></td>
                        <td>
                            <button class="btn btn-success save-btn" data-id="<?php echo $row['id']; ?>">Save</button>
                            <button class="btn btn-danger" onclick="deleteItem(<?php echo $row['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } } else { echo "<tr><td colspan='6'>No items found</td></tr>"; } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteItem(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        $.post("", { delete_id: id }, function(response) {
            if (response === "success") {
                $("#row-" + id).fadeOut();
            } else {
                alert("Error deleting record.");
            }
        });
    }
}

$(".save-btn").click(function() {
    var id = $(this).data("id");
    var item_name = $("#row-" + id + " .edit-item").text();
    var category = $("#row-" + id + " .edit-category").val();
    var price = $("#row-" + id + " .edit-price").text();
    var stock = $("#row-" + id + " .edit-stock").text();

    $.post("", { update_id: id, item_name: item_name, category: category, price: price, stock: stock }, function(response) {
        if (response === "success") {
            alert("Item updated successfully!");
        } else {
            alert("Error updating record.");
        }
    });
});
</script>
</body>
</html>

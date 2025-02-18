<?php
$servername = "localhost";
$db_username = "root";   
$db_password = "";       
$db_name = "quickbite";

 $conn = new mysqli($servername, $db_username, $db_password, $db_name);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";  
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

     $sql = "INSERT INTO reports (item_name, category, price, stock, description) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdds", $item_name, $category, $price, $stock, $description);

    if ($stmt->execute()) {
        $message = "<p style='color: green; font-weight: bold;'>Order Successful!</p>";
    } else {
        $message = "<p style='color: red; font-weight: bold;'>Error inserting record: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Report</title>
    <link rel="stylesheet" href="admin_report_add.css">
</head>
<body>
<?php include '../dashboard_header.php'; ?>
<div class="container">
    <div class="card">
        <h2>Add New Report</h2>

         <?php echo $message; ?>

        <form action="" method="POST">
            
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="Main Course">Main Course</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Beverage">Beverage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Add Report</button>
                <button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

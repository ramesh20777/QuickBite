<?php
include 'connection.php';

$successMessage = '';  

 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $category = $_POST['productCategory'];
    $description = $_POST['productDescription'];
    $stock = $_POST['stockQuantity'];
    $imagePath = null;

    if (!empty($_FILES['productImage']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileTmpPath = $_FILES['productImage']['tmp_name'];
        $fileName = uniqid() . '-' . basename($_FILES['productImage']['name']);
        $imagePath = $uploadDir . $fileName;

        if (!move_uploaded_file($fileTmpPath, $imagePath)) {
            die("Error uploading image.");
        }
    }

     $stmt = $conn->prepare("INSERT INTO `products`(`id`, `product_name`, `product_price`, `product_category`, `product_description`, `product_image`, `stock_quantity`, `created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]')");
    $stmt->bind_param("sdsssi", $name, $price, $category, $description, $imagePath, $stock);

    if ($stmt->execute()) {
        $successMessage = "Product added successfully!";
    } else {
        $successMessage = "Error adding product. Please try again.";
    }
}

 $products = $conn->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);

 $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" Product_add.css">
    <title>Add New Product</title>
</head>

<body>
    <?php
    include 'admin_header.php';

     if ($successMessage): ?>
    <div class="success-message"><?= $successMessage ?></div>
    <?php endif; ?>


    <div class="container">
        <h2>Add New Product</h2>
        <form id="addProductForm">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="productPrice">Product Price</label>
                <input type="number" id="productPrice" name="productPrice" placeholder="Enter product price" required>
            </div>

            <div class="form-group">
                <label for="productCategory">Category</label>
                <select id="productCategory" name="productCategory" required>
                    <option value="">Select category</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Snacks">Snacks</option>
                    <option value="Main Course">Main Course</option>
                    <option value="Desserts">Desserts</option>
                </select>
            </div>

            <div class="form-group">
                <label for="productDescription">Description</label>
                <textarea id="productDescription" name="productDescription" placeholder="Enter product description"
                    rows="4" required></textarea>
            </div>

            <div class="form-group-inline">
                <div>
                    <label for="productImage">Product Image</label>
                    <input type="file" id="productImage" name="productImage" accept="image/*">
                </div>
                <div>
                    <label for="stockQuantity">Stock Quantity</label>
                    <input type="number" id="stockQuantity" name="stockQuantity" placeholder="Enter stock quantity"
                        required>
                </div>
            </div>

            <button type="submit" class="btn">Add Product</button>
        </form>
    </div>
</body>

</html>
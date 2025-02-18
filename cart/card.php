<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickbite";

 $conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 if (isset($_POST['add_to_cart'])) {
    if (!empty($_POST['customer_name']) && !empty($_POST['customer_id']) && !empty($_POST['delivery_address']) && !empty($_POST['phone_number']) && isset($_POST['product_name'], $_POST['price'], $_POST['quantity'])) {
        $customer_name = $_POST['customer_name'];
        $customer_id = $_POST['customer_id'];
        $delivery_address = $_POST['delivery_address'];
        $phone_number = $_POST['phone_number'];

        foreach ($_POST['product_name'] as $key => $product_name) {
            $price = $_POST['price'][$key];
            $quantity = $_POST['quantity'][$key];
            $total = $price * $quantity;

            $sql = "INSERT INTO `order_details`(`customer_name`, `customer_id`, `product_name`, `delivery_address`, `phone_number`, `price`, `quantity`, `total`) 
                    VALUES ('$customer_name', '$customer_id', '$product_name', '$delivery_address', '$phone_number', '$price', '$quantity', '$total')";
            $conn->query($sql);
        }
    }
}

 if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    $sql = "DELETE FROM order_details WHERE id = '$order_id'";
    $conn->query($sql);
    header("Location: card.php");
    exit;
}

 if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;

    $sql = "UPDATE order_details SET price = '$price', quantity = '$quantity', total = '$total' WHERE id = '$order_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: card.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

 $customer_id_filter = isset($_GET['customer_id']) ? $_GET['customer_id'] : '';

 $sql = $customer_id_filter ? "SELECT * FROM order_details WHERE id = (SELECT MAX(id) FROM order_details WHERE customer_id = '$customer_id_filter')" : "SELECT * FROM order_details WHERE id = (SELECT MAX(id) FROM order_details)";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ne">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form - Online Food Ordering System</title>
    <link rel="stylesheet" href="card.css">
</head>
<body>
    <?php include '../menu_header.php'; ?>

    <button class="view-button" onclick="toggleOrders()">View Orders</button>
    <button class="add-button" onclick="toggleOrderForm()">Add Order</button>

    <div class="order-form-container" id="order-form-container" style="display: none;">
        <h1>Customer Order</h1>
        <form method="POST">
            <label for="customer_name">Customer Name:</label>
            <input type="text" name="customer_name" required>

            <label for="customer_id">Customer ID:</label>
            <input type="text" name="customer_id" required>

            <label for="delivery_address">Delivery Address:</label>
            <input type="text" name="delivery_address" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number" id="phone" pattern="\d{3}-\d{3}-\d{4}" maxlength="12" required placeholder="123-456-7890">

            <div id="product-container">
                <div class="product-item">
                    <label for="product_name[]">Product Name:</label>
                    <input type="text" name="product_name[]" required>

                    <label for="price[]">Price per Product:</label>
                    <input type="number" name="price[]" required>

                    <label for="quantity[]">Quantity:</label>
                    <input type="number" name="quantity[]" required min="1">
                </div>
            </div>
            <button type="submit" name="add_to_cart">Save</button>
        </form>
    </div>

    <div class="orders-container" id="orders-container" style="display: block;">
        <h1>Order List</h1>

        <form method="GET">
            <label for="customer_id">Filter by Customer ID:</label>
            <input type="text" name="customer_id" value="<?php echo $customer_id_filter; ?>" required>
            <button type="submit">Filter</button>
        </form>
        <div class="Payment">
            <a href="http://localhost/QuickBite/Payment/index.php">Payments</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['customer_name'] . "</td>";
                echo "<td>" . $row['customer_id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>
                        <form method='POST'>
                            <input type='number' name='price' value='" . $row['price'] . "' step='0.01' required>
                      </td>";
                echo "<td>
                            <input type='number' name='quantity' value='" . $row['quantity'] . "' min='1' required>
                            <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                      </td>";
                echo "<td>Rs. " . $row['total'] . "</td>";
                echo "<td>" . $row['phone_number'] . "</td>";
                echo "<td>
                            <button type='submit' name='update_order'>Update</button>
                        </form>
                        <form method='POST' style='margin-top: 5px;'>
                            <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                            <button type='submit' name='delete_order'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
 
    <script>
    function toggleOrders() {
        const ordersContainer = document.getElementById('orders-container');
        const orderFormContainer = document.getElementById('order-form-container');
        ordersContainer.style.display = 'block';
        orderFormContainer.style.display = 'none';
    }

    function toggleOrderForm() {
        const ordersContainer = document.getElementById('orders-container');
        const orderFormContainer = document.getElementById('order-form-container');
        ordersContainer.style.display = 'none';
        orderFormContainer.style.display = 'block';
    }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, ''); 
            e.target.value = formatPhoneNumber(input);
        });

        function formatPhoneNumber(input) {
            if (input.length > 10) {
                input = input.slice(0, 10); 
            }

            if (input.length > 6) {
                return `${input.slice(0, 3)}-${input.slice(3, 6)}-${input.slice(6)}`;
            } else if (input.length > 3) {
                return `${input.slice(0, 3)}-${input.slice(3)}`;
            }
            return input;
        }
    });
</script>
</body>

</html>

<?php $conn->close(); ?>
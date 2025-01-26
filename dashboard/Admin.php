<?php
session_start();

 if (!isset($_SESSION['username'])) {
    $_SESSION['profile_image'] = $newFileName;  
    $profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : '';  
    header("Location: Admin_login.php");
    exit;
} 

 if (isset($_SESSION['profile_image']) && isset($_SESSION['username'])) {
    $profile_image = $_SESSION['profile_image'];  
    $username = $_SESSION['username'];            
} else {
     $profile_image = null;
    $username = 'Guest';
}
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="Admin.css">
    <title>Dashboard</title>
    <style>
    </style>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../img/istockphoto-1308743818-612x612 copy.jpg" alt="Logo">
                    <h2>Quick<span class="danger">Bite</span></h2>
                </div>
            </div>

            <div class="sidebar">
                <a href="?section=dashboard" class="<?= $section == 'dashboard' ? 'active' : '' ?>" id="dashboardLink">
                    <span class="material-symbols-outlined">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" id="customerTableLink">
                    <span class="material-symbols-outlined">person_outline</span>
                    <h3>Customer</h3>
                </a>
                <a href="#" id="ordersLink">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="message_display.php" id="messageLink">
                    <span class="material-symbols-outlined">mail_outline</span>
                    <h3>Message</h3>
                </a>
                <a href="#" id="productLink">
                    <span class="material-symbols-outlined">inventory</span>
                    <h3>Products</h3>
                </a>
                <a href="#" id="reportLink">
                    <span class="material-symbols-outlined">report_gmailerrorred</span>
                    <h3>Reports</h3>
                </a>
                <a href="#" id="order-summaryLink">
                    <span class="mateArial-symbols-outlined">add</span>
                    <h3>Offers</h3>
                </a>
                <a href="../logout.php"><span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>

            </div>
        </aside>

        <main>
            <header class="profile">
                <button class="menu-btn" id="menuBtn">&#9776;</button>
                <h1>Dashboard</h1>
                <div class="right">
                    <div class="profile-info">
                        <!-- Display Username -->
                        <p><?php echo htmlspecialchars($username); ?></p>
                    </div>
                    <div class="profile-photo">
                        <!-- Display Profile Image -->
                        <?php if (!empty($profile_image)): ?>
                        <img src="./uploads/<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image"
                            width="100">
                        <?php else: ?>
                        <p>No Profile Image</p>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-outlined">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales</h3>
                            <h1>Rs300</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p>50%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
                <div class="expenses">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>Rs150</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p>30%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
                <div class="income">
                    <span class="material-symbols-outlined">credit_score</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>Rs500</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p>80%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 Hours</small>
                </div>
            </div>
 <!-- Orders Section -->
 <div class="order-section hidden" id="recentOrders">
            <h2>Orders</h2>
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
                    include 'connection.php';
                    $sql = "SELECT * FROM `order_details`";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                        echo "<td>Rs. " . htmlspecialchars($row['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        echo "<td>Rs. " . htmlspecialchars($row['total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                        echo "<td><button class='delete-order-btn' data-order-id='" . $row['id'] . "'>Delete</button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Customer Table Section -->
        <div class="customer-table hidden" id="customerTable">
            <h1>Customer Table</h1>
            <button class="add-order-btn" onclick="toggleOrderForm()">Add New Customer</button>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Delivery Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Static Data -->
                    <tr>
                        <td>#001</td>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>+977-9876543210</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>+977-9876543220</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Product List Section -->
        <div class="product-display hidden" id="productList">
            <h2>Product List</h2>
            <a href="Product_add.php"><button class="add-order-btn">Add Product</button></a>
            <?php
            include 'connection.php';

            $result = $conn->query("SELECT * FROM products");
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                        <td><?= htmlspecialchars($product['product_price']) ?></td>
                        <td><?= htmlspecialchars($product['product_description']) ?></td>
                        <td><?= htmlspecialchars($product['product_category']) ?></td>
                        <td>
                            <?php if ($product['product_image']): ?>
                                <img src="<?= htmlspecialchars($product['product_image']) ?>" alt="Product Image" width="50">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $product['id'] ?>" class="edit-btn">Edit</a>
                            <form method="POST" action="delete_product.php" onsubmit="return confirm('Are you sure you want to delete this product?')" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Report Section -->
        <div class="report-section hidden" id="orderReport">
            <h2>Order Report</h2>
            <button class="add-order-btn" onclick="toggleOrderForm()">Add Report</button>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>John Doe</td>
                        <td>Pizza</td>
                        <td>2</td>
                        <td><span class="status pending">Pending</span></td>
                        <td><button class="btn-action">Mark as Delivered</button></td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>Jane Smith</td>
                        <td>Burger</td>
                        <td>1</td>
                        <td><span class="status delivered">Delivered</span></td>
                        <td><button class="btn-action disabled" disabled>Delivered</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary hidden" id="orderSummary">
            <h2>Your Order Summary</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Combo</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Static Data -->
                    <tr>
                        <td>John Doe</td>
                        <td>123 Main St</td>
                        <td>+977-9876543210</td>
                        <td>Combo A</td>
                        <td>Rs. 500</td>
                        <td><a href="#" class="delete-button">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const menuBtn = document.getElementById("menuBtn");
        const sidebar = document.querySelector("aside");

        menuBtn.addEventListener("click", () => {
            sidebar.classList.toggle("active-sidebar");
            document.querySelector('main').classList.toggle('active-sidebar');
        });

        // Toggle tables
        document.getElementById("customerTableLink").addEventListener("click", () => {
            toggleTable("customerTable");
        });
        document.getElementById("ordersLink").addEventListener("click", () => {
            toggleTable("ordersTable");
        });
        document.getElementById("offersLink").addEventListener("click", () => {
            toggleTable("offersTable");
        });
        document.getElementById("productLink").addEventListener("click", () => {
            toggleTable("productTable");
        });
        document.getElementById("reportLink").addEventListener("click", () => {
            toggleTable("reportTable");
        });

        function toggleTable(tableId) {
            const tables = document.querySelectorAll(".table-section");
            tables.forEach((table) => {
                table.style.display = "none";
            });
            document.getElementById(tableId).style.display = "block";
        }
    });
    </script>
</body>

</html>
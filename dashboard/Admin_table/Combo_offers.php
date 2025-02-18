<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickbite";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $combo = $_POST['combo'];
    $price = $_POST['price'];

    $sql = "INSERT INTO `orders`(`name`, `address`, `phone`, `combo`, `price`) VALUES ('$name','$address','$phone','$combo','$price')";
    $conn->query($sql);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $combo = $_POST['combo'];
    $price = $_POST['price'];

    $sql = "UPDATE `orders` SET `name`='$name', `address`='$address', `phone`='$phone', `combo`='$combo', `price`='$price' WHERE `id`='$id'";
    $conn->query($sql);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `orders` WHERE `id`='$id'";
    $conn->query($sql);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

$sql = "SELECT * FROM `orders`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="combo_offer.css">
    <title>Combo Orders</title>
</head>

<body>

    <?php
 include '../dashboard_header.php';
// include '../dashboard_sidebar.php';
 ?>
    <div class="form-container" id="orderForm">
        <h2>Manage Combo Orders</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" id="orderId">

            <label>Name</label>
            <input type="text" name="name" id="orderName" required>

            <label>Address</label>
            <input type="text" name="address" id="orderAddress" required>

            <label>Phone</label>
            <input type="text" name="phone" id="orderPhone" required>

            <label>Combo</label>
            <input type="text" name="combo" id="orderCombo" required>

            <label>Price (Rs.)</label>
            <input type="number" name="price" id="orderPrice" required>

            <button type="submit" name="add" id="formSubmitBtn">Add Order</button>
            <button type="button" class="cancel" onclick="hideForm()">Cancel</button>
        </form>
    </div>

    <table>
        <h2>Orders</h2>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>combo</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td><?= $row['combo']; ?></td>
                <td>Rs. <?= $row['price']; ?></td>
                <td>
                    <a href="#" class="edit"
                        onclick="editOrder(<?= $row['id']; ?>, '<?= $row['name']; ?>', '<?= $row['address']; ?>', '<?= $row['phone']; ?>', '<?= $row['combo']; ?>', <?= $row['price']; ?>)">Edit</a>
                    <a href="?delete=<?= $row['id']; ?>" class="delete"
                        onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
    function showForm() {
        document.getElementById("orderForm").style.display = "block";
    }

    function hideForm() {
        document.getElementById("orderForm").style.display = "none";
    }

    function editOrder(id, name, address, phone, combo, price) {
        showForm();
        document.getElementById("orderId").value = id;
        document.getElementById("orderName").value = name;
        document.getElementById("orderAddress").value = address;
        document.getElementById("orderPhone").value = phone;
        document.getElementById("orderCombo").value = combo;
        document.getElementById("orderPrice").value = price;
        document.getElementById("formSubmitBtn").name = "update";
        document.getElementById("formSubmitBtn").textContent = "Update Order";
    }
    </script>

</body>

</html>
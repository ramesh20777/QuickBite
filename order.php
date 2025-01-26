<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    padding: 20px;
}

.order-form-container {
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Form Group Styling */
.form-group {
    margin-bottom: 15px;
}

label {
    font-size: 16px;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

button {
    background-color: rgb(3, 4, 3);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

button:hover {
    background-color: rgb(101, 105, 101);
}

/* Order Summary Section */
#order-summary {
    margin-top: 20px;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#order-summary h2 {
    margin-bottom: 10px;
}

#order-summary p {
    font-size: 16px;
    color: #333;
}

/* Table Styling */
#order-summary table {
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
}

#order-summary th, #order-summary td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
}

#order-summary th {
    background-color: #f1f1f1;
}

/* Actions Section */
.actions-btns {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.action-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.action-btn:hover {
    background-color: #45a049;
}

</style>
<body>
    <div class="order-form-container">
        <h1>Order Your Favorite Food</h1>
        <form id="food-order-form">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="food">Select Food Item:</label>
                <select id="food" name="food" required>
                    <option value="Pizza Margherita" data-price="12.99">Pizza Margherita - $12.99</option>
                    <option value="Pasta Alfredo" data-price="9.99">Pasta Alfredo - $9.99</option>
                    <option value="Cheese Burger" data-price="8.99">Cheese Burger - $8.99</option>
                    <option value="French Fries" data-price="4.99">French Fries - $4.99</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
            </div>

            <div class="form-group">
                <button type="submit" id="order-button">Place Order</button>
            </div>
        </form>

        <!-- Order Summary Table -->
        <div id="order-summary" style="display:none;">
            <h2>Order Summary</h2>
            <table>
                <tr>
                    <th>Food Item</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <tr id="order-details-row">
                    <!-- Order details will be inserted here -->
                </tr>
            </table>
        </div>

         <div class="actions-btns" id="actions-buttons" style="display:none;">
            <button class="action-btn" id="confirm-order">Confirm Order</button>
            <button class="action-btn" id="edit-order">Edit Order</button>
        </div>
    </div>

    <script>
        document.getElementById('food-order-form').addEventListener('submit', function(event) {
            event.preventDefault(); 

             let foodItem = document.getElementById('food').value;
            let quantity = document.getElementById('quantity').value;

             let selectedFood = document.querySelector(`#food option[value="${foodItem}"]`);
            let price = selectedFood.getAttribute('data-price');

             let totalPrice = (price * quantity).toFixed(2);

             document.getElementById('order-details-row').innerHTML = ` 
                <td>${foodItem}</td>
                <td>${quantity}</td>
                <td>$${totalPrice}</td>
            `;

             document.getElementById('order-summary').style.display = 'block';
            document.getElementById('actions-buttons').style.display = 'flex';
        });

         document.getElementById('confirm-order').addEventListener('click', function() {
            alert('Order Confirmed! Thank you for ordering.');
        });

         document.getElementById('edit-order').addEventListener('click', function() {
            document.getElementById('order-summary').style.display = 'none';
            document.getElementById('actions-buttons').style.display = 'none';
            document.getElementById('food-order-form').reset();
        });
    </script>
</body>
</html>

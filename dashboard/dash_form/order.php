<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
</head>
<body>
<div class="form-container">
                <h2>Customer Order</h2>
                <form id="orderForm">
                    <label for="orderId">Order ID:</label>
                    <input type="text" id="orderId" name="orderId" required>
        
                    <label for="orderCustomer">Customer Name:</label>
                    <input type="text" id="orderCustomer" name="orderCustomer" required>
        
                    <label for="orderStatus">Status:</label>
                    <select id="orderStatus" name="orderStatus" required>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="canceled">Canceled</option>
                    </select>
        
                    <label for="orderTotal">Total:</label>
                    <input type="number" id="orderTotal" name="orderTotal" required>
        
                    <button type="submit">Submit</button>
                </form>
            </div>
        
</body>
</html>
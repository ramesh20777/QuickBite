<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="check.css">
    <title>Checkout</title>
</head>
<body>
    <section class="checkout-section">
        <div class="checkout-container">
            <h2>Checkout Details</h2>
            <table class="checkout-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pizza</td>
                        <td>$15.99</td>
                        <td>2</td>
                        <td>$31.98</td>
                        <td><button class="action-btn remove-btn">Remove</button> <button class="action-btn edit-btn">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Burger</td>
                        <td>$10.99</td>
                        <td>1</td>
                        <td>$10.99</td>
                        <td><button class="action-btn remove-btn">Remove</button> <button class="action-btn edit-btn">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Rice</td>
                        <td>$7.99</td>
                        <td>1</td>
                        <td>$7.99</td>
                        <td><button class="action-btn remove-btn">Remove</button> <button class="action-btn edit-btn">Edit</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="total-text">Total Price:</td>
                        <td>$50.96</td>
                    </tr>
                </tfoot>
            </table>
            <button class="checkout-btn">Proceed to Payment</button>
        </div>
    </section>
</body>
</html>

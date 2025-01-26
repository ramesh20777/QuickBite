<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <style>
    .reviews,
    .add-review {
        margin: 20px auto;
        max-width: 600px;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(82, 106, 123, 0.1);
    }

    .review-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
        background: rgb(20, 16, 16);
    }

    .rating .star {
        color: gold;
        font-size: 18px;
    }

    .customer-name {
        font-weight: bold;
        margin-top: 10px;
    }

    textarea,
    select,
    input {
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
    }

    button {
        background: rgb(14, 15, 14);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background: rgb(74, 44, 84);
    }

    h2 {
        text-align: center;
        color: #333;
    }
    </style>
</head>

<body>
    <?php
    include 'menu_header.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quickbite";

     $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("<p style='color: red; text-align: center;'>Connection failed: " . $conn->connect_error . "</p>");
    }

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $review_text = htmlspecialchars($conn->real_escape_string($_POST['review_text']));
        $rating = intval($_POST['rating']);
        $customer_name = htmlspecialchars($conn->real_escape_string($_POST['customer_name']));

        $sql = "INSERT INTO reviews (review_text, rating, customer_name) VALUES ('$review_text', $rating, '$customer_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green; text-align: center;'>Review added successfully!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>

    <section class="add-review">
        <h2>Leave a Review</h2>
        <form action="#" method="POST">
            <textarea name="review_text" placeholder="Write your review here..." required></textarea>
            <label for="rating">Rating:</label>
            <select name="rating" id="rating" required>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
            <input type="text" name="customer_name" placeholder="Your Name" required>
            <button type="submit">Submit Review</button>
        </form>
    </section>
</body>

</html>
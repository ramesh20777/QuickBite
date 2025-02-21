<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" review.css">
    <title>Customer Reviews</title>
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
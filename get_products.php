<?php
// Include your database connection file
include('connection/config.php');

// Check if product_id is set and is numeric
if(isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    // Query to fetch images based on product_id (assuming products_image table)
    $query = "SELECT * FROM products_image WHERE p_id = $productId";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card' id='images'>
                <img src='" . $row['image'] . "'>
            </div>";
        }
    }
} else {
    // Fetch images for the first product_id by default
    $defaultQuery = "SELECT * FROM products_image LIMIT 1"; // Adjust query as per your requirement
    $defaultResult = mysqli_query($conn, $defaultQuery);
    
    if(mysqli_num_rows($defaultResult) > 0) {
        while($row = mysqli_fetch_assoc($defaultResult)) {
            echo "<div class='card' id='images'>
                <img src='" . $row['image'] . "'>
            </div>";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>

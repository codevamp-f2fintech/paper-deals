<?php
include('connection/config.php');

// Query to get the latest product ID
$query = "SELECT id FROM image ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row['id']);
} else {
    echo json_encode(null); // No products found
}

mysqli_close($conn);
?>

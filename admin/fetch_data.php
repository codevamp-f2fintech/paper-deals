<?php
include("../connection/config.php");
session_start();
// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the requested period from the query parameter
$period = $_GET['period'];
$data = [];

// Assume $role is set based on your authentication logic
$role = $_SESSION['role']; // Example role, replace this with your actual role check logic

if ($period == 'daily') {
    // Initialize arrays to hold data
    $labels = range(1, 30); // Days of the month from 1 to 30
    $dealsData = array_fill(0, 30, 0);
    $pdDealsData = array_fill(0, 30, 0);
    $subscriptionData = array_fill(0, 30, 0);
    $consultancydata = array_fill(0, 30, 0);



    // Query for deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAY(created_on) as day, COUNT(*) as count FROM deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY day";
    } else {
        // Different query based on role
        $query = "SELECT DAY(created_on) as day, COUNT(*) as count FROM deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY day";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $dealsData[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }

    // Query for pd_deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAY(created_on) as day, COUNT(*) as count FROM pd_deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY day";
    } else {
        // Different query based on role
        $query = "SELECT DAY(created_on) as day, COUNT(*) as count FROM pd_deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY day";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $pdDealsData[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }
       // Query for subscription
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAY(created_at) as day, COUNT(*) as count FROM transaction WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY day";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $subscriptionData[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }

   // Query for subscription
    if ($role == 1 || $role == 4) {
       

        $query = "SELECT DAY(created_at) as day, COUNT(*) as count FROM consultant_slots WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) GROUP BY day";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $consultancydata[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }
 
    $data = [
        'labels' => $labels,
        'dealsData' => $dealsData,
        'pdDealsData' => $pdDealsData,
        'subscriptionData' => $subscriptionData,
        'consultancydata' => $consultancydata
    ];
    
} elseif ($period == 'weekly') {
    // Handle weekly data for the current week (Sunday to Saturday)
    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    // Query for deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAYOFWEEK(created_on) as day, COUNT(*) as count FROM deals WHERE YEARWEEK(created_on, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day";
    } else {
        // Different query based on role
        $query = "SELECT DAYOFWEEK(created_on) as day, COUNT(*) as count FROM deals WHERE YEARWEEK(created_on, 1) = YEARWEEK(CURDATE(), 1) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY day";
    }
    $result = $conn->query($query);
    $dealsData = array_fill(0, 7, 0); // Initialize array with 7 zeroes
    $labels = $daysOfWeek;

    while ($row = $result->fetch_assoc()) {
        $dealsData[$row['day'] - 1] = $row['count']; // DAYOFWEEK returns 1 for Sunday, so we need to adjust index by subtracting 1
    }

    // Query for pd_deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAYOFWEEK(created_on) as day, COUNT(*) as count FROM pd_deals WHERE YEARWEEK(created_on, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day";
    } else {
        // Different query based on role
        $query = "SELECT DAYOFWEEK(created_on) as day, COUNT(*) as count FROM pd_deals WHERE YEARWEEK(created_on, 1) = YEARWEEK(CURDATE(), 1) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY day";
    }
    $result = $conn->query($query);
    $pdDealsData = array_fill(0, 7, 0); // Initialize array with 7 zeroes

    while ($row = $result->fetch_assoc()) {
        $pdDealsData[$row['day'] - 1] = $row['count'];
    }

   // Query for subscription
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAYOFWEEK(created_at) as day, COUNT(*) as count FROM transaction WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day";
    }
    $result = $conn->query($query);
$subscriptionData = array_fill(0, 7, 0);
    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $subscriptionData[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }
// Query for subscription
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAYOFWEEK(created_at) as day, COUNT(*) as count FROM consultant_slots WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day";
    }
    $result = $conn->query($query);
$consultancydata = array_fill(0, 7, 0);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $consultancydata[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }
 
    $data = [
        'labels' => $labels,
        'dealsData' => $dealsData,
        'pdDealsData' => $pdDealsData,
        'subscriptionData' => $subscriptionData,
        'consultancydata' => $consultancydata
    ];
} elseif ($period == 'monthly') {
    // Handle monthly data
    $labels = [];
    $dealsData = array_fill(0, 12, 0); // Initialize array with 12 zeroes
    $pdDealsData = array_fill(0, 12, 0); // Initialize array with 12 zeroes
   $subscriptionData = array_fill(0, 12, 0);
   $consultancydata = array_fill(0, 12, 0);
    // Fill labels with month names
    for ($i = 1; $i <= 12; $i++) {
        $labels[] = date('F', mktime(0, 0, 0, $i, 10));
    }

    // Query for deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT MONTH(created_on) as month, COUNT(*) as count FROM deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY month";
    } else {
        // Different query based on role
        $query = "SELECT MONTH(created_on) as month, COUNT(*) as count FROM deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY month";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $month = (int)$row['month'];
        $dealsData[$month - 1] = $row['count']; // Adjust index since array starts from 0
    }

    // Query for pd_deals
    if ($role == 1 || $role == 4) {
        $query = "SELECT MONTH(created_on) as month, COUNT(*) as count FROM pd_deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY month";
    } else {
        // Different query based on role
        $query = "SELECT MONTH(created_on) as month, COUNT(*) as count FROM pd_deals WHERE created_on >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') GROUP BY month";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $month = (int)$row['month'];
        $pdDealsData[$month - 1] = $row['count']; // Adjust index since array starts from 0
    }
    // Query for subscription
    if ($role == 1 || $role == 4) {
        $query = "SELECT MONTH(created_at) as month, COUNT(*) as count FROM transaction WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY month";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $month = (int)$row['month'];
        $subscriptionData[$month - 1] = $row['count']; // Adjust index since array starts from 0
    }

 // Query for consultant_slots
    if ($role == 1 || $role == 4) {
        $query = "SELECT DAYOFWEEK(created_at) as day, COUNT(*) as count FROM consultant_slots WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day";
    }
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $consultancydata[$day - 1] = $row['count']; // Adjust index since array starts from 0
    }
 
    $data = [
        'labels' => $labels,
        'dealsData' => $dealsData,
        'pdDealsData' => $pdDealsData,
        'subscriptionData' => $subscriptionData,
        'consultancydata' => $consultancydata
    ];
}

echo json_encode($data);
?>

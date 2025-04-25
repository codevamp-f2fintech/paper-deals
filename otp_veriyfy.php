<?php
include("connection/config.php");

// Assuming $conn is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming 'otp' is sent via POST
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $query = "SELECT * FROM `otp` WHERE otp ='$otp'";
    $run = mysqli_query($conn, $query);

    if (mysqli_num_rows($run) > 0) {
        $response = array(
            'status' => 1,
            'message' => 'Verified'
        );
        echo json_encode($response);
        exit;
    } else {
        $response = array(
            'status' => 0,
            'message' => 'OTP is Wrong'
        );
        echo json_encode($response);
        exit;
    }
} else {
    // Handle invalid request method (not POST)
    $response = array(
        'status' => 0,
        'message' => 'Invalid request method'
    );
    echo json_encode($response);
    exit;
}
?>

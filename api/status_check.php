<?php
include ('../connection/config.php');
// Set the appropriate headers to indicate JSON response
header('Content-Type: application/json');

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you want to return status 1 for any GET request
    
     $query = mysqli_query($conn, "Select * from demo where status=1");
     if (mysqli_num_rows($query) > 0) {
          $response = array('status' => 1);
     }else{
          $response = array('status' => 0);
     }
   
    // Encode the response array into JSON format
    echo json_encode($response);
} else {
    // If the request method is not GET, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Method not allowed'));
}
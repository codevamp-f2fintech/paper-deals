<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('connection/config.php');
date_default_timezone_set("Asia/Calcutta");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $currentDateTime = date("Y-m-d H:i:s");
    
    $query = "insert into support(subject,name,phone,email,message,created_at) values('$subject','$name','$phone','$email','$message','$currentDateTime')";
    $query_run = mysqli_query($conn,$query);
   
    $isSuccess = true;

    if ($isSuccess) {
        // Redirect back to form with success message
        header("Location: support.php?success=1");
        exit();
    }
} else {
    // Redirect back to form with error message
    header("Location: support.php?error=1");
    exit();

}
?>
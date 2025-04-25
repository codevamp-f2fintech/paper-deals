<?php session_start();
  ?>
<?php
error_reporting(0);
include('connection/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    $query = "insert into contact_us(name,mobile_no,email_id,message) values('$name','$phone','$email','$message')";

    $query_run = mysqli_query($conn, $query);
    $isSuccess = true;

    if ($isSuccess) {
        // Redirect back to form with success message
        header("Location: contact_us.php?success=1");
        exit();
    }
} else {
    // Redirect back to form with error message
    header("Location: contact_us.php?error=1");
    exit();

}
?>
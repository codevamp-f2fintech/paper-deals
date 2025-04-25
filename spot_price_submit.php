<?php session_start();
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('connection/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $user_id = mysqli_real_escape_string($conn, $_POST['spot_price_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sellerenq = mysqli_real_escape_string($conn, $_POST['sellerenq']);
// print_r($_POST);
// exit;
    if($sellerenq){
    
        $message="buyer/Seller Enquery";
   }

    $query = "insert into spot_price_enquiry(spot_price_id,name,phone,email_id,message) values('$user_id','$name','$phone','$email','$message')";

    $query_run = mysqli_query($conn, $query);

    $isSuccess = true;

    if ($isSuccess) {

        // Redirect back to form with success message
 if($sellerenq){
        header("Location: spot_price.php?success=1");
        exit();
           }else{
            header("Location: spot_price_enquiry.php?success=1");
        exit();
           }
    }
} else {
    if($sellerenq){
    // Redirect back to form with error message
    header("Location: spot_price.php?error=1");
    exit();
     }else{
            header("Location: spot_price_enquiry.php?success=1");
        exit();
           }

}
?>
<?php
include ("connection/config.php");
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
$user_type = $_POST['user_type'];
$email = $_POST['email'];
$result = mysqli_query($conn,"SELECT * FROM users WHERE email_address = '$email' AND user_type = '$user_type'");
$data=mysqli_fetch_assoc($result);
$id=$data['id'];
$name=$data['name'];



if (mysqli_num_rows($result) > 0) {
     $randomNumber = rand(100000, 999999);
    $password=md5($randomNumber);
    $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));


    $UPDATEresult = mysqli_query($conn,"UPDATE `users` SET `password` = '$password' WHERE `users`.`id` = $id");
    if ($UPDATEresult) {

      try {
    // SMTP server configuration
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com'; // Amazon SES SMTP endpoint
    $mail->SMTPAuth = true;
    $mail->Username = 'info@nuovasoft.com'; // SMTP username
    $mail->Password = 'xsmtpsib-9ef3644a1ebc242e365798b4b4c0497d4a6d0835bc3484f18026886ac8b48a5d-cRDvKabBFSm0AxJZ'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port for TLS

    // Sender and recipient settings
    $mail->setFrom('no-reply@paperdeals.in', 'Paper Deals Team'); // Replace with your "From" email address and name
    $mail->addAddress($email, $name); // Replace with the recipient's email address and name
//   $mail->addReplyTo('abstract@isfr2024.in', 'ISFR Team'); // Optional: Reply-To address
      
     $mail->SMTPDebug = 2; 
    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Forgot Password';
    $mail->Body    =  'Your Password is : - '.$randomNumber;
    $mail->send();
    $response = array(
    'status' => 1,
    'message' => 'Confirmation Email Send successfully',
 
);
 echo json_encode($response);
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
} else {
    //echo "No account found with that email address.";
}
}

?>

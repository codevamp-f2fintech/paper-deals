<?php
$hostname = '103.175.163.22';
$username = 'nuovasoft2adm_giftnbag_user';
$password = 'D(LA=8DOa=nO@12$!';
$database = 'nuovasoft2adm_giftnbag_db';

$conn = mysqli_connect($hostname, $username, $password,$database) or die("Sorry connection could not estalished");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$phone=$_POST['phone'];
$email_id=$_POST['email'];
$type=$_POST['type'];
$name=$_POST['name'];
$password=md5($_POST['password']);
$otp=$_POST['otp'];
$status=1;

$existing_user_query = mysqli_query($conn,"SELECT * FROM users WHERE email_address = '$email_id'");
$existing_user_phone = mysqli_query($conn,"SELECT * FROM users WHERE phone_no = '$phone'");


if (mysqli_num_rows($existing_user_query) > 0) { 
$response = [
    
    "status" => 0,
    "message" =>
        "This Email is already in use. Please  use a different email address",
];
echo json_encode($response);
exit;
} else if (mysqli_num_rows($existing_user_phone) > 0) { 

$response = [
    "status" => 0,
    "message" =>
        "This Mobile Number is already in use. Please  use a different Mobile Number",
];
echo json_encode($response);
exit;

}



$result = mysqli_query($conn,"SELECT * FROM `otp` WHERE phone='$phone'");
$otpdata = mysqli_fetch_assoc($result);
if ($otpdata["otp"] != $otp) { 
$response = [
    "status" => 0,
    "message" => "OTP is Wrong",
];
echo json_encode($response);
exit;
}else {$add_user_query = mysqli_query(
                    $conn,
                    "INSERT INTO users SET user_type='$type', name='$name', email_address='$email_id', password='$password', phone_no='$phone', active_status='$status', whatsapp_no='$phone'"
                );
 if ($add_user_query) { ?>

											<?php
           $response = [
               "status" => 1,
               "message" => 'Your profile is not active yet. Thanks for
													showing interest. We will update you when your profile will be activated.',
           ];
           echo json_encode($response);
           exit;
           } else { ?>

										<?php
          $response = [
              "status" => 0,
              "message" => "Failed to insert user data. Please try again.",
          ];
          echo json_encode($response);
          exit;
          }}}
     else {
         ?>
									
									<?php
         $response = [
             "status" => 0,
             "message" =>
                 "Invalid input data. Please check the form	fields and try again.",
         ];
         echo json_encode($response);
         exit;

    }

?>

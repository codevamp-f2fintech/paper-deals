<?php
include ("connection/config.php");
$api_url = 'https://restapi.smscountry.com/v0.1/Accounts/NFz4bklqsWXDrOE1mAwa/SMSes/';

$auth_key = 'TkZ6NGJrbHFzV1hEck9FMW1Bd2E6cDNoek5CdVVmeE00TTFCWTdua0NnaG9ZZUxYQmM1UXV4dXZqYnVneg==';

$headers = [
    'Authorization: Basic ' . $auth_key,
    'Content-Type: application/json',
];
$number=$_POST['phone'];
$randomNumber = rand(1000, 9999);

  
$run=mysqli_query($conn,"SELECT * FROM `users` WHERE `phone_no` = '$number'");

if(mysqli_num_rows($run)==0){
    
mysqli_query($conn,"INSERT INTO otp (otp,phone,status) VALUES ('$randomNumber', '$number','1')");
    
    
$data = [
    'Text' => 'Dear Guest, your one time password (OTP) for logging to Paper Deals program OTP is '. $randomNumber.' The OTP will remain valid for 2 minutes. Thanks you, Team Kay Group',
    'Number' => $number,
    'SenderId' => 'KAYPDO',
   // 'DRNotifyUrl' => 'https://www.demo.nuovasoft.com/callback',
   // 'DRNotifyHttpMethod' => 'POST',
    'Tool' => 'API',
];
}

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
]);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

echo $response;
?>

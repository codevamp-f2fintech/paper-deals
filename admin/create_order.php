<?php 
session_start(); // Make sure to start the session if you haven't already

require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

// Retrieve the amount from the AJAX request
$amount = $_POST['amount'];

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = uniqid(); // Example session ID
}

$receipt = $_SESSION['id'];
$str = strval($receipt);

$orderData = [
    'receipt'         => $str,
    'amount'          => $amount * 100, // Convert amount to paise
    'currency'        => 'INR',
    'payment_capture' => 1 
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];

// Return the order ID as a response
echo $razorpayOrderId;
?>

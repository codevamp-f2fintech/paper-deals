<?php

error_reporting(0);
date_default_timezone_set("Asia/Calcutta");
require ('admin/config.php');
require ('admin/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

include ('connection/config.php');


$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_POST['razorpay_order_id'];
$signature = $_POST['razorpay_signature'];
$transactionsql = "SELECT * FROM `consultant_slots` where orderId='$order_id'";

$transactioresult = mysqli_query($conn, $transactionsql);
$trans = mysqli_fetch_assoc($transactioresult);
$consultant_slotsid = $trans['id'];
$consultant_id = $trans['consultant_id'];



$success = true;
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {

        $attributes = array(
            'razorpay_order_id' => $_POST['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {

    $sql = "UPDATE `consultant_slots` SET `payment_id` = '$payment_id',`signature` = '$signature',`status` = '1' WHERE `consultant_slots`.`id` = '$consultant_slotsid'";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        $_SESSION['paymenyt_status'] = "Your payment was successful";
        header("Location: admin/userchat.php");


    }

} else {
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
    $_SESSION['paymenyt_status'] = "Your payment failed";
    header("Location: subscription.php");

}


?>
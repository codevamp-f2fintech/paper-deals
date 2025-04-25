<?php  

error_reporting(0);
date_default_timezone_set("Asia/Calcutta"); 
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
include('../connection/config.php');
$type=$_GET['type'];

$date = date('Y-m-d H:i:s');
$futureDate=date('Y-m-d', strtotime('+1 year'));
$payment_id=$_POST['razorpay_payment_id'];
$order_id=$_POST['razorpay_order_id'];
$signature=$_POST['razorpay_signature'];
$transactionsql="SELECT * FROM `transaction` where transaction_id='$order_id'";

$transactioresult=mysqli_query($conn,$transactionsql);
$trans = mysqli_fetch_assoc($transactioresult);
$trsns_id=$trans['transaction_id'];
$user_id=$trans['user_id'];
$transactionid=$trans['id'];

$success = true;
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
     
        $attributes = array(
            'razorpay_order_id' => $_POST['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
  
    $sql="UPDATE `transaction` SET `transaction_status` = '1' , payment_id='$payment_id',signature='$signature' WHERE `transaction`.`transaction_id` = '$trsns_id'";
    $result=mysqli_query($conn,$sql);
    
    if($result){
//     echo $type;
// exit;
    
      $subscription="insert into subscription (user_id,type,transaction_id,start_date,end_date,status,created_at) values ('$user_id','$type','$transactionid','$date','$futureDate','1','$$date')";
     $subscriptionresult=mysqli_query($conn,$subscription);
     if($subscriptionresult){
        $_SESSION['paymenyt_status']="Your payment was successful";
         header("Location: subscription.php");
     }
  
    }
   
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
             $_SESSION['paymenyt_status']="Your payment failed";
             header("Location: subscription.php");

}

    
?>


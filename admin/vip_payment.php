<?php  
session_start();

$con_id=$_GET['id'];
$vip=$_GET['vip'];
$veryfiy=$_GET['veryfiy'];

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
error_reporting(0);
$hostname	=	'database-1.cziuo6a2ozsg.ap-south-1.rds.amazonaws.com';
$username   =   'admin';
$password   =   'mzmCdy0pemM3ywMgH0uY';
$database   =   'giftnbag_db';

$conn  		= mysqli_connect($hostname, $username, $password) or die("Sorry connection could not estalished");
mysqli_select_db($conn, $database) or die("Sorry database could not found");



require('config.php');
require('razorpay-php/Razorpay.php');
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
    if($vip==1){
    $sql="UPDATE `organization` SET `vip` = $vip WHERE user_id = $con_id";

    }
     if($veryfiy==1){
    $sql="UPDATE `organization` SET `verified` = $veryfiy WHERE user_id = $con_id";

    }
    
 
     mysqli_query($conn,$sql);
    header("Location: index.php");
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
echo $html;

}

    


?>


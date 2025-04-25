<?php  
session_start();
error_reporting(0);
$hostname	=	'database-1.cziuo6a2ozsg.ap-south-1.rds.amazonaws.com';
$username   =   'admin';
$password   =   'mzmCdy0pemM3ywMgH0uY';
$database   =   'giftnbag_db';

$conn  		= mysqli_connect($hostname, $username, $password) or die("Sorry connection could not estalished");
mysqli_select_db($conn, $database) or die("Sorry database could not found");
$con_id=$_GET['id'];
$book=$_GET['book'];
$query="SELECT * FROM `consultant_slots` WHERE id= $con_id";
$result_cons=mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result_cons);
$price=$data['consultant_price'];
$consultant_id=$data['consultant_id'];
$book_id=$data['book_id'];

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;



$payment_id=$_POST['razorpay_payment_id'];
$order_id=$_POST['razorpay_order_id'];
$signature=$_POST['razorpay_signature'];



$sql="insert into orders (amount,consultant_id,book_id,payment_id,order_id,signature,status) values ($price,$consultant_id,$book_id,'$payment_id','$order_id','$signature',1)";

$result=mysqli_query($conn,$sql);

if($result)
{
require('config.php');
require('razorpay-php/Razorpay.php');
$success = true;

$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
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
    $sql="UPDATE `consultant_slots` SET `status` = '1', `book_id` = $book WHERE `consultant_slots`.`id` = $con_id";

    $result=mysqli_query($conn,$sql);
    $_SESSION['paymenyt_status']="Your payment was successful";
    header("Location: index.php");
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
             $_SESSION['paymenyt_status']="Your payment failed";
header("Location: index.php");

}

    
}
else 
{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>


<?php 
session_start();
include_once('../connection/config.php');

 date_default_timezone_set("Asia/Calcutta");

$paymentid=$_POST['payment_id'];
$consultant_id=$_POST['consultant_id'];

$dt=date('Y-m-d h:i:s');

$sql="insert into orders (product_id,payment_id,added_date) values ('order_EKwxwAgItmmXdp','".$paymentid."','".$dt."')";

$result=mysqli_query($conn,$sql);

if($result)
{
	echo 'done';
	$sql="UPDATE `consultant_slots` SET `status` = '1' WHERE `consultant_slots`.`id` = $consultant_id";
    $result=mysqli_query($conn,$sql);
	$_SESSION['slot_book'] = "Your Sloot Booked";
	
}
else 
{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
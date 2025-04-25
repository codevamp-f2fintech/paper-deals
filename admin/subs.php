<?php
include('../connection/config.php');

date_default_timezone_set("Asia/Calcutta"); 
$user_id=$_POST['user_id'];
$orderId=$_POST['orderId'];
$amount=$_POST['amount'];
$date = date('Y-m-d H:i:s');

$transaction="insert into transaction (user_id,transaction_id,transaction_status,amount,created_at) values ('$user_id','$orderId','0','$amount','$date')";

$result=mysqli_query($conn,$transaction);
if($result){
echo 1;
}else{
echo 0;
}
?>
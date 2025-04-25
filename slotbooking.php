<?php
include('connection/config.php');

date_default_timezone_set("Asia/Calcutta");
$user_id = $_POST['user_id'];
$orderId = $_POST['orderId'];
$amount = $_POST['amount'];
$consult_id = $_POST['consult_id'];

$date = date('Y-m-d H:i:s');

$transaction = "UPDATE `consultant_slots` SET `book_id` = '$user_id',`orderId` = '$orderId' WHERE `consultant_slots`.`id` = '$consult_id'";
// echo $transaction;
// exit;
$result = mysqli_query($conn, $transaction);
if ($result) {
    echo 1;
} else {
    echo 0;
}

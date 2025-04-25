<?php
include_once ('../connection/config.php');
date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
$created = date('Y-m-d H:i:s');
// echo $created;
$p = $_POST['product'];
$enq_id = $_POST['e_id'];


foreach ($_POST['id'] as $key => $value) {


  $update = "UPDATE `users` SET `msg_status` = '1' WHERE `users`.`id` = $value;";
  $insert_run = mysqli_query($conn, $update);

  $insert = "INSERT INTO `enquery_message` (`product`, `seller_id`,`enq_id`,`created_at`) VALUES ('$p', '$value', '$enq_id','$created')";
  $insert_run = mysqli_query($conn, $insert);
  if ($insert_run) {

    echo 1;


  } else {
    echo 0;
  }

}








?>
<?php
include_once ('../connection/config.php');
date_default_timezone_set("Asia/Calcutta");
// $truncate = "TRUNCATE TABLE spot_price;";
// $query_run = mysqli_query($conn, $truncate);
 
    $arr=$_POST['id'];
    print_r($arr);
    for($i=0;$i<count($arr);$i++){
      
      $value=$_POST['id'][$i];
      $p_id = $value;
      $price = $_POST['price'][$i];
      $created_at = date("Y-m-d h:i:s");
      $status = 1;
   
      $insert = "INSERT INTO `spot_price` (`product_id`,`spot_price`,`created_at`,`status`) VALUES ('$p_id','$price','$created_at','$status')";
// echo $insert."<br>";

      $insert_run = mysqli_query($conn, $insert);
      if ($insert_run) {
       
        echo 1;


      } else {
        echo 0;
      }

 
 
  }








?>
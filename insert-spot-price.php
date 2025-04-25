<?php session_start();
  ?>
<?php
include_once('../connection/config.php');

foreach ($_POST['id'] as $key => $value) {
    $sql = "Select * from product where id=$value";
    $query_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query_run) > 0) {
      while($row = mysqli_fetch_assoc($query_run)){
        
        $p_id=$row["id"];
        $seller_id=$row["seller_id"];
        $product_name=$row["product_name"];
        $hsn_number=$row["hsn_number"];
        $unit_size=$row["unit_size"];
        $price=$row["price"];
        $created_at=$row["created_at"];
        $status=$row["status"];
        
    $insert = "INSERT INTO `product_detail` (`product_id`, `seller_id`, `name`, `hsn_no`, `quantity`, `spot_price`,`created_at`,`status`) VALUES ('$p_id', '$seller_id', '$product_name', '$hsn_number', '$unit_size', '$price','$created_at','$status')";
  //  echo $insert;
      $insert_run = mysqli_query($conn, $insert);
       if($insert_run){
        echo 1;
       

       }else{
        echo 0;
       }

      };
    }
}



                                                   
                                                   
                                                   
                                                   ?>
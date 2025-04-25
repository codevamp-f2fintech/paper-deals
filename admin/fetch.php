<?php  
 //fetch.php  
 include ('../connection/config.php');
if(isset($_POST["p_id"]))  
 {  
      $query = "SELECT * FROM product_new WHERE id = '".$_POST["p_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
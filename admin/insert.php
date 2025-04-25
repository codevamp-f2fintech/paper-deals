 
  <?php  
include ('../connection/config.php'); 

  if($_POST['status_update']=="yes"){
$status = $_POST["status"];  

      $id = $_POST["p_id"];
$query = "UPDATE product_new SET approved='$status' WHERE id =$id";  

$query_run = mysqli_query($conn, $query);
// echo $query_run;
if($query_run){
        $message = 'Data Updated';  
        echo $message; 
    }
    
  }else{
     

      $quantity = $_POST["quantity"];  
      $price = $_POST["price"];  
      $id = $_POST["p_id"];
$query = "UPDATE product_new SET quantity_in_kg='$quantity',price_per_kg='$price' WHERE id =$id";  

$query_run = mysqli_query($conn, $query);
// echo $query_run;
if($query_run){
        $message = 'Data Updated';  
        echo $message; 
    }
  }

 ?>
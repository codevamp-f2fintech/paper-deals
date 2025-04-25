<?php  
include ('../connection/config.php');
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
   
      $output = '';  
      $query = "SELECT * FROM deals WHERE created_on BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
        //   echo $query;
        //   exit;
      $result = mysqli_query($conn, $query);  
     
      $output .= '  
           <table class="table table-bordered">  
               <tr>
                    <th>Date</th>
                    <th>Buyer</th>

                    <th>Seller</th>
                    <th>Amount</th>
                    <th>Weight</th>
                    <th>Commission</th>
                </tr>
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $date = date('d/m/Y', strtotime($row['created_on'])) .'</td>  
                          <td>'. $row["buyer_id"] .'</td>  
                          <td>'. $row["seller_id"] .'</td>  
                          <td>'. $row["deal_size"] .'</td>  
                          <td>'. $row["weight"] .'</td> 
                          <td>'. $row["commission"] .'</td>  
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>

<?php
include_once('header.php');
include('../connection/config.php');
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
$id = $_SESSION['id'];

?>
<div class="content-wrapper">

<section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                Subscriptions 
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr style="text-align:center">
                                <th>ID</th>
                                <th>Subscriptions Type</th>
                                    <th>Subscriptions Price</th>
      <?php if($_SESSION['role']==2 || $_SESSION['role']==3){ ?>
                             <th>Action</th>

                             <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                              <?php
                                                  $i=1; 
                                                    $sql = "SELECT * FROM `subscription_plan`";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            
                                                   
                                                    ?>
                             <tr style="text-align:center">
                                        <td>
                                          <?php  echo $item['id']; ?>
                                        </td>
                                      
                                        <td>
                                      <?php  echo $item['name']; ?>
                                        </td>
                                      <td>
                                         <?php  echo $item['price']; ?>
                                        </td>
                                          <td>
                          

<?php
 if($_SESSION['role']==2 || $_SESSION['role']==3){ 
$users_id=$_SESSION['id'];

$Vipcount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `subscription` where user_id='$users_id' AND type='Vip'"));
$VERIFIEDcount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `subscription` where user_id='$users_id' AND type='VERIFIED'"));


?>
<?php  if($item['name']=='VIP') { ?>
<button class="btn btn-primary subscribe" value="<?php  echo $item['name']; ?>" <?php if($Vipcount>0) { ?>disabled<?php  } ?>>Subscribed</button>
<?php }else if($item['name']=='VERIFIED') { ?>
    <button class="btn btn-primary subscribe" value="<?php  echo $item['name']; ?>" <?php if($VERIFIEDcount>0) { ?>disabled<?php  } ?>>Subscribed</button>

   <?php } } ?>    



                                        </td>
                                    </tr>
                              
                              <?php $i++; } } ?>
                          

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                Subscriptions
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">

                        <thead>
                           
                            <tr>
                                <th>ID</th>
                                <th>Buyer/seller</th>
                                <th>Subscription Plan</th>
                                <th>Amount</th>
                                <th>Invoice</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
            <tbody>
                    <?php
                               $user_id=$_SESSION['id'];
                                if($_SESSION['role']==1 || $_SESSION['role']==4){
                                    $query = "SELECT subscription.*,transaction.id,transaction.amount FROM `subscription` JOIN transaction on  transaction.id=subscription.transaction_id"; 
                                }else{
                                    $query = "SELECT subscription.*,transaction.id,transaction.amount FROM `subscription` JOIN transaction on  transaction.id=subscription.transaction_id where subscription.user_id='$user_id'"; 
                                }
                                   

                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $prod_item) {
                                         
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $prod_item['id']; ?>
                                                </td>
                                               
                                                <td>
                                                    <?php
                                                   
                                                    $sql = "Select organization.id,organization.user_id,organization.organizations,users.id,users.user_type,users.name from users join organization on users.id=organization.user_id where users.id=$prod_item[user_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            if($item['user_type']==1){
                                                             $type="Admin";
                                                            }else if($item['user_type']==2){
                                                             $type="Seller"; 
                                                            }else if($item['user_type']==3){
                                                             $type="Buyer"; 
                                                            }
                                                         

                                                        echo $item['organizations'].'('.$type .')';
                                                        
                                                            
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                               
                                                  <td>
                                                    <?php echo $prod_item['type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['amount']; ?>
                                                </td>
                                                 <td>
                                                  <a href="invoice.php?id=<?php echo $prod_item['user_id']; ?>&type=<?php echo $prod_item['type']; ?>" class="btn btn-primary" class="invoice">Donwload</a>                                                </td>
                                                   <td>
                                                    <?php echo $prod_item['start_date']; ?>
                                                </td>
                                                   <td>
                                                    <?php echo $prod_item['end_date']; ?>
                                                </td>
                                                   <td>
                                                 <span class="btn btn-info">subscribed</span>
                                                </td>
                                            </tr>

                                        <?php
                                           
                                        }

                                     if($_SESSION['role']==4){ ?>
                                             <tr>                                           <th colspan="8" style="text-align: right;
    font-size: 25px;">Total Amount :- (&#x20b9; <?php echo mysqli_fetch_assoc(mysqli_query($conn,"SELECT subscription.transaction_id,transaction.id,SUM(transaction.amount) as total_amount FROM `subscription` JOIN transaction on  transaction.id=subscription.transaction_id"))['total_amount'];  ?>) </th>
</tr>
<?php }
                                    } 
                                    
                                    
                                    else {
                                        ?>
                                        <tr>
                                            <td class="colspan-8">No Record found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


  <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                Chat Payment History
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">

                        <thead>
                           
                            <tr>
                                <th>ID</th>
                                <th>Buyer/seller</th>
                                <th>Consulatant</th>
                                <th>Amount</th>
                                <th>Invoice</th>
                               <th>Status</th>
                            </tr>
                        </thead>
            <tbody>
                    <?php
                               $user_id=$_SESSION['id'];
                                if($_SESSION['role']==1 || $_SESSION['role']==4){
                                    $query = "SELECT consultant_slots.id,consultant_slots.consultant_price,consultant_slots.status,consultant_slots.consultant_id,consultant_slots.book_id FROM `consultant_slots` WHERE status=1"; 
                                }else{
                                    $query = "SELECT consultant_slots.id,consultant_slots.consultant_price,consultant_slots.status,consultant_slots.consultant_id,consultant_slots.book_id FROM `consultant_slots` WHERE status=1 AND book_id='$user_id'"; 
                                }
                                   

                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $prod_item) {
                                         
                                    ?>
                                            <tr>
                                                <td>
                                                  <?php echo $prod_item['id']; ?>
                                                </td>
                                               
                                                <td>
                                                   <?php
                                                  $cid= $prod_item['book_id'];
                                                   echo mysqli_fetch_assoc(mysqli_query($conn,"select id,name from users where id='$cid'"))['name']; ?>
                                                </td>
                                               
                                                  <td>
                                                     <?php
                                                  $cid= $prod_item['consultant_id'];
                                                   echo mysqli_fetch_assoc(mysqli_query($conn,"select id,name from users where id='$cid'"))['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['consultant_price']; ?>
                                                </td>
                                                 <td>
                                                     <a href="invoice.php?id=<?php echo $prod_item['book_id']; ?>" class="btn btn-primary">Donwload</a>  
                                                </td>
                                                  
                                                   <td>
                                                 <span class="btn btn-success">paid</span>
                                                </td>
                                            </tr>

                                        <?php
                                           
                                        }

                             
                                    }
                                    
                                    else {
                                        ?>
                                        <tr>
                                            <td class="colspan-8">No Record found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php if($_SESSION['role']==4){ ?>
        <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                Consultancy
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            
                            <tr>
                                <th>ID</th>
                                <th>Users</th>
                                <th>Consultant</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
            <tbody>
                    <?php
                               $user_id=$_SESSION['id'];
                                if($_SESSION['role']==1 || $_SESSION['role']==4){
                                    $query = "SELECT * FROM `consultant_slots` where status=1"; 
                                }else{
                                    $query = "SELECT * FROM `consultant_slots` where book_id='$user_id' AND status=1"; 
                                }
                                   

                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $prod_item) {
                                         
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo  $prod_item['id']; 
                                                    
                                                    
                                                    ?>
                                                </td>
                                               
                                                <td>
                                                          <?php  
                                $book_id=$prod_item['book_id']; 
                                    echo mysqli_fetch_assoc(mysqli_query($conn,"select name,id from users where id='$book_id'"))['name'];
                                                          
                                                          
                                                          ?>
                                                </td>
                                             
                                                  <td>
                                    <?php $consultant_id=$prod_item['consultant_id']; 
                                    echo mysqli_fetch_assoc(mysqli_query($conn,"select name,id from users where id='$consultant_id'"))['name'];
                                    
                                    ?>
                                                </td>
                                              
                                                   <td>
                                                    <?php echo $prod_item['consultant_price']; ?>
                                                </td>
                                                   <td>
                                                    <?php echo $prod_item['created_on']; ?>
                                                </td>
                                                   <td>
                                                 <span class="btn btn-info">Success</span>
                                                </td>
                                            </tr>
                                         
                                        <?php
                                           
                                        }

                                      if($_SESSION['role']==4){ ?>   <tr>                                           <th colspan="8" style="text-align: right;
    font-size: 25px;">Total Amount :- (&#x20b9; <?php echo mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(consultant_price) as total_amount FROM `consultant_slots`"))['total_amount'];  ?>) </th>
</tr>
<?php } 
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="colspan-8">No Record found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
<style>
  .modal-dialog-centered {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100% - 1rem);
  }
  .modal-dialog {
    max-width: 1000px;
    margin: 0 auto;
  }
</style>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!--         <h4 class="modal-title">Modal Header</h4> -->
      </div>
      <div class="modal-body text-center">
        <h1>Full screen Transparent Bootstrap Modal</h1>
        <p>FEEL FRREE TO GET YOUR MODAL CODE HERE FOLKS.</p>
        <a class="pre-order-btn" href="#">GET THE MODAL CODE</a>
      </div>
      <div class="modal-footer">
        <!--         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subscriptions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM `users` WHERE id='$id'";
      $query_run = mysqli_query($conn, $sql);
      $user = mysqli_fetch_assoc($query_run);
      ?>
      <form action="">
        <div class="modal-body">
          <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center">
          
                <img src="uploads/profile/logo.jpg" alt="Logo" style="width: 300px;
    height: 50px;
    border-radius: 0px;"/>
         
              
               <div class="mt-6 text-center">
              <h2 class="text-2xl font-bold">ORDER RECEIPT</h2>
              <p class="text-lg">Order Id: <span id="orderId"></span></p>
            </div>
            
            <div style="display: flex;
    justify-content: space-between;">
                <div class="mt-6">
              <h3 class="text-lg font-bold">Customer Details</h3>
              <p>Customer <span id="user_name"><?php echo $user['name']; ?></span></p>
              <p>Customer Noida</p>
              <!--<p>GST NO: 38DJF98F8F0DD9FF9</p>-->
            </div>
            
              <div class="text-right">
                <p>Registered Office: Kay Paper Deals Pvt Ltd.</p>
                <p>B-9, F/F, Housing society,</p>
                <p>N.D.S.E - 1 New Delhi -110049</p>
                <p>GST NO: 07AAJCK9436A1ZJ</p>
              </div>
         

           

            
</div>
            <table style="width:100%;">
              <thead class="bg-gray-100">
                <tr>
                  <th class="py-2 px-4 border-b border-gray-300">S.No.</th>
                  <th class="py-2 px-4 border-b border-gray-300">Product Name</th>
              
              <th class="py-2 px-4 border-b border-gray-300">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="py-2 px-4 border-b border-gray-300">1</td>
                  <td class="py-2 px-4 border-b border-gray-300"><span id="type"></span> Package</td>
             
               
                  <td class="py-2 px-4 border-b border-gray-300"><span class="amount"></span></td>
                </tr>
              </tbody>
              <tfoot>
               
                <tr>
                  <td colspan="4" class="py-2 px-4 text-right font-bold border-t border-gray-300">GST@18%</td>
                  <td class="py-2 px-4 border-t border-gray-300"><span id="gst"></span></td>
                </tr>
                <tr>
                  <td colspan="4" class="py-2 px-4 text-right font-bold border-t border-gray-300">Grand Total</td>
                  <td class="py-2 px-4 border-t border-gray-300"><span id="total"></span></td>
                </tr>
              </tfoot>
            </table>
            <input type="hidden" name="id" readonly class="form-control mb-2" id="user_id" value="<?php echo $user['id']; ?>">
            <div class="mt-6 text-center">
              <button style="background: #007bff;
    float: right;
    margin: 12px;" id="paynow" class="text-white py-2 px-4 rounded hover:bg-green-600">Create Order</button>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </form>
    </div>
  </div>
</div>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  $(".invoice").click(function()
{   
   $('#myModal').modal('show');

});

$(document).ready(function(){
 $(".close").click(function()
{    
   $('#exampleModalCenter').modal('hide'); 
});

$(".subscribe").click(function()
{    
var row = $(this).closest('tr');
var id = row.find('td:eq(0)').text().replace(/\s+/g, '');;
var name = row.find('td:eq(1)').text().replace(/\s+/g, '');;
var price = row.find('td:eq(2)').text().replace(/\s+/g, '');;
    var gst= price*18/100;
var total=parseInt(gst)+parseInt(price);
$.ajax({
                    url: 'create_order.php', // PHP script to handle the AJAX request
                    type: 'POST',
                    data: { amount: total },
                    success: function(response){
                       if(response!=""){
                       $('#orderId').text(response);
                       $('#type').text(name);
                       $('.amount').text(price);
                    
                       $('#gst').text(gst);
                       $('#total').text(total);
                       $('#exampleModalCenter').modal('show'); 
                      
                    }
                       
                    }
                });
});


 
 
$("#paynow").click(function(e) {
    e.preventDefault(); // Prevent default click behavior

    var user_name = $('#user_name').text();
    var user_id = $('#user_id').val();
    var orderId = $('#orderId').text();
    var amount = $('#total').text();
    var type = $('#type').text();   

    $.ajax({
        url: "subs.php",
        type: "POST",
        data: { amount: amount, user_id: user_id, orderId: orderId },
        success: function(data) {
            if(data == 1) {
                var options = {
                    "key": "rzp_live_DO7LHXvliR4pfX", // Enter the Key ID generated from the Dashboard
                    "currency": "INR",
                    "name": user_name, // Your business name
                    "description": "Subscription Transaction",
                    "image": "http://paperdeals.in/admin/uploads/profile/logo.jpg",
                    "order_id": orderId, // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "callback_url": "subscription_payment.php?type=" + type,
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            } else {
                console.log('Error in response:', data); // Add logging for error handling
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX error:', error); // Log AJAX errors
        }
    });
});




});

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>
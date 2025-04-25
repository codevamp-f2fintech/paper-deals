<?php
 if($_GET['vip']==1){
$vip=100;
}
if($_GET['veryfiy']==1){
$veryfiy=100;
}
$amount=$vip+$veryfiy;



include_once ('header.php');
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

$orderData = [
    'receipt'         =>'001',
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];


?>
<div class="content-wrapper">
    <div class="" style="margin:3% 1%">
       
    </div>
    <section class="content m-auto">
        <div class="col-md-2">
          
            <div class="card">
 <input type="text" class="form-control" id="razorpayOrderId" value="<?php echo $razorpayOrderId;  ?>">
  <input type="text" class="form-control" id="id" value="<?php echo $_GET['id'];  ?>">
    <input type="text" class="form-control" id="vip" value="<?php echo $_GET['vip'];  ?>">

      <input type="text" class="form-control" id="veryfiy" value="<?php echo $_GET['veryfiy'];  ?>">

                <div class="card-body">
                  <center><button class="btn btn-primary" id="buynow">Pay Now</button> </center>

            </div>
        </div>
</div>
</section>
</div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    

$("#buynow").click(function()
{

var Id=$("#id").val();
var vip=$("#vip").val();	
var veryfiy=$("#veryfiy").val();	

var razorpayOrderId = $("#razorpayOrderId").val();

// alert(razorpayOrderId);

var options = {
    "key": "rzp_test_6kMDCUQCCH4r0W", // Enter the Key ID generated from the Dashboard
     "currency": "INR",
    "name": 'TEST', //your business name
    "description": "VIP",
    "image": "https://demo.nuovasoft.in/giftnbag/admin/uploads/profile/logo.jpeg",
    "order_id": razorpayOrderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "vip_payment.php?id="+Id+"&vip="+vip+"&veryfiy="+veryfiy,
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
        "name": "Gaurav Kumar", //your customer's name
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000" //Provide the customer's phone number for better conversion rates 
    },
   
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);

 rzp1.open();
 e.preventDefault();
});
</script>





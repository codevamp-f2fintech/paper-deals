<!DOCTYPE html>
<html lang="en">
  <head>
        <?php
    require('components/meta.php');
    require('constants.php');
    ?>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQ</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>

  <?php include('components/header.php');
    include('connection/config.php');


    ?>
 <div class="container mx-auto px-4 mt-20">
    
 <h2 class="text-2xl font-bold text-center mb-4">Process Flow Direct Order</h2>
        <img src="assets/images/do.png" alt="Direct Order" style="width:100%;">
         <h2 class="text-2xl font-bold text-center mb-4 mt-10">Process Flow Paper Deal Order</h2>
        <img src="assets/images/pdo.png" alt="Paper Deal Order" style="width:100%;">
</div>
     <div class="container mx-auto px-4 mt-20 mb-10">
      

        <h2 class="text-xl font-bold text-center mb-5">FAQ</h2>
        <ul class="list-disc list-inside mb-4">
          <li class="font-bold">What Paper Deal Offers?</li>
           <p class="ml-5">Paper Deal offers deals and management of deals that can be harnessed by both buyer and seller</p>
            <li class="font-bold">How can buyer and seller list at Paperdeal?</li>
            <p class="ml-5">Just by registering one can get enrolled in the system and after due diligence entities are listed.</p>
            <li class="font-bold">Can I get audit support?</li>
            <p class="ml-5">Yes, one can interact with our seasoned consultants having tons of experience for suggestions and auditing purposes.</p>
        </ul>
            <p >For any enquiry or issue one can simply chat us on our whatsapp (given on home page) or write us at <a href="mailto:support@paperdeals.com">support@paperdeals.com</a></p>

       
    </div>

       
 <?php include('components/footer.php') ?>

  </body>
</html>

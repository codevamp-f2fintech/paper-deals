<?php  
include ('../connection/config.php');
$query = mysqli_query($conn, "Select * from demo where status=1");
$status=mysqli_fetch_assoc($query);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="data:image/jpeg;base64,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">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Payment Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #e1e7eb;
;

    padding: 30px 10px;
}

.card {
    max-width: 500px;
    margin: auto;
    color: black;
    border-radius: 20 px;
}

p {
    margin: 0px;
}

.container .h8 {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
}

.btn.btn-primary {
    width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
    border: none;
    transition: 0.5s;
    background-size: 200% auto;

}


.btn.btn.btn-primary:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}



.btn.btn-primary:hover .fas.fa-arrow-right {
    transform: translate(15px);
    transition: transform 0.2s ease-in;
}

.form-control {
    color: white;
    background-color: #dee2e6;
    border: 2px solid transparent;
    height: 60px;
    padding-left: 20px;
    vertical-align: middle;
}

.form-control:focus {
    color: white;
    background-color: #0C4160;
    border: 2px solid #2d4dda;
    box-shadow: none;
}

.text {
    font-size: 14px;
    font-weight: 600;
}

::placeholder {
    font-size: 14px;
    font-weight: 600;
}
    </style>
  </head>
  <body>
 <div class="container p-0">



        <div class="card px-4">  
        <?php if($status['status']==1){ ?>
        <button type="button" class="btn btn-success w-50 m-auto">Subscription Active</button>
         <?php } else { ?>
                <button type="button" class="btn btn-danger w-50 m-auto">Subscription Inactive</button>
                 <?php } ?>
            <p class="h8 py-3">Payment Details</p>
             <form action="update_status.php" name="myform" method="post">
            <div class="row gx-3">
               
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Person Name</p>
                        <input class="form-control mb-3" type="text" placeholder="Name" name="name" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Card Number</p>
                        <input class="form-control mb-3" type="text" placeholder="1234 5678 435678" name="card_no">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Expiry</p>
                        <input class="form-control mb-3" type="text" placeholder="MM/YYYY" name="expiry_date">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">CVV/CVC</p>
                        <input class="form-control mb-3 pt-2 " name="cvv" type="text" placeholder="***" maxlength="3" >
                          <input class="form-control mb-3 pt-2 " name="amount" type="hidden">
                    </div>
                </div>
                <div class="col-12">
                    <button  class="btn btn-primary mb-3" type="submit">
                   <span  <span aria-hidden="true" data-icon="&#xe000;" class="ps-3">Pay Now (INR. 1000)</span>
                        <span class="fa fa-arrow-right"></span>
                    </button >
                </div>
                
            </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
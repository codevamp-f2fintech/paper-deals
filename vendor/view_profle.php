<?php
session_start();
if (isset($_SESSION['role'])) {
    $book_id = $_SESSION['id'];
}

if (isset($_GET['search']))
    $search = $_GET['search'];
if (isset($_GET['state']))
    $state = $_GET['state'];

?>
<?php

require('admin/config.php');
require('admin/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);


?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<link rel="stylesheet" href="responsive.css">

<head>
    <?php
   
    require('components/meta.php');
    require('constants.php');
    include('connection/config.php');
    if (isset($_POST['enquiry_save'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $quality = mysqli_real_escape_string($conn, $_POST['quality']);
        $rd = mysqli_real_escape_string($conn, $_POST['rd']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $area = mysqli_real_escape_string($conn, $_POST['area']);
        $preference = mysqli_real_escape_string($conn, $_POST['preference']);
        $payment_terms = mysqli_real_escape_string($conn, $_POST['payment_terms']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $transportation_required = mysqli_real_escape_string($conn, $_POST['transportation_required']);
        $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

        $query = "insert into enquiry(name,phone,quality,rd,price,area,preference,payment_terms,quantity,transportation_required,remarks) values('$name','$phone','$quality','$rd','$price','$area','$preference','$payment_terms','$quantity','$transportation_required','$remarks')";

        $query_run = mysqli_query($conn, $query);
    }
    ?>
    <title>Business Enquiry -
        <?php echo site_name ?>
    </title>
    <!-- Button to trigger the modal -->
    <!-- The modal -->

</head>
<?php include('components/header.php'); ?>

<body>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">
                    <?php if ($_GET['role'] == 2) {
                        echo 'Seller';
                    } else if($_GET['role'] == 8){
                        echo 'Consultant';
                    }else{
                     echo 'Buyer';
                    } ?> Profile
                </h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="search.php">Search</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                  <?php if ($_GET['role'] == 2) {
                                                    echo 'Seller';
                                                }else if($_GET['role'] == 8){
                        echo 'Consultant';
                    } else {
                                                    echo 'Buyer';
                                                } ?>
                        Profile

                </ul>
            </div>
        </section>

        <!-- Search BOX -->
        <!-- <section class="text-gray-600 body-font bg-[url('assets/herobg.jpg')] bg-cover bg-bottom">
            <div class="w-full bg-[#0b08086e]">
                <div class="container mx-auto flex p-4 py-16 justify-center items-center leading-6">
                    <div class="lex-w-full md:w-80 w-full md:max-w-4xl flex flex-col gap-5 items-center text-center text-white">
                        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 flex flex-col gap-2 drop-shadow-lg"><span class="md:whitespace-nowrap">India's Largest Marketplace for</span> <span class="text-orange-400">PAPER DEALS</span></h1>


                    </div>
                </div>
            </div>
        </section> -->
        <style>
            #bb {
                background: #936d5b;
                color: #fff;
                padding: 5px 8px;
                border-radius: 3px;
                font-size: 14px;
                cursor: pointer;
            }

            .your-element {
                width: 80%;
                transform: translate(13%, 3%);
                margin: 106px 10px;
                padding: 56px 57px;
            }

            .your-element:hover {
                box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                background: #fdf8ed;
            }

            /*.detail {*/
            /*    transform: translate(33%, -1%);*/
            /*}*/

            /* Style for the table */
            table {
                border-collapse: collapse;
                width: 100%;
            }

            /* Style for table header cells */
            th {
                border: 1px solid #fff;
                padding: 8px;
                text-align: center;
              
                color: #fff;
            }

            /* Style for table data cells */
            td {
                border: 1px solid #dddddd;
                padding: 8px;
                text-align: center;
            }

            .chead {
                font-size: 27px;
                text-align: center;
                transform: translate(0%, -148%);
            }

            table {
                /*transform: translate(0%, -46%);*/
            }

            .shead {
                transform: translate(86%, -130%);
                font-size: 17px;
                border: 2px solid #fff;
                background: #ea580c;
                color: #fff;
                padding: 9px 18px;
            }
        </style>
        <?php
        if (isset($_GET['prod_id'])) {
            $product_id = $_GET['prod_id'];
            $role = $_GET['role'];
            //$query = "select * from organization where user_id='$product_id'";
            $query = "SELECT users.*,product_new.product_name,product_new.other,product_new.category_id,product_new.sub_product,product_new.quantity_in_kg,product_new.stock_in_kg,product_new.size,product_new.gsm,product_new.price_per_kg,product_new.shade, organization.organizations,product_new.weight, organization.address,organization.state,organization.production_capacity,organization.materials_used,organization.city,organization.pincode,organization.organization_type,organization.verified,organization.vip,organization.description,organization.image_banner
                FROM users 
                LEFT JOIN organization  ON users.id = organization.user_id 
                LEFT JOIN product_new  ON users.id = product_new.seller_id where users.id='$product_id'";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                $prod_item = mysqli_fetch_array($query_run);
                //  print_r($prod_item);
        ?>
                <!-- Search RESULTS -->
                <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                <div class="flex flex-col gap-10 w-[70%;] mx-auto view-prop">
                    <div class="flex flex-col md:flex-row rounded border gap-6 p-6  view-prop1">
                        <img src="<?php if ($prod_item['image_banner']) { ?>admin/<?= $prod_item['image_banner']; ?> <?php } else { ?>logo.jpg <?php } ?>" alt="alt" class="p-1 border  md:w-80 vew-prop-img" style="height:240px;object-fit:contain;">
                        <div class="flex flex-col gap-6 w-[100%]">
                            <h2 class="font-bold view-head">
                                <?php if($_GET['role']==2) { ?>
                                <?= 'PDS_'.$prod_item['id']; ?>
                                <?php }else { ?>
                                <?= 'PDB_'.$prod_item['id']; ?>

                                <?php  } ?>
                                
                            </h2>
                            <?php


                                                 $user_id = $prod_item['id'];
                                                $Vip_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$product_id' and type ='Vip' and status ='1'");
                                                $Verified_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$product_id' and type ='Verified' and status ='1'");
                                                ?>


                         
                            <div class="flex gap-2 md:items-center text-sm">
                                <?php if (mysqli_num_rows($Verified_run)>0) {
                                ?>
                                    <label class="bg-green-600 text-white font-bold rounded-full py-1 px-3"><i class="bi bi-patch-check-fill"></i>
                                        <?php echo " Verified"; ?>
                                    </label>
                                <?php
                                } else {
                                ?><label class="bg-red-600 text-white font-bold rounded-full py-1 px-3">
                                        <?php echo "Not Verified"; ?>
                                    </label>
                                <?php
                                } ?>
                                <?php if (mysqli_num_rows($Vip_run)>0) {
                                ?>
                                    <label class="bg-yellow-400 text-black font-bold rounded-full py-1 px-3
                                                ">
                                        <?php echo " VIP"; ?>
                                    </label>
                                <?php
                                } ?>
                            </div>
                            <div class="grid grid-cols-3 md:grid-cols-3 gap-4 md:gap-5">

                                <div>
                                    <h5 class="font-bold">City</h5>
                                    <p>
                                        <?= $prod_item['city']; ?>
                                    </p>
                                </div>
                                <div>
                                    <h5 class="font-bold">Area</h5>
                                    <p>
                                        <?= $prod_item['city'] . ", " . $prod_item['district'] . " " . $prod_item['pincode']; ?>
                                    </p>
                                </div>
                                <div>
                                    <h5 class="font-bold">State</h5>
                                    <p>
                                        <?php $id = $prod_item['state'];
                                        $query = "select state_name from state_list where state_id=$id";
                                        $query_run = mysqli_query($conn, $query);
                                        $state = mysqli_fetch_assoc($query_run);
                                        echo $state['state_name']; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 md:grid-cols-3 gap-4 md:gap-5">




                                <div>
                                    <h5 class="font-bold">Productions Capacity</h5>
                                    <p>
                                        <?= $prod_item['production_capacity'] ?>
                                    </p>
                                </div>

                                <div>
                                    <h5 class="font-bold">Deals in</h5>
                                    <p>
                                        <?php if ($prod_item['category_id'] == 1) {
                                            echo "Craft";
                                        } else if ($prod_item['category_id'] == 2) {
                                            echo "duplex";
                                        } else if ($prod_item['category_id'] == 3) {
                                            echo "tissue";
                                        } else if ($prod_item['category_id'] == 4) {
                                            echo "copyer";
                                        } ?>
                                    </p>
                                </div>
                                <div>
                                    <h5 class="font-bold">Materials Used</h5>
                                    <p>
                                        <?= $prod_item['materials_used'] ?>
                                    </p>
                                </div>

                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-1 md:gap-8">

                                <div>
                                    <h5 class="font-bold">Discriptions</h5>
                                    <p style="text-align: justify;">
                                        <?= $prod_item['description']; ?>
                                    </p>
                                </div>
                            </div>




                        </div>
                    </div>
                    
                </div>
                        <div class="flex flex-col md:flex-row justify-center	 w-[100%;] mb-10">
                        <?php if ($role == 2) { ?>
                            <div class="grid grid-cols-1 md:grid-cols-1 md:gap-8 m-3">
                                <a href="enquiry.php?role=2&prod_id=<?php echo $prod_item['id']; ?>" class="py-2 px-3 rounded-md  text-white" style="width:130px;text-align:center; margin:auto; background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">Enquiry
                                    Now</a>
                            </div>
                        <?php } ?>
                    </div>

                <div class="flex flex-col md:flex-row w-[70%;] m-auto">
                    <table class="my-8">
                        <thead>
                            <tr style="  background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">
                                <th>Category</th>
                                <th>Product</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product_id = $_GET['prod_id'];
                            $query = "select product_name,sub_product,category_id from product_new where seller_id=$product_id";
                            $query_run = mysqli_query($conn, $query);

                            while ($product = mysqli_fetch_assoc($query_run)) {

                            ?>
                                <tr>
                                    <td><?php echo $product['category_id']; ?></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>



                </div>



                </div>
            <?php } ?>

            <?php
        }



        if (isset($_GET['consult_id'])) {
            $product_id = $_GET['consult_id'];
            $query = " SELECT users.*, consultant_pic.prof_pic , consultant_pic.description,consultant_pic.years_of_experience,consultant_pic.mills_supported
            FROM users 
            LEFT JOIN consultant_pic ON users.id = consultant_pic.user_id 
            WHERE
            users.id='$product_id'";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                $prod_item = mysqli_fetch_array($query_run);
            ?>
                <!-- Search RESULTS -->

                <input type="hidden" name="user_id" value="<?= $prodItem['id'] ?>"></input>
                <div class="flex flex-col gap-6" >
                    <div class="flex flex-col md:flex-row md:items-center justify-center  container mx-auto rounded py-10 gap-12 poppp "  >
                        <img src="<?php if ($prod_item['prof_pic']) { ?>admin/<?= $prod_item['prof_pic']; ?> <?php } else { ?>logo.jpg <?php } ?>" alt="alt" class="p-1  w-96 md:w-80" style= "  height: 100%;object-fit:contain;">
                        <div class="flex flex-col gap-3 detail">
                            <h2 class="text-lg lg:text-xl font-bold">
                                <?= $prod_item['name']; ?>
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-bold">Status</h5>
                                    <p cla>
                                        <?php if ($prod_item['active_status'] == 1) {
                                            echo '<span class="badge bg-success">Active</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Inactive</span>';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                         
                            
                            
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-bold">Years of Experience</h5>
                                    <p style="text-align: justify;">
                                        <?= $prod_item['years_of_experience']; ?>
                                    </p>
                                </div>
                            </div>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-bold">Mills Supported</h5>
                                    <p style="text-align: justify;">
                                        <?= $prod_item['mills_supported']; ?>
                                    </p>
                                </div>
                            </div>
                               <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-bold">Created On</h5>
                                    <p>
                                        <?= $prod_item['created_on']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-bold">Description</h5>
                                    <p style="text-align: justify;">
                                        <?= $prod_item['description']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                      
                    </div>
                    <!-- <div><button class="shead">Slots Booking</button></div> -->   <h1 class=" text-center">Book Slots</h1>
              <div class="-col  mb-10 justify-center container  rounded  table-const" style="overflow-x: auto;">
                 
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="border: 1px solid #dddddd; padding: 8px 64px; text-align: center; background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff;">
                <th style="min-width: 150px;">From Time</th>
                <th style="min-width: 150px;">To Time</th>
                <th style="min-width: 150px;">From Date</th>
                  <th style="min-width: 150px;">Id</th>
                <th style="min-width: 150px;">To Date</th>
           

                <th style="min-width: 150px;">Consultant Price</th>
                
                <th style="min-width: 150px;">Availability</th>
                <th style="min-width: 150px;">Book Slots</th>
                <th style="min-width: 150px;">Chat Here</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM consultant_slots WHERE consultant_id = $product_id ORDER BY id DESC";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $prod_item) {
            ?>
                    <tr>
                        <td>
                            <?php
                            $sql = "SELECT * FROM slot WHERE id = $prod_item[slot_id]";
                            $slot_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($slot_run) > 0) {
                                $slot_item = mysqli_fetch_assoc($slot_run);
                                echo $slot_item['from_time'];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (isset($slot_item)) {
                                echo $slot_item['to_time'];
                            }
                            ?>
                        </td>
                        <td>
                            <?= $prod_item['created_on']; ?>
                        </td>
                         <td>
                            <?= $prod_item['id']; ?>
                        </td>
                        <td>
                            <?= $prod_item['to_date']; ?>
                        </td>
                        <td>
                            <?= $prod_item['consultant_price']; ?>
                        </td>
                        <td>
                            <?php if ($prod_item['status'] == 1) {
                                echo '<span class="badge" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); padding: 7px; font-size: 13px; color: #fff; border-radius: 8px;">Booked</span>';
                            } else {
                                echo '<span class="badge" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); padding: 7px; font-size: 13px; color: #fff; border-radius: 8px;">Slot Available</span>';
                            }
                            ?>
                        </td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;">
                            <?php if ($_SESSION['role'] != "" && $_SESSION['role'] != 5 && $_SESSION['role'] != 1 && $_SESSION['role'] != 4) { ?>
                             
                                    <button  class="bg-orange-500 text-white px-2" id="bb" <?php if ($prod_item['status'] == 1) { ?>style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);" disabled <?php } ?>>Book Slots</button>
                              
                            <?php } else { ?>
                                <button class="bg-orange-500 text-white p-1" id="uniqueModalBtn" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); font-size: 13px;">Book Slots</button>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($prod_item['status'] == 1 && $book_id == $prod_item['book_id']) { ?>
                                <a  class="py-1 bg-orange-500 text-white px-2" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff; padding: 5px 8px; border-radius: 3px; font-size: 14px; cursor: pointer;" href="<?php if($_SESSION['id']){ ?>admin/userchat.php?id=<?php echo $_SESSION['id']; ?> <?php } else { ?>admin_login.php?type=anyone <?php } ?>">Chat Consultant</a>
                            <?php } else { ?>
                                <a href="<?php if($_SESSION['id']){ ?>admin/userchat.php?id=<?php echo $_SESSION['id']; ?> <?php } else { ?>admin_login.php?type=anyone <?php } ?>" class="py-2 bg-orange-500 text-white px-2" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff; padding: 5px 8px; border-radius: 3px; font-size: 14px; cursor: pointer;">You <?php if($_SESSION['id']){ ?> can <?php } else { ?> Cannot<?php  } ?> Chat</a>
                            <?php } ?>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="8" class="dataTables_empty">No Record found</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

                </div>
        <?php
            }
        }

        if (isset($_GET['opnepopup'])) {
        }

        ?>
        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a
                    solution
                    meeting your budget and requirement </p>
                <div class="flex gap-2">
                    <a href="buyer" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-cart-check-fill"></i> Buyers</a>
                    <a href="seller" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-shop-window"></i> Sellers</a>
                </div>
            </div>

        </section>
    </main>


    <?php include('components/footer.php') ?>
    <!-- <a href="javascript:void(0);" type="hidden" id="uniqueModalBtn"></a> -->
</body>

<style>
    /* Global Styles */
*,
*:before,
*:after {
  box-sizing: border-box;
}



/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-contents {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 90%;
  max-width: 500px;
  border-radius: 8px;
  position: relative;
  top: 10%;
  transform: translateY(-10%);
}

/* Close Button Styles */
.modal-contents .close {
  font-size: 20px;
  position: absolute;
  right: 15px;
  top: 15px;
  width: 35px;
  height: 35px;
  background: #000;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  cursor: pointer;
}

.modal-contents h2 {
  font-size: 24px;
  border-left: 3px solid #ea580c;
  padding-left: 15px;
  color: #000;
  /*margin-bottom: 20px;*/
  font-weight: 500;
}

.form-control {
  width: 100%;
  height: 50px;
  padding: 0 10px;
  /*margin-bottom: 20px;*/
  border: 1px solid #ea580c;
  border-radius: 5px;
}

.btn {
    width: 100%;
    height: 40px;
    background: #035793;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.card-body {
  padding: 20px;
}

.relative {
  margin-bottom: 10px;
}
@media (max-width: 600px) {
      .poppp{
      /*border:5px solid red !important;*/
      width:98% !important;
      padding:4%;
      margin-bottom:18%;
  }
    .poppp img{
      /*border:5px solid red !important;*/
      width:98% !important;
      margin:auto;
  }
  .table-const{
      /*border:4px solid;*/
      padding:0 !important;
      width:98%;
      margin:auto !important;
  }
  
}
/* Responsive Styles */
@media (min-width: 600px) {
  .modal-contents {
    width: 60%;
    max-width: 500px;
  }
  .poppp{
      /*border:5px solid red !important;*/
      width:98% !important;
          /*margin-bottom:7%;*/
  }
  
  
  
  
}

@media (min-width: 768px) {
  .modal-contents {
    width: 50%;
    max-width: 500px;
  }
}

@media (min-width: 992px) {
  .modal-contents {
    width: 40%;
    max-width: 500px;
  }
}

@media (min-width: 1200px) {
  .modal-contents {
    width: 30%;
    max-width: 500px;
  }
}

</style>
<!-- The unique modal -->
<!-- The unique modal -->
<div id="uniqueModal" class="modal">
  <!-- Modal content -->
  <div class="modal-contents">
    <span class="close">&times;</span>
    <h2>Booking Slot</h2>
    <div class="card">
      <div class="card-body">
        <form action="admin/code.php" method="post">
          <div class="row">
            <div class="relative form-group">
              <label>Join As</label>
              <select id="type" name="user_type" value="6" class="form-control" required>
                <option value="6" name="user_type">Anyone</option>
              </select>
            </div>
            <div class="relative form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required placeholder="Enter Name">
            </div>
            <div class="relative form-group">
              <label>Email ID</label>
              <input type="email" name="email_address" class="form-control" required placeholder="Email ID" autocomplete="off">
            </div>
            <div class="relative form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required placeholder="Enter Password" autocomplete="off">
            </div>
            <div class="relative form-group">
              <label>Phone</label>
              <input type="phone" name="phone_no" onKeyPress="if(this.value.length==10) return false;" id="phone" class="form-control" required placeholder="Enter Phone">
            </div>
            <div class="relative form-group">
              <button type="submit" name="new_sssa" class="btn">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-check" style="font-size:48px;color:green"></i>

                </div>


                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <h1 style="color:black;font-size:18px;">Your Slot Booked Successfully</h1>

            </div>

        </div>
    </div>
</div>
<style>

  .mymodal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }
        .form-group{
            width:100%;
        }
</style>
</style>
<div id="payment-modal" class="mymodal flex items-center justify-center">

  <!-- Modal content -->
  <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-full max-w-md flex flex-col h-[100%]">
    <div class="close form-group text-gray-500 float-right text-2xl font-bold cursor-pointer" style="
    position: absolute;
    top: 55px;
    left: 96%;">&times;</div>
   <div> <h2 class="text-xl form-group font-bold mb-4">Payment Form</h2></div>
    <div class="form-group mb-4">
        <label for="username" class="block text-gray-700">User Name:</label>
        <input type="text" id="username" name="username" value="<?php $id=$_SESSION["id"]; $res=mysqli_query($conn,"Select * from users where id='$id'");
        echo mysqli_fetch_assoc($res)['name'];
        ?>" class="w-full px-3 py-2 border rounded">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["id"] ?>" >
                                <input type="hidden" id="consult_id" name="consult_id" value="">

    </div>
    <div class="form-group mb-4">
        <label for="invoice" class="block text-gray-700">Invoice Number:</label>
        <input type="text" id="orderId" name="invoice" value="" class="w-full px-3 py-2 border rounded">

    </div>
 
      
     


    <div class="form-group mb-4">
        <label for="consultant" class="block text-gray-700">Consultant:</label>
        <input type="text" id="consultant" name="consultant" value="<?php $consult_id=$_GET["consult_id"]; $consultres=mysqli_query($conn,"Select * from users where id='$consult_id'");
        echo mysqli_fetch_assoc($consultres)['name']; ?>" class="w-full px-3 py-2 border rounded">
        
    </div>
    <div class="form-group mb-4">
        <label for="price" class="block text-gray-700">Price:</label>
        <input type="text" id="amount" name="price" value="$100.00" class="w-full px-3 py-2 border rounded">
    </div>
    <button id="payBtn" class="w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">
        Pay
    </button>
  </div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
$(document).ready(function(){
    // Get the modal
    var payment = $("#payment-modal");

    // Open the modal when the button is clicked
    $("#bb").click(function(){

    var row = $(this).closest('tr');
    var price = row.find('td:eq(5)').text().replace(/\s+/g, '');
   var consult_id = row.find('td:eq(3)').text().replace(/\s+/g, '');
        $.ajax({
                    url: 'create_order.php',
                    type: 'POST',
                    data: {amount: price},
                      success: function(response){
                        
                      $('#orderId').val(response);
                        $('#consult_id').val(consult_id);
                      $('#type').val(name);
                      $('#amount').val(price);
                        payment.show();
                     }
                });

      
    });

    // Close the modal when the 'x' is clicked
    $(".close").click(function(){
        payment.hide();
    });

    // Close the modal when clicking outside the modal content
    $(window).click(function(event){
        if ($(event.target).is(modal)) {
            payment.hide();
        }
    });

    // Handle Pay button click
$("#payBtn").click(function(){
var consult_id = $('#consult_id').val();
var user_id = $('#user_id').val();
var orderId = $('#orderId').val();
var amount = $('#amount').val();


$.ajax({
                      url: "slotbooking.php",
                        type: "POST",
                        data: {amount:amount,user_id:user_id,consult_id:consult_id,orderId,orderId},
                        success: function(data) {
                        // alert(data);
                if (data == 1) {
    var options = {
        "key": "rzp_test_6kMDCUQCCH4r0W",
        "currency": "INR",
        "name": "Paper Deals", 
        "description": "Consultant Booking",
        "image": "http://paperdeals.in/admin/uploads/profile/logo.jpg",
        "order_id": orderId, 
        "callback_url": "bookedconsultant.php"
    };

    var rzp1 = new Razorpay(options);

    rzp1.open();

   
    
}
         
         
        }
});
    });
});
</script>

<script>
    var param1var = getQueryVariable("openpopup");

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }


    }
</script>
<script>
  // Get the modal
  var modal = document.getElementById("uniqueModal");

  // Get the button that opens the modal (you need to add this button)
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal
  btn.onclick = function () {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
    // JavaScript code to control the unique modal behavior
    var uniqueModal = document.getElementById("uniqueModal");
    var uniqueModalBtn = document.getElementById("uniqueModalBtn");
    var uniqueModalClose = uniqueModal.getElementsByClassName("close")[0];

    // Function to open the unique modal
    uniqueModalBtn.onclick = function() {
        uniqueModal.style.display = "block";
    }


    // Function to close the unique modal
    uniqueModalClose.onclick = function() {
        uniqueModal.style.display = "none";
    }

    // Function to close the unique modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == uniqueModal) {
            uniqueModal.style.display = "none";
        }
    }

    var param1var = getQueryVariable("openpopup");

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                uniqueModal.style.display = "block";
                return pair[1];
            }
        }


    }
</script>


</html>
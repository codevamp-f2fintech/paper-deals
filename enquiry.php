<?php session_start();
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

?>
<?php
if (isset($_GET['search']))
    $search = $_GET['search'];
if (isset($_GET['state']))
    $state = $_GET['state'];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    // ini_set('display_errors', 0);
    // ini_set('display_startup_errors', 0);
    error_reporting(0);
    require('components/meta.php');
    require('constants.php');
    include('connection/config.php');

    ?>
    <title>Business Enquiry -
        <?php echo site_name ?>
    </title>
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <?php include('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Business Enquiry</h1>
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
                    <p>Business Enquiry</p>

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


        <?php
        if (isset($_GET['prod_id'])) {
            $product_id = $_GET['prod_id'];
            //$query = "select * from organization where user_id='$product_id'";
            $query = "SELECT users.*, organization.organizations, organization.address,organization.state,organization.production_specification,organization.organization_type,organization.verified,organization.vip,organization.image_banner
                FROM users 
                LEFT JOIN organization  ON users.id = organization.user_id where users.id='$product_id'";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                $prodItem = mysqli_fetch_array($query_run);
        ?>
                <!-- Search RESULTS -->
                <form method="post">
                    <input type="hidden" name="user_id" value="<?= $prodItem['id'] ?>"></input>
                    <section class="enqurysection">
                        <div class="container">
                            <div class="enkry_box">
                                <div class="sell info">
                                    <?php if (isset($_POST['enquiry_save'])) {
                                        ini_set('display_errors', 1);
                                        ini_set('display_startup_errors', 1);
                                        error_reporting(0);
                                        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
                                        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
                                        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
                                        $product = mysqli_real_escape_string($conn, $_POST['product']);
                                        $name = mysqli_real_escape_string($conn, $_POST['name']);
                                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                                        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                                        $city = mysqli_real_escape_string($conn, $_POST['city']);
                                        $mill = mysqli_real_escape_string($conn, $_POST['seller']);
                                        $shade = mysqli_real_escape_string($conn, $_POST['shade']);
                                        $gsm = mysqli_real_escape_string($conn, $_POST['gsm']);
                                        $rim = mysqli_real_escape_string($conn, $_POST['rim']);
                                        $sheat = mysqli_real_escape_string($conn, $_POST['sheat']);
                                        $brightness = mysqli_real_escape_string($conn, $_POST['brightness']);
                                        $bf = mysqli_real_escape_string($conn, $_POST['bf']);
                                        $size = mysqli_real_escape_string($conn, $_POST['size']);
                                        $b_id = mysqli_real_escape_string($conn, $_POST['b_id']);
                                        $weight = mysqli_real_escape_string($conn, $_POST['weight']);
                                        $stock_in_kg = mysqli_real_escape_string($conn, $_POST['stock_in_kg']);
                                        $quantity_in_kg = mysqli_real_escape_string($conn, $_POST['quantity_in_kg']);
                                        $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
                                        $created_at=date("Y-m-d h:i:s");
                                        // echo "<pre>";
                                        //                                         print_r($_POST);
                                        // exit;
                                        $query = "insert into enquiry(category_id,company_name,product,name,phone,city,shade,gsm,size,weight,quantity_in_kg,remarks,user_id,buyer_id,email,rim,sheat,brightness,bf,created_at) values('$category_id','$company_name','$product','$name','$phone','$city','$shade','$gsm','$size','$weight','$quantity_in_kg','$remarks','$user_id','$b_id','$email','$rim','$sheat','$brightness','$bf','$created_at')";
                                        //echo $query;
                                        // exit;
                                        $query_run = mysqli_query($conn, $query);

                                        if ($query_run) {
                                    ?>
                                                     <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50  text-green-400" role="alert">
  <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div class="ms-3 text-sm font-medium">
  We have recieved your enquiry, soon we will contact you.
  </div>
  <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8  " data-dismiss-target="#alert-3" aria-label="Close">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
  </button>
</div>
                                        <?php
                                        } else { ?>
                                            <div class="alert alert-danger">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                                                <p class="mb-2"><strong>Message</strong></p>

                                                <hr>
                                                <p class="mt-2">Data Not inserted Due to some error</p>

                                            </div>
                                    <?php }
                                    } ?>
                                    <div class="header">
                                        <h3>Profile Information</h3>
                                    </div>
                                    <div class="media">
                                        <div class="mp"><img src="<?php if ($prod_item['image_banner']) { ?>admin/<?= $prod_item['image_banner']; ?> <?php } else { ?>logo.jpg <?php } ?>" alt="alt" height="80">
                                        </div>
                                        <div class="m_data">
                                            <h3>
                                                KPDS_<?= $prodItem['id']; ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="sell enkfrm">
                                    <div class="head">
                                        <h3>Business Enquiry</h3>
                                    </div>

                                    <div class="enkryfrm  enquriy-table">
                                        

                                        <?php
                                       
                                        if ($_SESSION['role'] != 2) {
                                            $id = $_SESSION['id'];
                                      
                                            $query = mysqli_query($conn, "SELECT * FROM `users` join organization on organization.user_id=users.id WHERE users.id='$id'");
                                            $buyer = mysqli_fetch_assoc($query);
                                        
                                        }

                                        ?>
                                        <div class="form-group">
                                            <label for="name">Company</label>
                                            <input required type="text" name="company_name" value="<?php if ($buyer['organizations']) {
                                                                                                        echo $buyer['organizations'];
                                                                                                    } else {
                                                                                                        echo '';
                                                                                                    } ?>" id="name" class="form-control" placeholder="Company Name">
                                            <input type="hidden" name="b_id" value="<?php if ($_SESSION['id']) {
                                                                                        echo $_SESSION['id'];
                                                                                    } else {
                                                                                        echo '';
                                                                                    } ?>">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="name">Contact Person</label>
                                            <input required type="text" name="name" value="<?php if ($buyer['contact_person']) {
                                                                                                echo $buyer['contact_person'];
                                                                                            } else {
                                                                                                echo '';
                                                                                            } ?>" id="name" class="form-control" placeholder="Contact Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Mobile No.</label>
                                            <input required type="text" name="phone" onKeyPress="if(this.value.length==10) return false;" value="<?php if ($buyer['phone']) {
                                                                                                                                                        echo $buyer['phone'];
                                                                                                                                                    } else {
                                                                                                                                                        echo '';
                                                                                                                                                    } ?>" id="phone" class="form-control" placeholder="Contact Name.">
                                        </div>
                                        
                                                 <div class="form-group">
                                            <label for="phone">Email</label>
                                            <input required type="email" name="email" value="<?php if ($buyer['email']) {
                                                                                                                                                        echo $buyer['email'];
                                                                                                                                                    } else {
                                                                                                                                                        echo '';
                                                                                                                                                    } ?>"  class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">City</label>
                                            <input required type="text" name="city" class="form-control" placeholder="City">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="phone">Seller</label>
                                            <input required type="text" name="seller" class="form-control" placeholder="Seller">
                                        </div> -->

                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category_id" required="">
                                                <option value="">--Select Category--</option>
                                                <?php
                                                $query = mysqli_query($conn, "Select * from new_category where status=1");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $row['id'] ?>">
                                                        <?= $row['name'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label for="phone">Product</label>
                                            <input type="text" name="product" class="form-control" placeholder="Product">
                                        </div>
                                          <div class="form-group">
                                            <label for="phone">GSM</label>
                                            <input type="text" name="gsm" class="form-control" placeholder="GSM">
                                        </div>
                                          <div class="form-group">
                                            <label for="phone">BF</label>
                                            <input type="text" name="bf" class="form-control" placeholder="BF">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Shade</label>
                                            <input type="text" name="shade" class="form-control" placeholder="Shade">
                                        </div>
                                      <div class="form-group">
                                            <label for="phone">Brightness</label>
                                            <input type="text" name="brightness" class="form-control" placeholder="Brightness">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Rim</label>
                                            <input type="text" name="rim" class="form-control" placeholder="Rim">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Sheet</label>
                                            <input type="text" name="sheat" class="form-control" placeholder="Sheet">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Size in inch</label>
                                            <input type="text" name="size" class="form-control" placeholder="Size">
                                        </div>
                                        
                                        <!-- <div class="form-group">
                                            <label for="phone">Stock in Kg</label>
                                            <input required type="text" name="stock_in_kg" class="form-control"
                                                placeholder="Stock in Kg">
                                        </div> -->

                                        <div class="form-group">
                                            <label for="phone">Quantity in Kg</label>
                                            <input required type="text" name="quantity_in_kg" class="form-control" placeholder="Quantity in Kg">
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea cols="2" row="2" name="remarks" id="remarks" class="form-control" placeholder="Remarks" style="resize:none; outline:none; height:43px;"></textarea>
                                        </div>

                                        <div class="form-button  mt-5">
                                            <button type="submit" name="enquiry_save" class="btn rounded-md">Send
                                                Enquiry</button>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                    </section>

                </form>
        <?php
            }
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
</body>

</html>
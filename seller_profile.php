<?php session_start();
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
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require ('components/meta.php');
    require ('constants.php');
    include ('connection/config.php');
    ?>
    <title>Price -
        <?php echo site_name ?>
    </title>
</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Price</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="search.php">Search</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="seller_profile.php">Price</a>

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

        .detail {
            transform: translate(33%, -1%);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            border: 1px solid #fff;
            padding: 8px;
            text-align: center;
            color: #000;
        }

        td {
            border: 1px solid #dddddd;
            /*padding: 8px;*/
            text-align: center;
        }

        .chead {
            font-size: 27px;
            text-align: center;
            transform: translate(0%, -148%);
        }

        /*table {*/
        /*    transform: translate(0%, -46%);*/
        /*}*/

        .shead {
            transform: translate(86%, -130%);
            font-size: 17px;
            border: 2px solid #fff;
            background: #ea580c;
            color: #fff;
            padding: 9px 18px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        #customers {
            width: 100%;
            border-collapse: collapse;
        }

        #customers th, #customers td {
            border: 1px solid whitesmoke;
            /*padding: 8px;*/
            /*height: 50px;*/
            font-size: 15px;
            font-family: sans-serif;
            white-space: nowrap;
            text-align: center;
        }

        #customers th {
           /*padding-top: 126px;*/
           /* padding-bottom: 12px;*/
            /*background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);*/
            color: #fff;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #eeeeee;
        }

        @media (max-width: 1200px) {
            .table-container {
                overflow-x: auto;
            }

            #customers th, #customers td {
                min-width: 100px;
            }
        }
    </style>
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "SELECT * FROM spot_price WHERE id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prod_item = mysqli_fetch_array($query_run);
            $last_date = $prod_item['created_at'];
            ?>
            <!-- Display product details -->
            <div class="container mt-3">
                <div class="row">
                    <div class="col-12 pt-5 pb-5">
                        <h1 class="h4" style="text-align:center;font-size:31px"><b>Price</b></h1>
                        <p style="text-align:center;font-size:13px;margin-bottom:20px;">Last Update <?php echo $last_date; ?></p>
                        <br>
                        <div class="table-container w-full">
                            <table class="table table-striped border" id="customers">
                                <thead>
                                    <tr style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">
                                        <th>Location</th>
                                        <th>Type of Seller</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>BF</th>
                                        <th>GSM</th>
                                        <th>Shade</th>
                                        <th>Size (in Inch)</th>
                                        <th>Weight in Kg</th>
                                        <th>Stock in Kg</th>
                                        <th>Price Per Kg</th>
                                        <th>Quantity in Kg</th>
                                        <th>Other</th>
                                        <th>Enquiry</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT spot_price.*, product_new.id as p_id, product_new.seller_id as s_id, product_new.product_name, 
                                            product_new.category_id, product_new.bf, product_new.shade, product_new.gsm, product_new.weight, 
                                            product_new.stock_in_kg, product_new.quantity_in_kg, product_new.other, product_new.size, 
                                            users.name, organization.organization_type, organization.city 
                                            FROM `spot_price` 
                                            LEFT JOIN product_new ON product_new.id=spot_price.product_id 
                                            LEFT JOIN users ON users.id=product_new.seller_id 
                                            LEFT JOIN organization ON product_new.seller_id=organization.user_id 
                                            WHERE spot_price.status='1' AND spot_price.id='$product_id'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $prod_item) {
                                            ?>
                                            <tr>
                                                <td><?php echo $prod_item['city']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($prod_item['organization_type'] == 0) {
                                                        echo "Private";
                                                    } else if ($prod_item['organization_type'] == 1) {
                                                        echo "Proprietorship";
                                                    } else if ($prod_item['organization_type'] == 2) {
                                                        echo "LLP (Limited Liability Partnership)";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $prod_item['category_id']; ?></td>
                                                <td><?php echo $prod_item['product_name']; ?></td>
                                                <td><?php echo $prod_item['bf']; ?></td>
                                                <td><?php echo $prod_item['gsm']; ?></td>
                                                <td><?php echo $prod_item['shade']; ?></td>
                                                <td><?php echo $prod_item['size']; ?></td>
                                                <td><?php echo $prod_item['weight']; ?></td>
                                                <td><?php echo $prod_item['stock_in_kg']; ?></td>
                                                <td><?php echo $prod_item['spot_price']; ?> ₹</td>
                                                <td><?php echo $prod_item['quantity_in_kg']; ?></td>
                                                <td>
                                                    <button style="border:none; background-color:transparent; color:#007BFF" value="<?php echo $prod_item['other']; ?>" class="read-more"><i class="fa fa-eye"></i></button>
                                                </td>
                                                <td>
                                                    <a class="text-white" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff; padding: 5px 8px; border-radius: 3px; font-size: 14px; cursor: pointer;" href="spot_price_enquiry.php?role=2&prod_id=<?php echo $prod_item['id']; ?>">Enquiry Now</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="14" class="dataTables_empty">No Record found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    if (isset($_GET['consult_id'])) {
        $product_id = $_GET['consult_id'];
        $query = "select * from add_consultant where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prod_item = mysqli_fetch_array($query_run);
            ?>
            <!-- Display consultant details -->
            <div class="flex flex-col gap-10">
                <div class="flex flex-col md:flex-row md:items-center rounded gap-28 p-24" style="transform: translate(5%,2%);">
                    <img src="admin/<?= $prod_item['consultant_image']; ?>" alt="alt" class="p-1 border w-96 md:w-80">
                    <div class="flex flex-col gap-3 detail">
                        <h2 class="text-lg lg:text-xl font-bold"><?= $prod_item['name']; ?></h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                            <div>
                                <h5 class="font-semibold">Address</h5>
                                <p><?= $prod_item['address']; ?></p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                <div>
                                    <h5 class="font-semibold">Experience</h5>
                                    <p><?= $prod_item['experience']; ?></p>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Specialization</h5>
                                    <p><?= $prod_item['specialization']; ?></p>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Contact No</h5>
                                    <p><?= $prod_item['mobile']; ?></p>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Email</h5>
                                    <p><?= $prod_item['email']; ?></p>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Website</h5>
                                    <p><?= $prod_item['website']; ?></p>
                                </div>
                            </div>
                        </div>
                        <a class="p-3 rounded bg-primary hover:bg-blue-600" href="consultant_enquiry.php?consult_id=<?= $prod_item['id']; ?>">
                            Enquiry Now
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div
                class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a
                    solution
                    meeting your budget and requirement </p>
                <div class="flex gap-2">
                    <a href="buyer"
                        class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i
                            class="bi bi-cart-check-fill"></i> Buyers</a>
                    <a href="seller"
                        class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i
                            class="bi bi-shop-window"></i> Sellers</a>
                </div>
            </div>
        </section>

    </main>

    <style>
    /*body {*/
    /*  margin: 0;*/
    /*  padding: 0;*/
    /*  font-family: Arial, sans-serif;*/
    /*  background: linear-gradient(120deg, #a1c4fd, #c2e9fb);*/
    /*  height: 100vh;*/
    /*  display: flex;*/
    /*  justify-content: center;*/
    /*  align-items: center;*/
    /*}*/

    .popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
    }

    .popup__content {
      position: relative;
      width: 50%;
      max-width: 600px;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      text-align: left;
      animation: fadeIn 0.3s ease-in-out;
    }

    .popup__content h1 {
      margin-top: 0;
    }

    .close {
      position: absolute;
     top: 60px;
    right: 53px;
      font-size: 18px;
      cursor: pointer;
      color: #333;
    }

    .x:hover {
      color: grey;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
    .x {
		filter: grayscale(1);
		border: none;
		background: none;
		position: absolute;
		top: 10px;
		right: 10px;
		transition: ease filter, transform 0.3s;
		cursor: pointer;
		transform-origin: center;
		&:hover {
			filter: grayscale(0);
			transform: scale(1.1);
		}
  </style>

  <section class="popup" id="popup" style=
  "border:4px solid !important;">
   
    <div class="popup__content">
      	<span  aria-label="close" id="closeBtn" class="x">❌</span>
   
      <p id="para"></p>
    
    </div>
  </section>

  <script>
    // Show the modal
    document.querySelector('.read-more').addEventListener('click', function() {
      var other = this.value;
      document.getElementById('para').textContent = other;
      document.getElementById('popup').style.display = 'flex';
    //   document.getElementById('popup').style.background = 'linear-gradient(120deg, #a1c4fd, #c2e9fb)';
    });

    // Close the modal
    document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('popup').style.display = 'none';
    });
  </script>



<!--=============================================================================-->
<!--<section class="popup">-->
<!--  <div class="popup__content">-->
<!--    <div class="close">-->
<!--      X-->
<!--    </div>-->
<!--<p id="para"></p>-->
<!--  </div>-->
<!--</section>-->

<!--<script>-->
<!--$(".read-more").click(function() {-->
<!--    var other = $(this).val();-->
    <!--// alert(other);-->
<!--    $('#para').text(other);-->
   
<!--  $(".popup").fadeIn(500);-->
<!--});-->
<!--$(".close").click(function() {-->
<!--  $(".popup").fadeOut(500);-->
<!--});-->
<!--</script>-->
    <?php include ('components/footer.php') ?>
</body>

</html>
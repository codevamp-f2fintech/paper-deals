<?php session_start();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    require ('components/meta.php');
    require ('constants.php');
    include ('connection/config.php');
    ?>
    <title>Live Stock-
        <?php echo site_name ?>
    </title>
        <style>
                            .fa {
    font-size: 16px;
 
}
                        </style>
</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
 
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Live Stock</h1>
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
                    <a href="spot_price.php">Live Stock</a>

                </ul>
            </div>
        </section>

        <style>
            #customers {

                /*border-collapse: collapse;*/
                width: 100%;
            }

            #customers td,
            #customers th {
                border: 1px solid whitesmoke;
                padding:0 8px;
                /*height: 50px;*/
                font-size: 15px;
                font-family: sans-serif;
            }

            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #customers tr:hover {
                background-color: #eeeeee;
            }

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                font-family: sans-serif;
                text-align: center;
                /* background-color: #dadada; */
                /*color: black;*/
            }
        </style>




        </style>

        <section>
                   <?php  if($_GET['success']==1){  ?>




                    
        <div class="alert alert-success succ" role="alert" style="width:300px;float:left;">
  We have recieved your enquiry, soon we will contact you.
</div>
<?php  } ?>
            <div class="container mt-3" >
                <div class="row">
                   

                        <style>
                            .HeaderSearch__globalSearchLanding--ompUH {
                                position: relative;
                                width: 700px;
                                height: 60px;
                                /* border:5px solid red; */
                            }

                            .HeaderSearch__searchFieldLanding--IAlyD {
                                display: flex;
                                justify-content: space-between;
                                ;
                                height: 57px;
                                align-items: center;
                                background-color: var(--white, #fff);
                                border-radius: 30px;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .1);
                                width: 100%;
                            }

                            .HeaderSearch__searchFieldContent--Ahi_w {
                                display: flex;
                                align-items: center;
                                 width: 100%;
                            height: 60px; */
                                margin-left: 1.6%;
                            }

                            .HeaderSearch__searchButton--Q1AFR {
                                background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
                                border-radius: 40px;
                                cursor: pointer;
                                font-size: 19px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: #fff;
                                padding: 16px 36px;
                                margin-left: -50px;
                                margin-right: 20px;
                                height: 47px;
                                margin: auto 0.6%;
                            }

                            .floating-button {
                                background-image: url("chat_bot_img.png");
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: cover;
                                position: fixed;
                                bottom: 20px;
                                box-shadow: 0 0 10px black;
                                right: 20px;
                                /* background-color: #ea580c; */
                                color: white;
                                border: none;
                                padding: 15px 25px;
                                /* text-align:center; */
                                border-radius: 50%;
                                cursor: pointer;
                                z-index: 1;
                                height: 60px;
                                width: 60px;
                                /* animation: echo 2s linear infinite; */

                                animation: wiggle 2s linear infinite;
                            }

                            @keyframes wiggle {

                                0%,
                                7% {
                                    transform: rotateZ(0);
                                }

                                15% {
                                    transform: rotateZ(-15deg);
                                }

                                20% {
                                    transform: rotateZ(10deg);
                                }

                                25% {
                                    transform: rotateZ(-10deg);
                                }

                                30% {
                                    transform: rotateZ(6deg);
                                }

                                35% {
                                    transform: rotateZ(-4deg);
                                }

                                40%,
                                100% {
                                    transform: rotateZ(0);
                                }
                            }




                            .HeaderSearch__searchFieldLanding--IAlyD input:focus {
                                outline: none;
                            }

                            @media only screen and (min-width: 300px) and (max-width: 574px) {









                                .slider_bx .head h1 {
                                    font-size: 25px;
                                }

                                .slider_bx .head h1 span {
                                    font-size: 23px;
                                }

                                .slider_bx .head p {
                                    font-size: 13px;
                                    margin-bottom: 2vh;
                                }

                                .abutsectn>.container>.head>h3 {
                                    font-size: 29px;
                                    ;
                                }

                                .abutsectn>.container>.head>p {
                                    font-size: 13px;
                                }


                                .abutsectn>.container>.abt_sctn {
                                    display: flex;

                                    flex-wrap: wrap;
                                    width: 100%;
                                    min-height: 20vh;
                                }

                                .abutsectn .abt_sctn .sell {
                                    margin: 1%;
                                    /* border: 1px solid blue; */
                                    margin-bottom: 2vh;
                                    width: 95%;

                                }

                                .abutsectn .abt_sctn .sell>.icon {
                                    width: 60px;
                                    height: 60px;
                                    align-content: center;
                                }

                                .abutsectn .abt_sctn .sell>.icon .bi {
                                    width: 25px;
                                    height: 20px;
                                    margin-bottom: 24px;
                                }

                                .abutsectn .abt_sctn .sell>.dtab p {
                                    font-size: 13px;
                                }

                                .hwwsection>.container>.head>h3>span {
                                    font-size: 23px;
                                }

                                .hwwsection>.container>.head p {
                                    font-size: 11px;
                                }

                                .hwwsection>.container>.hwwbx {
                                    display: flex;
                                    flex-wrap: wrap;
                                }

                                .hwwsection>.container>.hwwbx>.hwwrpt {
                                    width: 80%;

                                    margin: 1vh 10vw;
                                    height: 80%;
                                    padding: 10px 20px;

                                }

                                .hwwsection>.container>.hwwbx>.hwwrpt>.hwwda h3 {
                                    font-size: 20px;
                                    margin-bottom: 1.6%;
                                }

                                .hwwsection>.container>.hwwbx>.hwwrpt>.hwwda p {
                                    font-size: 11px;
                                }

                                .hwwsection>.container>.hwwbx>.hwwrpt .medai {
                                    width: 50px;
                                    height: 50px;

                                }

                                .tstmlsection>.container>.head h3 {
                                    font-size: 24px;
                                }

                                .tstmlsection>.container>.head p {
                                    font-size: 11px;
                                }

                                .tstmlsection>.container>.text>.booc {
                                    width: 96%;
                                    margin: auto;
                                }

                                .tstmlsection>.container>.text>.booc div p {
                                    font-size: 12px;
                                }

                                .tstmlsection>.container>.text>.booc div h2 {
                                    font-size: 14px;
                                }

                                .lnsection>.container>.head h3 {
                                    font-size: 24px;
                                }

                                .lnsection>.container>.ln_clmbx>.sellbx {
                                    width: 95%;
                                    margin: auto;
                                }

                                .lnsection>.container>.ln_clmbx>.sellbx .grow>a>span>span {
                                    font-size: 17px;
                                }

                                .lnsection>.container>.ln_clmbx>.sellbx .grow>p {
                                    font-size: 11.6px;
                                }

                                .lnsection>.container>.ln_clmbx>.sellbx .grow>button {
                                    width: 80px;
                                    height: 29px;
                                    font-size: 10px;
                                }



                                .bann>.hel>p {
                                    font-size: 12px;
                                }

                                .ftr_tag>.container>.pdsecrion>.media {
                                    width: 80px;
                                    height: 80px;
                                }

                                .ftr_tag>.container>.pdsecrion>.dt {
                                    width: 75%;
                                    margin-right: 2%;
                                }

                                .ftr_tag>.container>.pdsecrion>.dt p {
                                    font-size: 12px;
                                }

                                #contact>.container>.sell {
                                    width: 95%;
                                    margin: auto;
                                    /* border: 5px solid black; */
                                }

                                #contact>.container>.sell>.ftr_head>h3 {
                                    font-size: 15px;

                                }

                                #contact>.container>.sell>.fof>.iii>.bi {
                                    font-size: 11px;
                                }

                                #contact>.container>.sell>.fof>.iii>p {
                                    font-size: 11px;
                                }

                                #contact>.container>.sell>.fof>.num>.bi,
                                p {
                                    font-size: 11px;
                                }

                                #contact>.container>.sell>.fof>.mail>.bi,
                                p {
                                    font-size: 11px;
                                }



                                #contact>.container>.sell>.lii>ul>li>a {
                                    font-size: 11px;
                                }

                            }

                            @media only screen and (max-width: 575px) {
                                .HeaderSearch__globalSearchLanding--ompUH {
                                    width: 95%;
                                    height: 42px;
                                    margin: auto;

                                }

                                .HeaderSearch__searchFieldLanding--IAlyD {
                                    height: 40px;
                                }

                                .HeaderSearch__searchButton--Q1AFR {
                                    height: 35px;
                                    width: 90px;
                                    font-size: 16px;
                                }
                            }

                            @media only screen and (min-width: 576px) and (max-width: 767px) {
                                .HeaderSearch__globalSearchLanding--ompUH {
                                    width: 100%;
                                }
                            }

                            @media only screen and (min-width: 992px) and (max-width: 1199px) {
                                .HeaderSearch__globalSearchLanding--ompUH {
                                    width: 100%;
                                }
                            }

                            @media only screen and (min-width: 1200px) {
                                .HeaderSearch__globalSearchLanding--ompUH {
                                    width: 60%;
                                    margin: auto;
                                }
                            }
                        </style>

                        <?php   


                                                     if ($search_query == "Private") {
                                                        $search_query = 0;

                                                    } else if ($search_query == "Proprietorship") {
                                                        $search_query = 1;

                                                    } else if ($search_query == "LLP (Limited Liability Partnership)") {
                                                        $search_query = 2;

                                                    }
                                            $query = "SELECT spot_price.*,product_new.id as p_id, product_new.seller_id as s_id, product_new.product_name,product_new.category_id,product_new.bf, product_new.shade,product_new.gsm,product_new.weight,product_new.stock_in_kg,product_new.quantity_in_kg, product_new.other,product_new.size, users.name, organization.organization_type,organization.city FROM `spot_price` LEFT JOIN product_new on product_new.id=spot_price.product_id left JOIN users on users.id=product_new.seller_id LEFT JOIN organization on product_new.seller_id=organization.user_id
                                    WHERE (users.name LIKE '%$search_query%' OR product_new.product_name LIKE '%$search_query%' OR organization.city LIKE '%$search_query%' OR organization.organization_type LIKE '%$search_query%' OR product_new.category_id LIKE '%$search_query%')";
// echo   $query;
// exit;
                                            $query_run = mysqli_query($conn, $query);
                                           $date= mysqli_fetch_assoc($query_run);
                                          
                                           $last_date=$date['created_at'];

                                            ?>
                         <div class="col-12 pt-5 pb-5 mt-4">
                        <h1 class="h4" style="text-align:center;font-size:31px; color:#1078FF;"><b>Live Stock</b></h1>
                        <p style="text-align:center;font-size:13px">Last Update <?php echo $last_date;  ?> </p>
                        <br>
                        <form action="" method="POST">

                        <div class="HeaderSearch__globalSearchLanding--ompUH mt-4  w-[300px] ">
                            <div class="HeaderSearch__searchFieldLanding--IAlyD searchFieldLanding border">
                                <div class="HeaderSearch__searchFieldContent--Ahi_w">
                                    <div style="margin:3px 8px;">
                                        <i class="material-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M15.8 14.8L11.6 10.6C12.6 9.4 13.1 8 13.1 6.5C13.1 2.9 10.2 0 6.6 0C2.9 0 0 2.9 0 6.5C0 10.1 2.9 13 6.5 13C8 13 9.4 12.5 10.6 11.5L14.8 15.7C14.9 15.8 15.1 15.9 15.3 15.9C15.5 15.9 15.7 15.8 15.8 15.7C15.9 15.6 16 15.4 16 15.2C16 15.1 15.9 14.9 15.8 14.8ZM6.5 11.6C3.7 11.6 1.4 9.3 1.4 6.5C1.4 3.7 3.7 1.4 6.5 1.4C9.3 1.4 11.6 3.7 11.6 6.5C11.6 9.4 9.4 11.6 6.5 11.6Z"
                                                    fill="#000"></path>
                                            </svg>
                                        </i>
                                    </div>
                                    <input type="text"
                                        style="color: black; border: none ; background-color: var(--white, #fff); border-radius: 30px; padding: 10px 20px; width: calc(100% - 100px); overflow:hidden;width:100%; height:30px;"
                                        placeholder="Search for buyer & seller" name="search">


                                    <div class="clearSearch" style="display: none;">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 24 24" height="20px" width="20px"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path
                                                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                          <button type="submit" name="submit" class="HeaderSearch__searchButton--Q1AFR">
                                    <span>Search</span>
                              </button>
                            </div>
                                            </form>

                        </div>
                        <br><br>
                      

  <div class="table-container w-full" style="overflow-x: auto;">
    <table class="table table-striped border" id="customers">
        <thead>
            <tr style="border: 1px solid #dddddd; padding: 8px 64px; text-align: center; background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);  color: #fff !important;">
                <th>Location</th>
                <th>Type of Seller</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>BF</th>
                <th>GSM</th>
                <th>Shade</th>
                <th>Size (in Inch)</th>
                <th>W * L</th>
             
                <th>Price Per Kg</th>
                <th>Quantity in Kg</th>
                <th>Other</th>
                <th>Enquiry</th>
            </tr>
        </thead>
        <tbody>
            <?php
             if (isset($_POST['submit'])) {
             $search_query = trim($_POST['search']);
              if ($search_query == "Private") {
                                                        $search_query = 0;

                                                    } else if ($search_query == "Proprietorship") {
                                                        $search_query = 1;

                                                    } else if ($search_query == "LLP (Limited Liability Partnership)") {
                                                        $search_query = 2;

                                                    }
            
             $query = "SELECT spot_price.*,product_new.id as p_id, product_new.seller_id as s_id, product_new.product_name,product_new.w_l,product_new.category_id,product_new.bf, product_new.shade,product_new.gsm,product_new.weight,product_new.stock_in_kg,product_new.quantity_in_kg, product_new.other,product_new.size, users.name, organization.organization_type,organization.city FROM `spot_price` LEFT JOIN product_new on product_new.id=spot_price.product_id left JOIN users on users.id=product_new.seller_id LEFT JOIN organization on product_new.seller_id=organization.user_id
                                    WHERE (users.name LIKE '%$search_query%' OR product_new.product_name LIKE '%$search_query%' OR organization.city LIKE '%$search_query%' OR organization.organization_type LIKE '%$search_query%' OR product_new.category_id LIKE '%$search_query%')"; 
                                    
            }else{
            $query = "SELECT spot_price.*,product_new.id as p_id, product_new.seller_id as s_id, product_new.product_name,product_new.w_l,product_new.category_id,product_new.bf, product_new.shade,product_new.gsm,product_new.weight,product_new.stock_in_kg,product_new.quantity_in_kg, product_new.other,product_new.size, users.name, organization.organization_type,organization.city FROM `spot_price` LEFT JOIN product_new on product_new.id=spot_price.product_id left JOIN users on users.id=product_new.seller_id LEFT JOIN organization on product_new.seller_id=organization.user_id";

            }                  
// echo $query;
// exit;
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $prod_item) {
                   
            ?>
                    <tr>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['city']; ?></td>
          
                         <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php 
                         if($prod_item['organization_type']==0){ echo "Importer"; } 
                         else if($prod_item['organization_type']==1){ echo "Wholeseller"; }
                        else if($prod_item['organization_type']==2){ echo "Manufacturer"; }
                           else if($prod_item['organization_type']==3){ echo "Distributor"; }
                            else if($prod_item['organization_type']==4){ echo "Other"; }
                             else if($prod_item['organization_type']==5){ echo "Printing offset"; }
                              else if($prod_item['organization_type']==6){ echo "Corrugated Box Converter"; }
                               else if($prod_item['organization_type']==7){ echo "Tissue Converter"; }
                            else if($prod_item['organization_type']==8){ echo "Retailer"; }
                           else if($prod_item['organization_type']==9){ echo "Other"; }

                          ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['category_id']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?= $prod_item['product_name']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['bf']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['gsm']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['shade']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['size']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['w_l']; ?></td>
                        
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['spot_price']; ?> ₹</td>
                    
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;"><?php echo $prod_item['quantity_in_kg']; ?></td>
                        <td class="p-2" style="border: 1px solid #dddddd; text-align: center;">
                            <button style="border:none; background-color:transparent; color:#007BFF" value="<?php echo $prod_item['other']; ?>" class="read-more"><i style="font-size:16px !important; color:#666666;" class="fa fa-eye text-[16px] text-[#666666]" ></i></button>
                        </td>
                        <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3 || $_SESSION['role'] == 1) { ?>
                            <td class="p-2" style="border: 1px solid #dddddd; text-align: center; font-size:18px; width:200px">
                                <a class="text-white" style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff; padding: 5px 8px; border-radius: 3px; font-size: 14px; cursor: pointer;" href="spot_price_enquiry.php?role=<?php echo $_SESSION['role'];  ?>&prod_id=<?php echo $prod_item['p_id']; ?>">Enquiry Now</a>
                            </td>
                        <?php } else { ?>
                            <td class="p-2" style="border: 1px solid #dddddd; text-align: center; font-size:18px; width:210px !important; table-layout:fixed;">
                                <a class="text-white" style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); color: #fff; padding: 5px 8px; border-radius: 3px; font-size: 14px; cursor: pointer;" href="spot_price_enquiry.php?prod_id=<?php echo $prod_item['p_id']; ?>">Enquiry Now</a>
                            </td>
                        <?php } ?>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="13" class="dataTables_empty">No Record found</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<style>
    .table-container {
        width:100%;
        overflow-x: auto;
    }

    #customers th, #customers td {
        white-space: nowrap;
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


                    </div>

                </div>
            </div>
            <br><br><br><br>
        </section>
        <?php 
   
        if ($_SESSION) {

$sql = "SELECT name,email_address,phone_no FROM users WHERE id= $_SESSION[id]";

$query_run = mysqli_query($conn, $sql);
$users = mysqli_fetch_assoc($query_run);
$name = $users['name'];
$email_address = $users['email_address'];
$phone_no = $users['phone_no'];

}
?>

        <form action="spot_price_submit.php" method="post" id="frm1" style="display:none;">
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <input type="text" name="phone" id="phone" value="<?php echo $phone_no; ?>">
            <input type="text" name="email_id" id="email" value="<?php echo $email_address; ?>">
            <input type="text" name="sellerenq" id="sellerenq" value="sellerenq">

          

        </form>
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

  <section class="popup" id="popup" >
   
    <div class="popup__content">
      	<span  aria-label="close" id="closeBtn" class="x">❌</span>
   
      <p id="para"></p>
    
    </div>
  </section>

<script>
$(".read-more").click(function() {
      var other = this.value;
      document.getElementById('para').textContent = other;
      document.getElementById('popup').style.display = 'flex';

    });

    // Close the modal
    document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('popup').style.display = 'none';
});
</script>
    <?php include ('components/footer.php'); ?>



</body>

</html>
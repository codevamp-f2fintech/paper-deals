<?php session_start();
?>
<?php
error_reporting(E_ALL);
include("connection/config.php");
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    require('components/meta.php');
    require('constants.php');
    include('connection/config.php'); ?>
    <title>
        <?php echo (isset($search) ? $search . " - " : "") . site_name ?>
    </title>
    <link rel="stylesheet" href="resposnive.css">
</head>

<body>
    <?php include('components/header.php') ?>
   <!--<div class="w-full">-->

   <!--     <div class="max-w-[100vw] banner-main">-->
   <!--         <div class="asdadsasfda" id="searchcin">-->
   <!--             <div class="slider_bx" style="position:absolute;z-index:1" >-->
   <!--                 <div class="head  heda1">-->
   <!--                     <h1>-->
   <!--                         India's Largest Marketplace for-->
   <!--                         <span class="">PAPER DEALS</span>-->
   <!--                     </h1>-->
   <!--                     <p>Stay up-to-date with the latest-->
   <!--                         information on our selling, buying, offers, news, and spot prices.</p>-->

   <!--                 </div>-->
   <!--                 <form action="search.php" method="POST" class="srch_frm">-->
   <!--                     <div class="HeaderSearch__globalSearchLanding--ompUH mt-4" id="search-problem">-->
   <!--                         <div class="HeaderSearch__searchFieldLanding--IAlyD searchFieldLanding">-->
   <!--                             <div class="HeaderSearch__searchFieldContent--Ahi_w">-->
   <!--                                 <div style="margin:3px 8px;">-->
   <!--                                     <i class="material-icons">-->
   <!--                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
   <!--                                             <path d="M15.8 14.8L11.6 10.6C12.6 9.4 13.1 8 13.1 6.5C13.1 2.9 10.2 0 6.6 0C2.9 0 0 2.9 0 6.5C0 10.1 2.9 13 6.5 13C8 13 9.4 12.5 10.6 11.5L14.8 15.7C14.9 15.8 15.1 15.9 15.3 15.9C15.5 15.9 15.7 15.8 15.8 15.7C15.9 15.6 16 15.4 16 15.2C16 15.1 15.9 14.9 15.8 14.8ZM6.5 11.6C3.7 11.6 1.4 9.3 1.4 6.5C1.4 3.7 3.7 1.4 6.5 1.4C9.3 1.4 11.6 3.7 11.6 6.5C11.6 9.4 9.4 11.6 6.5 11.6Z" fill="#000"></path>-->
   <!--                                         </svg>-->
   <!--                                     </i>-->
   <!--                                 </div>-->
   <!--                                 <input type="text" class="input-search-prop" title="Keyword" required id="search" name="search" style="color: black; border: none; background-color: var(--white, #fff); border-radius: 30px; padding: 10px 20px; width:100%;" placeholder="Search for buyer & seller">-->

   <!--                                 <div class="clearSearch" style="display: none;">-->
   <!--                                     <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg">-->
   <!--                                         <path fill="none" d="M0 0h24v24H0z"></path>-->
   <!--                                         <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">-->
   <!--                                         </path>-->
   <!--                                     </svg>-->
   <!--                                 </div>-->
   <!--                             </div>-->

   <!--                             <button type="submit" name="submit" class="HeaderSearch__searchButton--Q1AFR">-->
   <!--                                 <span>Search</span>-->
   <!--                             </button>-->
   <!--                         </div>-->
   <!--                     </div>-->
   <!--                 </form>-->
   <!--             </div>-->
   <!--         </div>-->
   <!--         <div x-data="{ activeSlide: 1, slideCount: 3 }" class="overflow-hidden relative">-->
                <!-- Slider -->
                <!-- You can remove x-init if you dont want to autoplay -->
   <!--             <div class="whitespace-nowrap transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (activeSlide - 1) * 100.5 + '%)'" x-init="setInterval(() => { activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1 }, 5000)">-->
                    <!-- Item 1 -->
   <!--                 <div class="inline-block w-full max-h-[600px]">-->
   <!--                     <img class="slider-img" src="pd-banner.jpg" alt="" style="width: 100%;">-->
   <!--                 </div>-->

                    <!-- Item 2 -->
   <!--                 <div class="inline-block w-full max-h-[600px]">-->
   <!--                     <img class="slider-img" src="pd-banner.jpg" style="width: 100%;" alt="" />-->
   <!--                 </div>-->
                    <!-- Item 3 -->
   <!--                 <div class="inline-block w-full max-h-[600px]">-->
   <!--                     <img class="slider-img" src="pd-banner.jpg" alt="" style="width: 100%;" />-->
   <!--                 </div>-->
   <!--             </div>-->

   <!--         </div>-->
   <!--     </div>-->
   <!-- </div>-->
    <style>
 

        .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                height: 85vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
             
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

        .fixed-overlay h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }
/*====================================================================================*/
        @media (max-width: 767px) {
            
            .slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    height: 44vh;
}
            .slider-slide {
    flex: 0 0 100%;
    max-width: 100%;
    position: relative;
    height: 44vh !important;
}

     .fixed-overlay h1 {
    font-size: 20px;
    font-weight:600;

}


.fixed-overlay p {
    font-size: 14px;
    margin-bottom: 2rem;
}


    .fixed-overlay form {
        display: flex;
        max-width: 356px;
        width: 100%;
        background: #fff;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        /* height: 48px; */
        width: 105%;
    }
    
 .fixed-overlay > form > i{
         font-size: 13px !important;
 }

.fixed-overlay input {
    flex: 1;
    padding: 10px 5px;
    border: none;
    outline: none;
    color: #000;
    font-size: 1rem;
    border-radius: 30px 0 0 30px;
    margin: 0 1% 0 0;
    /*border: 2px solid;*/
}
.fixed-overlay button {
    padding: 10px 15px;
    border: none;
    background: linear-gradient(90deg, #0078ff, #00d2ff);
    color: #fff;
    border-radius: 47px;
    cursor: pointer;
    font-size: 1rem;
    height: 42px;
    margin: 0.7%;
}}
@media only screen and (min-width: 768px) and (max-width: 1023px) {
        .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                   height: 44vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
                height: 44vh;
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

       .fixed-overlay h1 {
    font-size: 32px !important;
    margin-bottom: 1rem;
    font-weight: 600;
}

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }

        }
        @media only screen and (min-width: 1024px) and (max-width: 1440px) {
            
             .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                    height: 75vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
             
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

           .fixed-overlay h1 {
        font-size: 45px;
        margin-bottom: 1rem;
        font-weight: 700;
    }

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }
        }  
        }
        @media only screen and (min-width: 1441px) and (max-width: 1919px) {
            
            
            
            
        }
    </style>
</head>
<body>
    <div class="banner-main">
        <div class="slider-container">
            <div class="slider-wrapper" id="slider">
                <!-- Slider Items -->
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 1">
                </div>
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 2">
                </div>
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 3">
                </div>
            </div>
            <!-- Fixed Overlay -->
            <div class="fixed-overlay">
                <h1>India's Largest Marketplace for <span>PAPER DEALS</span></h1>
                <p>Stay up-to-date with the latest information on our selling, buying, offers, news, and spot prices.</p>
                <form action="search.php" method="POST">
                  <i class="fas fa-search text-black py-4 pl-4"></i>  <input type="text" name="search" placeholder="Search for Seller & Buyer" required>
                    <button type="submit" name="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slider-slide');
        const totalSlides = slides.length;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            document.getElementById('slider').style.transform = `translateX(-${currentIndex * 100}%)`;
        }, 5000);
    </script>
        <!-- Search RESULTS -->
        <section class="srch_sectn">
            <style>
                .tab {
                    overflow: hidden;
                    border: 1px solid #ccc;
                    background-color: #f1f1f1;
                }

                /* Fade in tabs */
                @-webkit-keyframes fadeEffect {
                    from {
                        opacity: 0;
                    }

                    to {
                        opacity: 1;
                    }
                }

                @keyframes fadeEffect {
                    from {
                        opacity: 0;
                    }

                    to {
                        opacity: 1;
                    }
                }

                /* Style the buttons that are used to open the tab content */
                .tab button {
                    background-color: inherit;
                    float: left;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 14px 16px;
                    transition: 0.3s;
                }

                /* Change background color of buttons on hover */
                .tab button:hover {
                    background-color: #ddd;
                }

                /* Create an active/current tablink class */
                .tab button.active {
                    background-color: #ccc;
                }

                /* Style the tab content */
                .tabcontent {
                    display: none;
                    padding: 6px 12px;
                    border: 1px solid #ccc;
                    border-top: none;
                }


                .pagination {
                    list-style-type: none;
                    padding: 10px 0;
                    display: flex;
                    justify-content: center;
                    box-sizing: border-box;
                    margin-top: 3rem;
                }

                .pagination li {
                    box-sizing: border-box;
                    padding-right: 10px;
                }

                .pagination li a {
                    box-sizing: border-box;
                    background-color: #e2e6e6;
                    padding: 10px;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: bold;
                    color: #616872;
                    border-radius: 4px;
                    margin: 5px;
                }


                .pagination li a:hover {
                    background-color: #d4dada;
                }

                .pagination .next a,
                .pagination .prev a {
                    text-transform: uppercase;
                    font-size: 12px;
                }

                .pagination .currentpage a {
                    background-color: #518acb;
                    color: #fff;
                }

                .pagination .currentpage a:hover {
                    background-color: #518acb;
                }
            </style>
            <style>
                /* CSS rules */
                .your-element {
                    width: 80%;

                }
            </style>
            <div class="container">
                <div class="head">
                    <!-- <h3>Search <span class="text-orange-600">Result</span></h3> -->
                </div>
                <?php
               
                if ($_GET['tab'] == 'seller') {
                    $class = 'WhyChooseUs__active--YOzBf';
                    $style1 = 'style="display:none"';
                    $class1 = '';
                    $style = 'style="display:block"';
                } else if($_GET['tab'] == 'buyer') {
                    $class = '';
                    $style = 'style="display:none"';
                    $class1 = 'WhyChooseUs__active--YOzBf';
                    $style1 = 'style="display:block"';
                }else{
                     $class = 'WhyChooseUs__active--YOzBf';
                    $style1 = 'style="display:none"';
                    $class1 = '';
                    $style = 'style="display:block"';
                }

                ?>
                <!-- <div class="tab cstm_tab" style="border:5px solid !important; width:400px; margin: 1% auto !important; padding:0 !important;">
                    <button class="btn tablinks <?= $class1; ?>" id="defaultOpen" onclick="openCity(event, 'buyer')" style="background:#fff;font-size:18px;">Buyer</button>
                    <button class="btn tablinks <?= $class; ?>" id="sellerbutton" onclick="openCity(event, 'seller')" style="background:#fff; font-size:18px; ">Seller</button>
                </div> -->
                <style>
                    .big-button {
                        background: #666666;
                        border-radius: 50px;
                        display: flex;
                        margin: 2% auto;
                        width: fit-content;
                    }

                    .WhyChooseUs__chooseBuyerBtn--V_l0B,
                    .WhyChooseUs__chooseSupplierBtn--uf8lm {
                        align-items: center;
                        border-radius: 1000px;
                        box-shadow: 0 4px 6px -2px rgba(16, 24, 40, 0.03),
                            0 12px 16px -4px rgba(16, 24, 40, 0.08);
                        color: #fff;
                        cursor: pointer;
                        display: flex;
                        flex-shrink: 0;
                        font-size: 16px;
                        font-weight: 600;
                        height: 47px;
                        justify-content: center;
                        line-height: 30px;
                        transition: background-image 0.3s ease;
                        width: 124px;
                    }

                    .WhyChooseUs__active--YOzBf {
                        background-image: linear-gradient(259deg, #006efa, #07cdbe 84.05%);
                    }
                </style>
                <div class="big-button">
                    <div role="button" class="WhyChooseUs__chooseBuyerBtn--V_l0B <?= $class1; ?>" id="defaultOpen" onclick="openCity(event, 'buyer')" tabindex="0">
                        Buyer
                    </div>
                    <div role="button" class="WhyChooseUs__chooseSupplierBtn--uf8lm <?= $class; ?>" id="sellerbutton" onclick="openCity(event, 'seller')" tabindex="-1">
                        Seller
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const buyerBtn = document.getElementById("defaultOpen");
                        const supplierBtn = document.getElementById("sellerbutton");

                        buyerBtn.addEventListener("click", function() {
                          
                            buyerBtn.classList.add("WhyChooseUs__active--YOzBf");
                            
                            supplierBtn.classList.remove("WhyChooseUs__active--YOzBf");
                            
                        });

                        supplierBtn.addEventListener("click", function() {
                         
                            supplierBtn.classList.add("WhyChooseUs__active--YOzBf");
                           
                            buyerBtn.classList.remove("WhyChooseUs__active--YOzBf");
                        });
                    });
                </script>
                <!-- Tab content -->
                <div id="buyer" class="tabcontent" <?= $style1; ?>>
                    <?php
                       $category=$_GET['category_id'];
                $product_name=$_GET['p_name'];
                    if (isset($_REQUEST['submit'])) {
                        $search = trim($_REQUEST['search']);
// print_r($_REQUEST);
// exit;
                        if (!empty($search)) {

                            $query = " SELECT users.id,users.user_type,users.name,users.email_address, 
        CASE WHEN users.user_type = 2 THEN 1 ELSE 0 END AS SellerCount, 
        CASE WHEN users.user_type = 3 THEN 1 ELSE 0 END AS buyerCount,
        og.id as og_id,og.user_id,og.organizations,og.city,og.district,og.state,og.pincode,og.production_capacity,og.materials_used, 
        p.id as p_id,p.seller_id,p.product_name
      
       
     FROM users 
    LEFT JOIN organization AS og ON users.id = og.user_id
    LEFT JOIN product_new AS p ON p.seller_id = users.id 
    WHERE 
        ((og.city LIKE '%$search%')
        OR (og.organizations LIKE '%$search%')
        OR (p.category_id LIKE '%$search%')
        OR (p.product_name LIKE '%$search%')) AND (users.user_type=3) GROUP by id";
                        }
                        // else {

                    //         $query = "SELECT users.*, og.organizations, og.address,og.state,og.production_specification,og.organization_type,og.verified,og.vip,og.pincode,og.price_range,og.image_banner
                    //     FROM users 
                    //     LEFT JOIN organization AS og ON users.id = og.user_id where users.user_type=3 AND (og.organizations LIKE '%$search%'
                    //     OR og.address LIKE '%$search%' OR og.production_specification LIKE '%$search%' OR og.organization_type LIKE '%$search%') ORDER BY og.vip DESC";
                    //  }
                     
                    } else {

                        $limit = 4;  //set  Number of entries to show in a page.
                        // Look for a GET variable page if not found default is 1.        
                        if (isset($_GET["page"])) {
                            $page  = $_GET["page"];
                        } else {
                            $page = 1;
                        }
                        //determine the sql LIMIT starting number for the results on the displaying page  
                        $page_index = ($page - 1) * $limit;      // 0
                        
                             if($_GET['category_id']=="" && $_GET['cate_id']=="" && $_GET['p_name']==""){
                        $query = "SELECT users.*, organization.organizations, organization.address, organization.pincode, organization.state, organization.production_capacity, organization.organization_type, organization.verified, organization.vip, organization.image_banner, organization.price_range, organization.city, organization.district,state_list.state_name FROM users LEFT JOIN organization ON users.id = organization.user_id LEFT JOIN state_list on state_list.state_id=organization.state WHERE users.user_type = 3 ORDER BY organization.verified DESC, organization.vip DESC limit $page_index, $limit";
                        } else if($_GET['category_id']!=""){
                                 
                                  $query = "SELECT product_new.*, users.*, organization.* FROM product_new JOIN users ON users.id = product_new.seller_id JOIN organization ON product_new.seller_id = organization.user_id WHERE product_new.category_id = '$category' AND users.active_status=1 and users.user_type=3 GROUP BY product_new.seller_id ORDER BY organization.verified DESC, organization.vip DESC";
  
                               } else if($_GET['cate_id']!="" && $_GET['p_name']!=""){
                                   
                                   $query = "SELECT product_new.*, users.*, organization.* FROM product_new JOIN users ON users.id = product_new.seller_id JOIN organization ON product_new.seller_id = organization.user_id WHERE product_new.product_name = '$product_name' AND users.active_status=1 and users.user_type=3 GROUP BY product_new.seller_id ORDER BY organization.verified DESC, organization.vip DESC";
                                   
                               }
                        
                    }  
                
                     //echo $query;
                    // echo $query;
                    // exit;
                    $query_run = mysqli_query($conn, $query);
                    $Item = mysqli_num_rows($query_run) > 0;
                    if ($Item) {
                        while ($prod_item = mysqli_fetch_assoc($query_run)) {
                            // print_r($prod_item);
                    ?>
                            <div class="flex flex-col buy-box">
                                <div class="flex flex-col md:flex-row md:items-center rounded border gap-7 p-5 sell your-element h-[240px;] buy-box-1">
                                    <div class="buyer-img">
                                        <img src="<?php if ($prod_item['image_banner']) { ?>admin/<?= $prod_item['image_banner']; ?> <?php } else { ?>logo.jpg <?php } ?>" alt="alt" class="p-1 border" style="height
                                        :200px;width:250px;object-fit:contain;">
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h3 class="text-lg md:text-xl font-bold">
                                            <?= 'PDB_'.$prod_item['id']; ?>
                                        </h3>
                                        <?php

                                     
                                               $user_id = $prod_item['id'];
                                                $Vip_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$user_id' and type ='Vip' and status ='1'");
                                                $Verified_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$user_id' and type ='Verified' and status ='1'");
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
                                                <h5 class="font-semibold">Company Id</h5>
                                                <p>
                                                   <?= 'PDB_'.$prod_item['id']; ?>
                                                </p>
                                            </div>

                                            <div>
                                                <h5 class="font-semibold">City</h5>
                                                <p>
                                                    <?= $prod_item['city']; ?>
                                                </p>
                                            </div>

                                            <div>
                                                <h5 class="font-semibold">Area</h5>
                                                <p>
                                                    <?= $prod_item['city'] . ", " . $prod_item['district'] . " " . $prod_item['pincode']; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 md:grid-cols-3 gap-4 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">State</h5>
                                                <p>
                                                    <?=
                                                    $prod_item['state_name']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Production Capacity</h5>
                                                <p>
                                                    <?= $prod_item['production_capacity']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">(Deals In)</h5>
                                                <p>
                                                    <?= $prod_item['organizations']; ?>
                                                </p>
                                            </div>
                                        </div>


                                        <div class="grid grid-cols-7 md:grid-cols-7 md:gap-8 buyer-button">
                                            <!-- <a href="enquiry.php?role=3&prod_id=<?php echo $prod_item['id']; ?>"
                                            class="py-1 px-3 text-white focus:bg-black hover:bg-black">Enquiry
                                            Now</a> -->
                                            <a href="view_profle.php?role=3&prod_id=<?php echo $prod_item['id']; ?>" class="py-1 px-2 text-white focus:bg-black rounded-md hover:bg-black" style="width:100px; background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">View
                                                Profile</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php
                        }
                    } else { ?>
                        <p style="text-align: center; font-size: 18px;">Buyer details not found.</p>
                    <?php }
                    ?>
                    <?php $all_data = mysqli_query($conn, "SELECT users.*, 
       organization.organizations, 
       organization.address, 
       organization.pincode, 
       organization.state, 
       organization.production_specification, 
       organization.organization_type, 
       organization.verified, 
       organization.vip, 
       organization.image_banner, 
       organization.price_range, 
       organization.city, 
       organization.district
FROM users
LEFT JOIN organization ON users.id = organization.user_id
WHERE users.user_type = 3
ORDER BY organization.verified DESC, organization.vip DESC");

                    $limit = 5;
                    $user_count = mysqli_num_rows($all_data);
                    // echo $user_count;  // say total count 9  
                    $total_records = $user_count;   //9
                    $total_pages = ceil($total_records / $limit);    // 9/3=  3
                    if ($total_pages > 0) : ?>
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="prev"><a href="search.php?tab=buyer&page=<?php echo $page - 1 ?>">Prev</a></li>
                            <?php endif; ?>

                            <?php if ($page > 3) : ?>
                                <li class="start"><a href="search.php?tab=buyer&page=1">1</a></li>
                                <li class="dots">...</li>
                            <?php endif; ?>

                            <?php if ($page - 2 > 0) : ?><li class="page"><a href="search.php?tab=buyer&page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                            <?php if ($page - 1 > 0) : ?><li class="page"><a href="search.php?tab=buyer&page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                            <li class="currentpage"><a href="search.php?tab=buyer&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                            <?php if ($page + 1 < $total_pages + 1) : ?><li class="page"><a href="search.php?tab=buyer&page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                            <?php if ($page + 2 < $total_pages + 1) : ?><li class="page"><a href="search.php?tab=buyer&page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                            <?php if ($page < $total_pages - 2) : ?>
                                <li class="dots">...</li>
                                <li class="end"><a href="search.php?tab=buyer&page=<?php echo $total_pages ?>"><?php echo $total_pages ?></a></li>
                            <?php endif; ?>

                            <?php if ($page < $total_pages) : ?>
                                <li class="next"><a href="search.php?tab=buyer&page=<?php echo $page + 1 ?>">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            
               
             
               
    <div id="seller" class="tabcontent" <?= $style; ?>>
                            
<?php
$category=$_GET['category_id'];
$product_name=$_GET['p_name'];

  if (isset($_REQUEST['submit'])) {
                        $search = trim($_REQUEST['search']);
// print_r($_REQUEST);
// exit;
                        if (!empty($search)) {

                            $query = " SELECT users.id,users.user_type,users.name,users.email_address, 
        CASE WHEN users.user_type = 2 THEN 1 ELSE 0 END AS SellerCount, 
        CASE WHEN users.user_type = 3 THEN 1 ELSE 0 END AS buyerCount,
        og.id as og_id,og.user_id,og.organizations,og.city,og.district,og.state,og.pincode,og.production_capacity,og.materials_used, 
        p.id as p_id,p.seller_id,p.product_name
      
       
     FROM users 
    LEFT JOIN organization AS og ON users.id = og.user_id
    LEFT JOIN product_new AS p ON p.seller_id = users.id 
    WHERE 
        ((og.city LIKE '%$search%')
        OR (og.organizations LIKE '%$search%')
        OR (p.category_id LIKE '%$search%')
        OR (p.product_name LIKE '%$search%')) AND (users.user_type=2) GROUP by id";
                        }
                        // else {

                    //         $query = "SELECT users.*, og.organizations, og.address,og.state,og.production_specification,og.organization_type,og.verified,og.vip,og.pincode,og.price_range,og.image_banner
                    //     FROM users 
                    //     LEFT JOIN organization AS og ON users.id = og.user_id where users.user_type=3 AND (og.organizations LIKE '%$search%'
                    //     OR og.address LIKE '%$search%' OR og.production_specification LIKE '%$search%' OR og.organization_type LIKE '%$search%') ORDER BY og.vip DESC";
                    //  }
                     
                    } else {

                                $limit = 4;  //set  Number of entries to show in a page.
                                // Look for a GET variable page if not found default is 1.        
                                if (isset($_GET["page"])) {
                                    $page  = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                //determine the sql LIMIT starting number for the results on the displaying page  
                                $page_index = ($page - 1) * $limit;      // 0
                                 if($_GET['category_id']=="" && $_GET['cate_id']=="" && $_GET['p_name']==""){
                                
                                $query = "SELECT users.*, organization.organizations, organization.address, organization.pincode, organization.state, organization.production_capacity, organization.organization_type, organization.verified, organization.vip, organization.image_banner, organization.price_range, organization.city, organization.district,state_list.state_name FROM users LEFT JOIN organization ON users.id = organization.user_id LEFT JOIN state_list on state_list.state_id=organization.state WHERE users.user_type = 2 ORDER BY organization.verified DESC, organization.vip DESC limit $page_index, $limit";
 }
                               else if($_GET['tab']=="seller" && $_GET['category_id']!=""){
                                  
                                  $query = "SELECT product_new.*, users.*, organization.* FROM product_new JOIN users ON users.id = product_new.seller_id JOIN organization ON product_new.seller_id = organization.user_id WHERE product_new.category_id = '$category' AND users.active_status=1 and users.user_type=2 GROUP BY product_new.seller_id ORDER BY organization.verified DESC, organization.vip DESC";
  
                               } else if($_GET['cate_id']!="" && $_GET['p_name']!=""){
                                   
                                   $query = "SELECT product_new.*, users.*, organization.* FROM product_new JOIN users ON users.id = product_new.seller_id JOIN organization ON product_new.seller_id = organization.user_id WHERE product_new.product_name = '$product_name' AND users.active_status=1 and users.user_type=2 GROUP BY product_new.seller_id ORDER BY organization.verified DESC, organization.vip DESC";
                                   
                               }
                    }

// echo $query;
// exit;
                            


                            $query_run = mysqli_query($conn, $query);
                            $Item = mysqli_num_rows($query_run) > 0;
                            if ($Item) {
                                while ($prod_item = mysqli_fetch_assoc($query_run)) {
                                 //print_r($prod_item);
                            ?>
                                    <div class="flex flex-col buy-box">
                                        <div class="flex flex-col md:flex-row  buy-box-1md:items-center rounded border gap-5 p-5 sell your-element h-[240px] buy-box-1">
                                            <div class="buyer-img">
                                                <img src="<?php if ($prod_item['image_banner']) { ?>admin/<?= $prod_item['image_banner']; ?> <?php } else { ?>logo.jpg <?php } ?>" alt="alt" class="p-1 border" style="height
                                        :200px;width:250px;object-fit:contain;">
                                            </div>
                                            <div class="flex flex-col gap-2 mmm">
                                                <h3 class="text-lg md:text-xl font-bold">
                                                    <?= 'PDS_'.$prod_item['id']; ?>
                                                </h3>
                                                
                                                <?php 
                                               $id=$prod_item['id'];
                                                $Vip_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$id' and type ='Vip' and status ='1'");
                                                $Verified_run = mysqli_query($conn, "SELECT * FROM `subscription` WHERE user_id = '$id' and type ='Verified' and status ='1'");
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
                                                            <?php echo "Not Verified1"; ?>
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
                                                    <!-- <div>
                                            
                                            <h5 class="font-semibold">Name</h5>
                                                <p>
                                                    <?= $prod_item['name']; ?>
                                                </p>
                                            </div> -->

                                                    <div>
                                                        <h5 class="font-semibold">Company Id</h5>
                                                        <p>
                                                             <?= 'PDS_'.$prod_item['id']; ?>
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-semibold">City</h5>
                                                        <p>
                                                            <?= $prod_item['city']; ?>

                                                        </p>
                                                    </div>

                                                    <div>
                                                        <h5 class="font-semibold">Area</h5>
                                                        <p>
                                                            <?= $prod_item['city'] . ", " . $prod_item['district'] . " " . $prod_item['pincode']; ?>

                                                        </p>
                                                    </div>


                                                </div>
                                                <div class="grid grid-cols-3 md:grid-cols-3 gap-4 md:gap-5">


                                                    <div>
                                                        <h5 class="font-semibold">State</h5>
                                                        <p>
                                                            <?= $prod_item['state_name'] ?>

                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-semibold">Production Capacity</h5>
                                                        <p>
                                                            <?= $prod_item['production_capacity'] ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-semibold">Deals In</h5>
                                                        <p>
                                                            <?= $prod_item['organizations'] ?>
                                                        </p>
                                                    </div>






                                                </div>

                                                <div class="grid grid-cols-7 md:grid-cols-7 md:gap-8 buyer-button">
                                                    <!-- <a href="enquiry.php?role=3&prod_id=<?php echo $prod_item['id']; ?>"
                                            class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">Enquiry
                                            Now</a> -->
                                                    <a href="view_profle.php?role=2&prod_id=<?php echo $prod_item['id']; ?>" class="py-1 px-2 text-white rounded-md" style="width:100px; background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">View
                                                        Profile</a>
                                                </div>

                                            </div>

                                        </div>
                                    <?php
                                }
                            } else { ?>
                                    <p style="text-align: center; font-size: 18px;">Seller details not found.</p>
                                <?php }
                                ?>

                                <?php 
                                
                                $all_data = mysqli_query($conn, "SELECT users.*, 
       organization.organizations, 
       organization.address, 
       organization.pincode, 
       organization.state, 
       organization.production_specification, 
       organization.organization_type, 
       organization.verified, 
       organization.vip, 
       organization.image_banner, 
       organization.price_range, 
       organization.city, 
       organization.district
FROM users
LEFT JOIN organization ON users.id = organization.user_id
WHERE users.user_type = 2
ORDER BY organization.verified DESC, organization.vip DESC");
                                $limit = 2;
                                $user_count = mysqli_num_rows($all_data);
                                // echo $user_count;  // say total count 9  
                                $total_records = $user_count;   //9
                                $total_pages = ceil($total_records / $limit);    // 9/3=  3
                                if ($total_pages > 0) : ?>
                                    <ul class="pagination">
                                        <?php if ($page > 1) : ?>
                                            <li class="prev"><a href="search.php?tab=seller&page=<?php echo $page - 1 ?>">Prev</a></li>
                                        <?php endif; ?>

                                        <?php if ($page > 3) : ?>
                                            <li class="start"><a href="search.php?tab=seller&page=1">1</a></li>
                                            <li class="dots">...</li>
                                        <?php endif; ?>

                                        <?php if ($page - 2 > 0) : ?><li class="page"><a href="search.php?tab=seller&page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                        <?php if ($page - 1 > 0) : ?><li class="page"><a href="search.php?tab=seller&page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                        <li class="currentpage"><a href="search.php?tab=seller&page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                        <?php if ($page + 1 < $total_pages + 1) : ?><li class="page"><a href="search.php?tab=seller&page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                        <?php if ($page + 2 < $total_pages + 1) : ?><li class="page"><a href="search.php?tab=seller&page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                        <?php if ($page < $total_pages - 2) : ?>
                                            <li class="dots">...</li>
                                            <li class="end"><a href="search.php?tab=seller&page=<?php echo $total_pages ?>"><?php echo $total_pages ?></a></li>
                                        <?php endif; ?>

                                        <?php if ($page < $total_pages) : ?>
                                            <li class="next"><a href="search.php?tab=seller&page=<?php echo $page + 1 ?>">Next</a></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>

                                    </div>


        </section>
        <script>
            //document.getElementById("defaultOpen").click();
            function openCity(evt, cityName) {
                // Declare all variables
                var i, tabcontent, tablinks;

                // Get all elements with class="tabcontent" and hide them
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Get all elements with class="tablinks" and remove the class "active"
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                // Show the current tab, and add an "active" class to the button that opened the tab
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a solution
                    meeting your budget and requirement </p>
                <div class="flex gap-2 ">
                    <a href="buyer" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-cart-check-fill"></i> Buyers</a>
                    <a href="seller" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-shop-window"></i> Sellers</a>
                </div>
            </div>
        </section>

    </main>
    <?php include('components/footer.php') ?>
</body>

</html>
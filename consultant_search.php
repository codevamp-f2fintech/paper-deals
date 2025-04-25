<?php session_start();
  ?>
<?php
error_reporting(E_ALL);
include ("connection/config.php");
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    require ('components/meta.php');
    require ('constants.php');
    include ('connection/config.php'); ?>
    <title>
        <?php echo (isset($search) ? $search . " - " : "") . site_name ?>
    </title>
</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Search BOX -->
        <section
            class="slider_section text-gray-600 body-font bg-[url('assets/herobg.jpg')] bg-cover bg-contain  h-[75vh]">

            <div class=" container">
                <div class="slider_bx">
                    <div class="head mt-20">
                        <h1>
                            India's Largest Marketplace for
                            <span class="text-orange-400">PAPER DEALS</span>
                        </h1>
                        <p>Stay up-to-date with the latest
                            information on our selling, buying, offers, news, and spot prices.</p>

                    </div>


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
                            /* width: 100%;
                            height: 60px; */
                            margin-left: 1.6%;
                        }

                        .HeaderSearch__searchButton--Q1AFR {
                            background: linear-gradient(259deg, #006efa, #07cdbe 84.05%);
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
                            .slider_section>.container>.slider_bx>.head>h1 {
                                margin-top: -100px;
                            }

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
                                width: 100%;
                            }
                        }
                    </style>
                    <form action="search.php" method="POST" class="srch_frm">
                        <div class="HeaderSearch__globalSearchLanding--ompUH mt-4">
                            <div class="HeaderSearch__searchFieldLanding--IAlyD searchFieldLanding">
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
                                    <input type="text" title="Keyword" required id="search" name="search"
                                        style="color: black; border: none; background-color: var(--white, #fff); border-radius: 30px; padding: 10px 20px; width: calc(100% - 100px);"
                                        placeholder="Search for buyer & seller">
                                    <div role="button" tabindex="0"
                                        style="display: flex; align-items: center; cursor: text; padding: 0 20px;">
                                        <span>Search for</span>
                                    </div>
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
                                <!-- Changed div to button and added type="submit" -->
                                <button type="submit" name="submit" class="HeaderSearch__searchButton--Q1AFR">
                                    <span>Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Suggested Search -->
                    <div class="flex flex-col md:flex-row gap-3 self-start mt-4">
                        <p class="hidden md:block">Suggested</p>
                        <div class="flex flex-wrap gap-1 text-sm">
                            <?php
                            $query = "select * from new_category";
                            $query_run = mysqli_query($conn, $query);
                            $Item = mysqli_num_rows($query_run) > 0;
                            if ($Item) {
                                while ($prod_item = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <a href="search.php?tab=seller&category_id=<?= $prod_item['id']; ?>"
                                        class="border border-white text-white rounded-full px-2 pb-0.5 hover:bg-white hover:text-black focus:bg-white focus:text-black"><?= $prod_item['name']; ?></a>
                                    <?php
                                }
                            } else {
                                echo "No record found";
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

        </section>



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
            </style>
            <style>
                /* CSS rules */
                .your-element {
                    width: 80%;
                    transform: translate(13%, 3%);
                }
            </style>
            <div class="container">
                <div class="head">
                    <!-- <h3>Search <span class="text-orange-600">Result</span></h3> -->
                </div>
                <?php
                if (empty($_REQUEST['tab'])) {
                    $_REQUEST['tab'] = 'buyer';
                }
                if ($_REQUEST['tab'] == 'seller') {
                    $class = 'active';
                    $style = 'style="display:block"';
                    $class1 = '';
                    $style1 = 'style="display:none"';
                } else {
                    $class = '';
                    $style = 'style="display:none"';
                    $class1 = 'active';
                    $style1 = 'style="display:block"';
                }

                ?>
             <div class="head">
                    <h3>Search <span class="text-orange-600">Consultant</span></h3>
                </div>
                <!-- Tab content -->
                <div id="buyer" class="tabcontent" <?= $style1; ?>>
                    <?php

                    if (isset($_REQUEST['consul_submit'])) {
                        $search = trim($_REQUEST['search']);
                       
                        
                     
                        
                  
      $query = "SELECT * FROM `users` LEFT JOIN consultant_pic on users.id=consultant_pic.user_id WHERE user_type=5 AND (users.name LIKE '%$search%' OR users.email_address LIKE '%$search%' OR consultant_pic.description LIKE '%$search%');
";

                    }


                    $query_run = mysqli_query($conn, $query);
                    $Item = mysqli_num_rows($query_run) > 0;
                    if ($Item) {
                        while ($prod_item = mysqli_fetch_assoc($query_run)) {
                            ?>
                           <div class="flex flex-col">
                                <div class="flex flex-col md:flex-row md:items-center rounded border gap-6 p-5 sell your-element">
                                    <img src="admin/<?= $prod_item['prof_pic']; ?>" class="p-1 border w-96 md:w-80"
                                        style="height:280px; width: 280px;">
                                    <div class=" flex flex-col gap-2">
                                        <h3 class="text-lg md:text-xl font-bold">
                                            <?= $prod_item['name']; ?>
                                        </h3>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-16">
                                            <div>
                                                <h5 class="font-semibold">Status</h5>
                                                <p>
                                                    <?php if ($prod_item['active_status'] == 1) {
                                                        echo '<span class="badge bg-success">Active</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger">Inactive</span>';
                                                    }
                                                    ?>
                                                </p>
                                            </div>

                                        </div>
                                        <div>
                                            <h5 class="font-semibold">Created On</h5>
                                            <p>
                                                <?= $prod_item['created_on']; ?>
                                            </p>
                                        </div>
                                        <div>
                                            <h5 class="font-semibold">Description</h5>
                                            <p>
                                                <?= $prod_item['description']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-8"> -->
                                    <a href="view_profle.php?consult_id=<?php echo $prod_item['id']; ?>"
                                        class="py-2 px-2  bg-[#86776f] text-white focus:bg-black hover:bg-black">View
                                        Profile</a>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <?php
                        }
                    } else { ?>
                        <p style="text-align: center; font-size: 18px;">Consultant details not found.</p>
                    <?php }
                    ?>
                </div>
                <?php // Get the category_id and tab from the URL query parameters
                $category_id = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
                $tab = isset($_GET['tab']) ? $_GET['tab'] : '';

                // Check if the tab is set to "seller" and category_id is valid
                if ($tab === 'seller' && $category_id > 0) {
                    // Query the database for sellers in the specified category
                    $query = "SELECT product_new.*, users.name, organization.verified, organization.vip
FROM product_new
JOIN users ON users.id = product_new.seller_id
JOIN organization ON product_new.seller_id = organization.user_id
WHERE product_new.category_id = ?
ORDER BY organization.verified DESC, organization.vip DESC;
";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $category_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Display the list of sellers
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <div class="flex flex-col">
                                <div class="flex flex-col md:flex-row md:items-center rounded border gap-5 p-5 sell your-element">
                                    <img src="admin/<?= $row['image']; ?>" alt="alt" class="p-1 border w-96 md:w-80"
                                        style="height:280px;">
                                    <div class="flex flex-col gap-2">
                                        <h3 class="text-lg md:text-xl font-bold">
                                            <?= $row['organizations']; ?>
                                        </h3>
                                        <div class="flex gap-2 md:items-center text-sm">
                                            <?php if ($row['verified'] == 1) {
                                                ?>
                                                <label class="bg-green-600 text-white font-bold rounded-full py-1 px-3"><i
                                                        class="bi bi-patch-check-fill"></i>
                                                    <?php echo " Verified"; ?>
                                                </label>
                                                <?php
                                            } else {

                                                ?><label
                                                    class="bg-red-600 text-white font-bold rounded-full py-1 px-3">
                                                    <?php echo "Not Verified"; ?>
                                                </label>
                                                <?php
                                            } ?>
                                            <?php if ($row['vip'] == 1) {
                                                ?>
                                                <label class="bg-yellow-400 text-black font-bold rounded-full py-1 px-3
                                                ">
                                                    <?php echo "VIP"; ?>
                                                </label>
                                                <?php
                                            } ?>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">Name</h5>
                                                <p>
                                                    <?= $row['name']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Company Name</h5>
                                                <p>
                                                    <?= $row['organizations']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">Area</h5>
                                                <p>
                                                    <?= $row['district']; ?>, <?= $row['city']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Specification (Deals In)</h5>
                                                <p>
                                                    <?= $row['production_specification']; ?>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">Category</h5>
                                                <p>
                                                    <?php
                                                    $sql = "Select * from new_category where id=$row[category_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['name'];
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Description</h5>
                                                <p>
                                                    <?= $row['other']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-8">
                                        <a href="enquiry.php?role=2&prod_id=<?php echo $row['seller_id']; ?>"
                                            class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">Enquiry
                                            Now</a>
                                        <a href="view_profle.php?role=2&prod_id=<?php echo $row['seller_id']; ?>"
                                            class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">View
                                            Profile</a>
                                    </div>


                                </div>
                            <?php }
                    } else {
                        echo "No sellers found in the specified category.";
                    }

                    // Close the statement
                    $stmt->close();
                } else { ?>
                        <div id="seller" class="tabcontent" <?= $style; ?>>
                            <?php

                            if (isset($_REQUEST['submit'])) {
                                $search = trim($_REQUEST['search']);
                                $state = $_REQUEST['state'];
                                if (!empty($state)) {

                                    $query = "SELECT users.*, og.organizations, og.address,og.state,og.production_specification,og.organization_type,og.verified,og.vip,og.price_range,og.image_banner,og.pincode
                        FROM users 
                        LEFT JOIN organization AS og ON users.id = og.user_id where users.user_type=2 AND og.state='$state' AND (og.organizations LIKE '%$search%'
                        OR og.address LIKE '%$search%' OR og.production_specification LIKE '%$search%' OR og.organization_type LIKE '%$search%') ORDER BY og.vip DESC";
                                } else {

                                    $query = "SELECT users.*, og.organizations, og.address,og.state,og.production_specification,og.organization_type,og.verified,og.vip,og.pincode,og.price_range,og.image_banner
                        FROM users 
                        LEFT JOIN organization AS og ON users.id = og.user_id where users.user_type=2 AND (og.organizations LIKE '%$search%'
                        OR og.address LIKE '%$search%' OR og.production_specification LIKE '%$search%' OR og.organization_type LIKE '%$search%') ORDER BY og.vip DESC";
                                }
                            } else {
                                $query = "SELECT users.*, 
       organization.organizations, 
       organization.pincode, 
       organization.address, 
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
ORDER BY organization.verified DESC, organization.vip DESC;
";
                            }

                            $query_run = mysqli_query($conn, $query);
                            $Item = mysqli_num_rows($query_run) > 0;
                            if ($Item) {
                                while ($prod_item = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <div class="flex flex-col">
                                        <div
                                            class="flex flex-col md:flex-row md:items-center rounded border gap-5 p-5 sell your-element">
                                            <img src="admin/<?= $prod_item['image_banner']; ?>" alt="alt"
                                                class="p-1 border w-96 md:w-80" style="height:280px;">
                                            <div class="flex flex-col gap-2">
                                                <h3 class="text-lg md:text-xl font-bold">
                                                    <?= $prod_item['organizations']; ?>
                                                </h3>
                                                <div class="flex gap-2 md:items-center text-sm">
                                                    <?php if ($prod_item['verified'] == 1) {
                                                        ?>
                                                        <label class="bg-green-600 text-white font-bold rounded-full py-1 px-3"><i
                                                                class="bi bi-patch-check-fill"></i>
                                                            <?php echo " Verified"; ?>
                                                        </label>
                                                        <?php
                                                    } else {

                                                        ?><label
                                                            class="bg-red-600 text-white font-bold rounded-full py-1 px-3">
                                                            <?php echo "Not Verified"; ?>
                                                        </label>
                                                        <?php
                                                    } ?>
                                                    <?php if ($prod_item['vip'] == 1) {
                                                        ?>
                                                        <label class="bg-yellow-400 text-black font-bold rounded-full py-1 px-3
                                                ">
                                                            <?php echo "VIP"; ?>
                                                        </label>
                                                        <?php
                                                    } ?>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                                    <div>
                                                        <h5 class="font-semibold">Name</h5>
                                                        <p>
                                                            <?= $prod_item['name']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-semibold">Company Name</h5>
                                                        <p>
                                                            <?= $prod_item['organizations']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                                    <div>
                                                        <h5 class="font-semibold">Area</h5>
                                                        <p>
                                                            <?= $prod_item['district']; ?>, <?= $prod_item['city']; ?>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h5 class="font-semibold">Specification (Deals In)</h5>
                                                        <p>
                                                            <?= $prod_item['production_specification']; ?>
                                                        </p>
                                                    </div>

                                                </div>
                                                <div>
                                                    <h5 class="font-semibold">Description</h5>
                                                    <p>
                                                        <?= $prod_item['organization_type']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-8">
                                                <a href="enquiry.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">Enquiry
                                                    Now</a>
                                                <a href="view_profle.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">View
                                                    Profile</a>
                                            </div>


                                        </div>
                                        <?php
                                }
                            } else { ?>
                                    <p style="text-align: center; font-size: 18px;">Seller details not found.</p>
                                <?php }
                            ?>
                            </div>
                        </div>
                    <?php } ?>
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
        </section>

        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div
                class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a solution
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
    <?php include ('components/footer.php') ?>
</body>

</html>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('components/meta.php');
    require('constants.php');
    ?>


    <button class="floating-button shadow-lg border border-red-500 rounded-full">

    </button>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>
        <?php echo site_name ?>
    </title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href='./assets/css/Index-responsive.css' />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<style>
    .asdadsasfda {
        width: 100%;
        height: 64%;
        position: absolute;
        /* background-color: rgb(0, 0, 0, 0.4); */
        z-index: 1;
        right: 0%;
    }

    @media only screen and(min-width: 1440px) {
        .asdadsasfda {
            right: -15%;
            width: 128%;
        }
    }

    @media only screen and (min-width: 1024px) and (max-width: 1439) {
        .asdadsasfda {
            width: 100%;
            position: absolute;
            z-index: 1;
            right: 0%;
            top: 17%;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .asdadsasfda {
            width: 162%;
            right: -32%;
            top: 10%;
        }
    }

    @media only screen and (max-width: 767px) {
        .asdadsasfda {
            right: 8%;
        }
    }
</style>

<body>
    <?php include('components/header.php');
    include('connection/config.php');


    ?>
    <!--<div class="w-full">-->

    <!--    <div class="max-w-[100vw] banner-main">-->
    <!--        <div class="asdadsasfda" id="searchcin">-->
    <!--            <div class="slider_bx">-->
    <!--                <div class="head  heda1">-->
    <!--                    <h1>-->
    <!--                        India's Largest Marketplace for-->
    <!--                        <span class="">PAPER DEALS</span>-->
    <!--                    </h1>-->
    <!--                    <p>Stay up-to-date with the latest-->
    <!--                        information on our selling, buying, offers, news, and spot prices.</p>-->

    <!--                </div>-->
    <!--                <form action="search.php" method="POST" class="srch_frm">-->
    <!--                    <div class="HeaderSearch__globalSearchLanding--ompUH mt-4" id="search-problem">-->
    <!--                        <div class="HeaderSearch__searchFieldLanding--IAlyD searchFieldLanding">-->
    <!--                            <div class="HeaderSearch__searchFieldContent--Ahi_w">-->
    <!--                                <div style="margin:3px 8px;">-->
    <!--                                    <i class="material-icons">-->
    <!--                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
    <!--                                            <path d="M15.8 14.8L11.6 10.6C12.6 9.4 13.1 8 13.1 6.5C13.1 2.9 10.2 0 6.6 0C2.9 0 0 2.9 0 6.5C0 10.1 2.9 13 6.5 13C8 13 9.4 12.5 10.6 11.5L14.8 15.7C14.9 15.8 15.1 15.9 15.3 15.9C15.5 15.9 15.7 15.8 15.8 15.7C15.9 15.6 16 15.4 16 15.2C16 15.1 15.9 14.9 15.8 14.8ZM6.5 11.6C3.7 11.6 1.4 9.3 1.4 6.5C1.4 3.7 3.7 1.4 6.5 1.4C9.3 1.4 11.6 3.7 11.6 6.5C11.6 9.4 9.4 11.6 6.5 11.6Z" fill="#000"></path>-->
    <!--                                        </svg>-->
    <!--                                    </i>-->
    <!--                                </div>-->
    <!--                                <input type="text" class="input-search-prop" title="Keyword" required id="search" name="search" style="color: black; border: none; background-color: var(--white, #fff); border-radius: 30px; padding: 10px 20px; width:100%;" placeholder="Search for buyer & seller">-->

    <!--                                <div class="clearSearch" style="display: none;">-->
    <!--                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg">-->
    <!--                                        <path fill="none" d="M0 0h24v24H0z"></path>-->
    <!--                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">-->
    <!--                                        </path>-->
    <!--                                    </svg>-->
    <!--                                </div>-->
    <!--                            </div>-->

    <!--                            <button type="submit" name="submit" class="HeaderSearch__searchButton--Q1AFR">-->
    <!--                                <span>Search</span>-->
    <!--                            </button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </form>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div x-data="{ activeSlide: 1, slideCount: 3 }" class="overflow-hidden relative">-->
                <!-- Slider -->
                <!-- You can remove x-init if you dont want to autoplay -->
    <!--            <div class="whitespace-nowrap transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (activeSlide - 1) * 100.5 + '%)'" x-init="setInterval(() => { activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1 }, 5000)">-->
                    <!-- Item 1 -->
    <!--                <div class="inline-block w-full max-h-[600px]">-->
    <!--                    <img class="slider-img" src="pd-banner.jpg" alt="" style="width: 100%;">-->
    <!--                </div>-->

                    <!-- Item 2 -->
    <!--                <div class="inline-block w-full max-h-[600px]">-->
    <!--                    <img class="slider-img" src="pd-banner.jpg" style="width: 100%;" alt="" />-->
    <!--                </div>-->
                    <!-- Item 3 -->
    <!--                <div class="inline-block w-full max-h-[600px]">-->
    <!--                    <img class="slider-img" src="pd-banner.jpg" alt="" style="width: 100%;" />-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
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
                height: 70vh;
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
                        height: 68vh;
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

    <!-- Sport Price Ticker -->
    <section class="sptsetcion">
        <div class="sptbx">
            <label>Live Price</label>
            <marquee id="marquee" behaviour="scroll" scrollamount="10" attribute_name="attribute_value" onmouseover="this.stop();" onmouseout="this.start();">
                <?php

                $query = "SELECT * FROM live_price ORDER BY id DESC";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    $i = 1;
                    foreach ($query_run as $prod_item) {
                ?>
                        <a href="contact_us.php" style="font-size:16px;">
                           &nbsp; &nbsp; &nbsp; &nbsp;
                            <?php echo "$i."; ?>
                            <b>Category :</b>
                            <?php $sql = "Select * from live_price";
                          
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                               
                                    echo $prod_item['name'];
                            
                            }
                            ?>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <b>Price :</b>
                            <?= $prod_item['price'] ?> per Kg
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <b>Location :</b>
                            <?= $prod_item['location'] ?>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <?php
                            $i++;
                            ?>
                        </a>
                    <?php

                    }
                } else {
                    ?>
                <?php } ?>
            </marquee>
        </div>
    </section>

    <!-- About US -->
    <section class="abutsectn">
        <div class="container">
            <div class="head" id="about">
                <h3 class="font-extrabold text-2xl md:text-4xl">
                    <span class="text-bl">About</span>
                    <span class="text-400 text-gl">Us</span>
                </h3>
                <p>One of the best marketplace for Paper Industry</p>
            </div>


            <div class="abt_sctn ">

                <div class="flex gap-2 items-center sell " data-aos="fade-up" data-aos-duration="1500">
                    <div class=" icon">
                        <img src="assets/images/icons8-inquiry-96.png" alt="">
                        <!-- <i class="fa-solid border border-blue-600 text-red-500 fa-id-card"></i> -->
                    </div>
                    <div class="dtab">
                        <h4 class="text-lg font-bold">WHO WE ARE</h4>
                        <p>We are Professionals from industry , having thorough insight about paper industry ecosystem</p>
                    </div>
                </div>

                <div class="flex gap-2 items-center sell " data-aos="fade-up" data-aos-duration="1500">
                    <div class="icon">
                        <img src="assets/images/icons8-trust-96 (1).png" alt="">
                    </div>
                    <div class="dtab">
                        <h4 class="text-lg font-bold">WHAT WE DO</h4>
                        <p>Designed a platform to completely transform paper industry in Digital space.</p>
                    </div>
                </div>

                <div class="flex gap-2 items-center sell" data-aos="fade-up" data-aos-duration="1500">
                    <div class="icon">
                        <img src="assets/images/icons8-coins-96.png" alt="">
                    </div>
                    <div class="dtab">
                        <h4 class="text-lg font-bold">Benifits</h4>
                        <p>Paperdeal ensures smooth business transaction ,ease of business documentation and tracking of projects.</p>
                    </div>
                </div>

                <div class="flex gap-2 items-center sell" data-aos="fade-up" data-aos-duration="1500">
                    <div class="icon">
                        <img src="assets/images/icons8-organization-96 (4).png" alt="">
                    </div>
                    <div class="dtab">
                        <h4 class="text-lg font-bold">WHY CHOOSE US</h4>
                        <p>Paperdeal as a market place allows buyer and seller in paper industry to interact and grow. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
 @media (min-width: 300px) and (max-width: 768px) {
        .ln_clmbx{
            /*border:5px solid red;*/
            flex-wrap:wrap;
            align-item:center;
            justify-content:center;
            gap:28px;
        }
    }
     @media (min-width: 769px) and (max-width: 1200px) {
             .ln_clmbx{
            /*border:5px solid red;*/
            width:100% !important;
            /*flex-wrap:wrap;*/
            align-item:center;
            justify-content:center;
            gap:6px;
        }
         .lnsection1{
             width:90%;
         }
     }  @media (min-width: 1201px) and (max-width: 1800px) {
      .lnsection1{
             width:90%;
         }
              .ln_clmbx{
            /*border:5px solid red;*/
            width:100% !important;
            /*flex-wrap:wrap;*/
            align-item:center;
            justify-content:center;
            gap:16px;
        }
         
     } @media (min-width: 1801px) and (max-width: 2800px) {
          .lnsection1{
             width:100%;
         }
              .ln_clmbx{
            /*border:5px solid red;*/
            width:100% !important;
            /*flex-wrap:wrap;*/
            align-item:center;
            justify-content:center;
            gap:6px;
        } 
         
     }
</style>

    <!-- Latest News -->
     <section class="lnsection ">
        <div class="lnsection1  mx-auto  news">
            <div class="head">
                <h3 class="font-extrabold text-2xl md:text-4xl">
                    <span style="color:white;">Latest</span>
                    <span class="text-400" style="color:white;">NEWS</span>
                </h3>
            </div>
 <div class="ln_clmbx flex  justify-between  items-center ">
            <!--<div class="ln_clmbx grid grid-cols-1 md:grid-cols-3 gap-6">-->
                <?php
                $query = "SELECT * FROM `news` ORDER BY `news`.`date` ASC limit 3";
                $query_run = mysqli_query($conn, $query);
                $Item = mysqli_num_rows($query_run) > 0;
                if ($Item) {
                    while ($prod_item = mysqli_fetch_assoc($query_run)) {
                ?>
                          <div class="sellbx" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                <div class="h-full flex items-start" style="height:85%;">
                                
                                    <div class="grow ">
                                        <a class="inline-flex items-center" style=";height:250px;width:100% !important;">
                                            <img alt="paperdeals" src="admin/<?= $prod_item["image"]; ?>"
                                                class="rounded-md flex-shrink-0 object-contain w-full "style="height:100%;width:100%;object-fit:contain;">

                                        </a> 
                                        
                                        <div class="flex gap-4 items-start">
                                        
                                        <div <?php $date = $prod_item["date"];
                                    $month = date("M", strtotime($date));
                                    $day = date(
                                        "j",
                                        strtotime($date)
                                    ); ?> class="w-fit bg-white p-2 rounded border shadow flex-shrink-0 flex flex-col text-center
                                leading-none">
                                        <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">
                                            <?= $month; ?>
                                        </span>
                                        <span class="font-medium text-lg text-gray-800 title-font leading-none">
                                            <?= $day; ?>
                                        </span>
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="leading-relaxed mb-5">
                                            <?php
                                            $string = $prod_item["title"];
                                            $substring = substr($string, 0, 60);
                                            echo $substring;
                                            ?>...
                                            
                                        </p><a href="read-news.php?id=<?php echo $prod_item['id']; ?>"><span class="underline hover:text-blue-500"
                                       >Read
                                        News</span></a></div>
</div>
                                    </div>

                                </div>
                              
                            </div>
                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>

            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="tstmlsection">
        <div class="container">
            <div class="head">
                <h3 class="font-extrabold text-2xl md:text-4xl">
                    <span class="text-bl">Our</span>
                    <span class="text-400 text-gl">Testimonial</span>
                </h3>
                <p>One of the best marketplace for Paper Industry</p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="800">


                <?php
                $query = "select * from testimonials ORDER BY id DESC";
                $query_run = mysqli_query($conn, $query);
                $Item = mysqli_num_rows($query_run) > 0;
                if ($Item) {
                    while ($prod_item = mysqli_fetch_assoc($query_run)) {
                ?>
                        <div class=" border-2 border-blue-500 border-dotted rounded px-1 py-1 booc">
                            <div class="h-full text-center">
                                
                                <div class="flex  gap-4  my-2 items-center ">
                                    <div class="pl-2">
                                        <div class="w-[70px] h-[70px] rounded-full " >
                                        <img src="<?php echo 'admin/uploads/testimonial/'.$prod_item['profile']; ?>" style="width:100%; height:100%;border-radius:50%;margin:3% auto;"></div></div>
                                        <div class="flex flex-col items-left justify-left  ">
                                <h2 class="text-gray-900 font-medium title-font tracking-wider text-sm">
                                    <?= $prod_item['writer']; ?>
                                </h2>
                                <p class="text-gray-400 text-left">
                                    <?= $prod_item['post']; ?>
                                </p></div>
                                </div>
                                
                                <p class="leading-relaxed">
                                    <?= $prod_item['para']; ?><span class="text-2xl"></span>
                                    <span class="text-2xl"></span>
                                </p>
                            
                                
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>
            </div>
        </div>
    </section>




    <!-- How we WORK -->

    <section class="hwwsection">
        <div class="container">
            <div class="head">
                <h3 class="font-extrabold text-2xl md:text-4xl">
                    <span style="color:white;">How WE</span>
                    <span class="text-400" style="color:white;">Work</span>
                </h3>
                <p>One of the best marketplace for Paper Industry</p>
            </div>

            <div class="hwwbx">
                <div class="hwwrpt " data-aos="flip-left" data-aos-duration="1500" data-aos-easing="ease-out-cubic">
                    <div class="medai">
                        <img src="assets/images/icons8-seller-96.png" alt="">

                    </div>
                    <div class="hwwda">
                        <h3>Seller</h3>
                        <p>One of the best marketplace for Paper Industry</p>
                    </div>
                </div>
                <div class="hwwrpt " data-aos="flip-left" data-aos-duration="1500" data-aos-easing="ease-out-cubic">
                    <div class="medai"> <img src="assets/images/icons8-platform-96.png" alt=""></div>
                    <div class="hwwda">
                        <h3>Platform</h3>
                        <p>One of the best marketplace for Paper Industry</p>
                    </div>
                </div>
                <div class="hwwrpt" data-aos="flip-right" data-aos-duration="1500" data-aos-easing="ease-out-cubic">
                    <div class="medai"> <img src="assets/images/icons8-buyer-96.png" alt=""></div>
                    <div class=" hwwda">
                        <h3>Buyer</h3>
                        <p>One of the best marketplace for Paper Industry</p>
                    </div>
                </div>
            </div>



            <!-- <img src="assets/workflow.jpg" alt="workflow" class="w-full md:w-[768px] mx-auto"> -->
        </div>
    </section>

    <!-- Get Started -->
    <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover bann">
        <div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24 hel">
            <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
            <p>Connect to us for your requirement and our solution architect can work with you to design a solution
                meeting your budget and requirement </p>
            <div class="flex gap-2">
                <a href="buyer" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-cart-check-fill"></i> Buyers</a>
                <a href="seller" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-shop-window"></i> Sellers</a>
            </div>
        </div>
    </section>

    <div class="slider">
        <h3 class="font-extrabold text-2xl md:text-4xl assoc">
            <span class="text-bl">OUR</span>
            <span class="text-400 text-gl"><?php echo strtoupper("Association Partner"); ?></span>
        </h3>


        <div class="slide-track">
            <?php
      $query = "SELECT * FROM bottom_logo";
      $query_run = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($query_run)) { ?>
            <div class="slide">
                <img class="logo" style="width:100px;object-fit: contain;" src="admin/<?= $row['logo_picture']; ?>">
            </div>
             <?php } ?>
         

        </div>
    </div>

    </main>
    <script>
        document.querySelector('.floating-button').addEventListener('click', function() {
            var isLoggedIn = true;

            if (isLoggedIn) {
                window.location.href = 'https://api.whatsapp.com/send?phone=9837093712';
            } else {
                alert('Please login to access the chat feature.');
            }
        });
    </script>

    <?php include('components/footer.php') ?>
</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    let anime = AOS.init();


    if (!sessionStorage.getItem('pageLoaded')) {

        AOS.init();

        sessionStorage.setItem('pageLoaded', 'true');
    } else if (sessionStorage.getItem('pageLoaded')) {
        anime = false;
    }
    document.getElementById('slider').style.animationDuration = '10s'; // Adjust duration as needed
</script>


</html>
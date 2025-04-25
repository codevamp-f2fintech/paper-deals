<?php session_start();
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('connection/config.php');
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
    <title>NEWS-
        <?php echo site_name ?>
    </title>
</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">News</h1>
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
                    <a href="#">News</a>

                </ul>
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
           
            width:95% !important;
            margin:auto;
            justify-content:start;
            gap:14px;
        } 
         
     }
</style>

    <!-- Latest News -->
     <section class="lnsection ">
        <div class="lnsection1  mx-auto  news">
            <!--<div class="head">-->
            <!--    <h3 class="font-extrabold text-2xl md:text-4xl">-->
            <!--        <span style="color:white;">Latest</span>-->
            <!--        <span class="text-400" style="color:white;">NEWS</span>-->
            <!--    </h3>-->
            <!--</div>-->
 <div class="ln_clmbx flex justify-start flex-wrap">
            <!--<div class="ln_clmbx grid grid-cols-1 md:grid-cols-3 gap-6">-->
                <?php
                $query = "SELECT * FROM `news` ORDER BY `news`.`date` DESC";
                $query_run = mysqli_query($conn, $query);
                $Item = mysqli_num_rows($query_run) > 0;
                if ($Item) {
                    while ($prod_item = mysqli_fetch_assoc($query_run)) {
                ?>
                          <div class="sellbx" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                <div class="h-full flex items-start" style="height:85%;">
                                
                                    <div class="grow ">
                                        <a class="inline-flex items-center" style=";height:250px;width:100% !important;">
                                            <img alt="paperdeals" src="<?= $prod_item["image"]; ?>"
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
        <?php 
            // show pagination
            $sql1 = "SELECT * FROM news";
            $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

            // if (mysqli_num_rows($result1) > 0) {

            //     $total_records = mysqli_num_rows($result1);

            //     $total_page = ceil($total_records / $limit);

            //     echo '<ul class="pagination">';
            //     if ($page > 1) {
            //         echo '<li><a class="button" id="previous" href="news.php?page=' . ($page - 1) . '">Previous</a></li>';
            //     }
            //     for ($i = 1; $i <= $total_page; $i++) {
            //         if ($i == $page) {
            //             $active = "active";
            //         } else {
            //             $active = "";
            //         }
            //         echo '<li class="' . $active . '" id="number"><a class="num" href="news.php?page=' . $i . '">' . $i . '</a></li>';
            //     }
            //     if ($total_page > $page) {
            //         echo '<li><a class="button" id="next" href="news.php?page=' . ($page + 1) . '">Next</a></li>';
            //     }

            //     echo '</ul>';
            // }
            ?>
            <style>
                /*.pagination a {*/
                /*    color: black;*/
                /*    float: left;*/
                /*    padding: 8px 14px;*/
                /*    text-decoration: none;*/
                /*}*/

                /*.num:hover {*/
                /*    background-color: #00ff9d;*/
                /*}*/

                /*.pagination {*/
                    /* transform: translate(120%, -84%); */
                /*    margin: 5%;*/
                /*    display: flex;*/
                /*    justify-content:center;*/

                /*}*/

                /*.button {*/
                /*    background-color: #84746c;*/
                /*    border: 1px solid black*/
                /*}*/



                /*.active {*/
                /*    background-color: blue;*/
                /*}*/

                /*#previous {*/
                /*    padding: 8px 14px;*/
                /*}*/

                /*.pagination.active {*/
                /*    background-color: #007bff;*/
                    /* Change this to the desired active color */
                /*    color: #fff;*/
                    /* Change this to the desired text color for active state */
                /*}*/
            </style>
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
    <?php include ('components/footer.php'); ?>
</body>

</html>
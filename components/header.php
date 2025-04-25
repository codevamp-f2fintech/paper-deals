<?php
include("connection/config.php");
date_default_timezone_set("Asia/Calcutta");

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href='./assets/css/Index-responsive.css' />
<link rel="stylesheet" href="./responsive.css">
<link rel="stylesheet" href="sidebar.css">

<script async src="https://www.googletagmanager.com/gtag/js?id=G-1YE0Y7CEDL"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-1YE0Y7CEDL');
</script>

<style>
  .slider_section {
    position: relative;
    overflow: hidden;
  }

  .slider_images {
    display: flex;
    animation: slide 10s infinite;
  }

  .slider_image {
    flex: 1;
    height: 100vh;
    background-size: cover;
    background-position: center;
  }

  @keyframes slide {
    0% {
      transform: translateX(0);
    }

    33.33% {
      transform: translateX(-100%);
    }

    66.66% {
      transform: translateX(-200%);
    }

    100% {
      transform: translateX(-300%);
    }
  }

  .floating-button {
    display: none !important;
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

  .text-blue-400 {
    color: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%)
  }


  .social-link:hover+.link-a {
    color: red;
  }

  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 50px;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.5);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    position: relative;
    margin: auto;
    padding: 0;
    width: 95%;
    max-width: 60rem;
    max-height: 33rem;
    overflow: hidden;
    border-radius: 2px;
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    /* animation-duration: 0.4s; */


    background: #fff;
    -webkit-box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);
    -moz-box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);
    box-shadow: 0px 0px 19px 3px rgba(0, 0, 0, 0.08);

    display: flex;
    align-items: center;
    justify-content: space-between;
  }



  .modal-content-left {
    flex: 2;
    margin-top: -12rem;
  }

  .modal-content-left img {
    width: 40rem;
    max-width: 95%;
    margin: 0;
    padding: 0;
    display: block;
    border-radius: 2px;
  }

  .modal-content-right {
    flex: 2;


  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {
      top: -300px;
      opacity: 0;
    }

    to {
      top: 0;
      opacity: 1;
    }
  }

  @keyframes animatetop {
    from {
      top: -300px;
      opacity: 0;
    }

    to {
      top: 0;
      opacity: 1;
    }
  }

  /* The Close Button */
  .close,
  .close-imp {
    color: #000;
    font-size: 3.4rem;
    font-weight: bold;
    padding: 0 1rem;
    border-radius: 2px;
    margin: -50px;
    transition: 0.4s ease-out;
  }


  .close:hover,
  .close:focus,
  .close-imp:hover,
  .close-imp:focus {
    color: #111;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-header {
    display: flex;
    justify-content: space-between;

    font-size: 3.5rem;
    margin: 0;
    padding: 0;
  }

  .modal-header p {
    margin: 0;
    padding: 0;
  }






  /* ===== Page Content ===== */

  .container {
    width: 100%;
  }

  /* The Button */

  .btn {
    display: block;
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
    color: #fff;
    padding: 1rem 2rem;
    /*border: 1px solid #222;*/
    font-size: 2rem;
    margin: 1rem auto;
    transition: all 0.4s ease-in;
  }

  .btn:hover {
    cursor: pointer;


  }



  @media screen and (max-width: 868px) {


    .topheader {
      display: none;
    }

    .contact-info {
      display: none;
    }



    .mobile-menu-toggler {
      display: block;
    }

    .navmenu {
      display: none;
    }


    #mobileMenu {
      display: none;
      position: fixed;
      top: 56px;
      left: 0;
      width: 100%;
      background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
      z-index: 999;
      padding: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }


    .mobile-menu-toggler:active+#mobileMenu,
    .mobile-menu-toggler+#mobileMenu:target {
      display: flex;

      flex-direction: column;
      align-items: center;
    }

    #mobileloginMenu {
      display: none;
    }


    .mobile-menu-toggler:active+#mobileMenu #mobileloginMenu,
    #mobileloginMenu:target {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  }

  .logo {
    /* width: 100px; */
    height: 100px;
    /* border-radius:100%; */

    /* animation: scroll 10s linear infinite; */
  }

  .slide-track {
    width: 100%;
    display: flex;
    gap: 1em;
    overflow: hidden;
    justify-content: center
  }

  .slider {

    background-color: white;
    padding: 2em 2em;
  }

  @keyframes scroll {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translatex(-1000%)
    }
  }


  .socials-link {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    width: 32%;


  }

  .fa {
    font-size: 26px;
    color: #0c0c0d;
  }


  .menu {
    width: 100%;
  }

  .menu-container {
    margin: 0 auto;
    background: #fff;
  }

  #newlis {
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
    border-radius: 7px;
    color: #fff;
  }

  #casa {
    justify-content: center;
    display: flex;

    border: 2px solid;
    /* Remove linear-gradient here */
    border-image: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%) 1;
  }

  .menu a.logo {
    display: inline-block;
    padding: 1.5em 3em;
    width: 19%;
    float: left;
  }

  .mainlogo {

    width: 15vw;
    padding: 7px 7px;
    margin: 0px 33px;
  }

  .menu img {
    max-width: 100%;
  }

  .menu-mobile {
    display: none;
    padding: 20px;
  }

  .menu-mobile:after {
    content: "\2630";
    font-family: "Ionicons";
    font-size: 2.5rem;
    padding: 0;
    float: right;
    position: relative;
    top: 50%;
    -webkit-transform: translateY(-25%);
    transform: translateY(-25%);
    z-index: 10000;
  }

  .menu-dropdown-icon:before {
    /* content: "\f489"; */
    font-family: "Ionicons";
    display: none;
    cursor: pointer;
    float: right;
    padding: 1.5em 2em;
    background: #fff;
    color: #333;
  }

  .bg-header {
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
  }

  .topheader {
    background-color: #f8f9fa;
  }

  .topheader .container {
    max-width: 100%;
    padding-left: 15px;
    padding-right: 15px;
    margin-left: auto;
    margin-right: auto;
  }

  .topheader .leftmenu a,
  .topheader .social a {
    color: white;
    text-decoration: none;
  }

  .topheader .leftmenu a:hover,
  .topheader .social a:hover {
    color: #ea580c;
  }

  .topheader .leftmenu,
  .topheader .social {
    display: flex;
    align-items: center;
  }

  .topheader .leftmenu .space-x-5>*+* {
    margin-left: 1.25rem;
  }

  .topheader .social ul {
    padding: 0;
    margin: 0;
    list-style: none;
  }

  .topheader .social ul li {
    display: inline-block;
  }

  .topheader .social ul li+li {
    margin-left: 0.75rem;
  }

  .topheader .social ul li a {
    color: white;
  }

  .topheader .social ul li a:hover {
    color: #ea580c;
  }

  .menu>ul {
    margin: auto;
    width: 70%;
    list-style: none;
    padding: 0;
    position: relative;
    /* IF .menu position=relative -> ul = container width, ELSE ul = 100% width */
    box-sizing: border-box;
    /*clear: right;*/
  }

  .menu>ul:before,
  .menu>ul:after {
    content: "";
    display: table;
  }

  .menu>ul:after {
    clear: both;
  }

  .menu>ul>li {
    float: left;
    background: #fff;
    padding: 0;
    margin: 0;
  }

  .menu>ul>li a {
    text-decoration: none;
    padding: 5px 22px;
    display: block;
  }

  .menu>ul>li a:hover {
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);

  }

  .menu>ul>li>ul {
    display: none;
    width: 40%;
    background: #fff;
    padding: 20px;
    position: absolute;
    z-index: 99;
    right: 22%;
    margin: -16px 13%;
    list-style: none;
    box-sizing: border-box;
    top: 175%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

    border-radius: 7px;
  }

  .menu>ul>li>ul:before,
  .menu>ul>li>ul:after {
    content: "";
    display: table;
  }

  .menu>ul>li>ul:after {
    clear: both;
  }

  .menu>ul>li>ul>li {
    margin: 0;
    padding-bottom: 0;
    list-style: none;
    width: 25%;
    background: none;
    float: left;
  }

  .menu>ul>li>ul>li a {
    color: #000;
    padding: .2em 0;
    width: 95%;
    display: block;
    /* padding-left: 20px; */

    /*border-bottom: 1px solid #ccc;*/
  }

  .menu>ul>li>ul>li a:hover {

    background-color: lavender
  }

  .menu>ul>li>ul>li>ul {
    display: block;
    padding: 0;
    margin: 10px 0 0;
    list-style: none;
    box-sizing: border-box;


  }

  /* .menu > ul > li > ul > li > ul:before,
.menu > ul > li > ul > li > ul:after {
  content: "";
  display: table;
}
.menu > ul > li > ul > li > ul:after {
  clear: both;
} */
  .menu>ul>li>ul>li>ul>li {
    float: left;
    width: 100%;
    padding: 10px 0;
    margin: 0;
    font-size: .8em;
    display: block;
  }

  .menu>ul>li>ul>li>ul>li a {
    border: 0;
    font-size: 14px;
  }

  .menu>ul>li>ul.normal-sub {
    width: 300px;
    left: auto;
    padding: 10px 20px;
  }

  .menu>ul>li>ul.normal-sub>li {
    width: 100%;
  }

  .menu>ul>li>ul.normal-sub>li a {
    border: 0;
    text-align: center
  }

  .contact-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
  }

  .left-content a {
    margin-right: 10px;
    text-decoration: none;
    color: #fff;

  }

  .right-content p {
    margin: 0;
    color: #fff;
  }

  .phon {
    padding-right: 52px;
  }

  /* ––––––––––––––––––––––––––––––––––––––––––––––––––
Mobile style's
–––––––––––––––––––––––––––––––––––––––––––––––––– */
  @media only screen and (max-width: 959px) {
    .menu-container {
      width: 100%;
    }

    .menu-container .menu {
      display: inline-block;
    }

    .menu-mobile {
      display: block;
      padding: 0px;
      height: 21px;
    }

    .menu-dropdown-icon:before {
      display: block;
    }

    .menu>ul {
      display: none;
      width: 100%;
      margin: 0px;
    }

    .menu>ul>li {
      width: 100%;
      float: none;
      display: block;
      padding-left: 20px;
    }

    .menu>ul>li a {
      /* padding: 1.5em; */
      width: 100%;
      display: block;
    }

    .menu>ul>li>ul {
      margin: 0px 90px;
      position: relative;
      padding: 15px 40px;
    }

    .menu>ul>li>ul.normal-sub {
      width: 100%;
    }

    .menu>ul>li>ul>li {
      float: none;
      width: 100%;
      padding-left: 20px;
      margin-top: 20px;
    }

    .menu>ul>li>ul>li:hover {

      background-color: lavender;
    }

    .menu>ul>li>ul>li:first-child {
      margin: 0;
    }

    .menu>ul>li>ul>li>ul {
      position: relative;
    }

    .menu>ul>li>ul>li>ul>li {
      float: none;
    }

    .menu .show-on-mobile {
      display: block;
    }
  }

  .assoc {

    font-size: 3rem;
    text-align: center;
    padding: 1em;
  }

  .icon {
    color: white;
    font-size: 20px;
  }

  @media only screen and (max-width: 600px) {
    .assoc {
      font-size: 24px;

    }

    .logo {
      height: 70px;
    }

    .phon {
      padding: 6px;
      font-size: 13px;
    }

    .mainlogo {
      width: 68vw;
      padding: 7px 7px;
    }

    .slider_bx {
      margin: -30px 73px;

      text-align: center;
      width: 300px;
    }

    /*.w-full {*/
    /*  height: 300px;*/
    /*}*/

    /* .slider-img {
      height: 300px;
    } */

    .contact-section {
      display: block;
    }

    .left-content {
      display: flex;
      justify-content: space-evenly;
    }

    .right-content {
      display: flex;
      justify-content: center;
      margin-top: 6px;
    }

    .icon {
      font-size: 13px;
      margin-top: 9px;
      margin-left: 32px;
    }

    .mt-\[70px\] {
      margin-top: 0px;
    }

    .lnsection {
      padding: 0px;
    }

    .menu>ul {
      position: absolute;

      z-index: 10;
    }

    .srch_sectn .cstm_tab .btn {
      font-size: 16px;
    }

    .srch_sectn .tabcontent .flex .sell {
      height: 450px;

    }

  }


  .text-gl {
    color: #1078FF;
  }

  .text-bl {
    color: #1078FF;
  }

  .submenu {
    display: none;
    position: absolute;
    top: 0px;
    left: 20%;
    padding: 2px 0px;
    width: 180px;
    clear: both;
    margin-left: 6%;
    height: 100%;
    border-left: 2px solid;
    padding-top: 20px;

    /* background: lightcoral; */

  }

  .submenu>li {
    font-size: 15px;

    padding: 12px 10px;
    cursor: pointer;
    width: 100%;


  }

  .submenu>li:hover {
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);
  }

  .galry {


    font-size: 16px;




  }

  .galry:hover .submenu {
    display: block;
  }
</style>
<section class="contact-section top-head ">
  <div class="left-content">
    <a href="support.php">Support</a>
    <a href="javascript:void(0);" id="myBtn">Request Call</a>
  </div>

  <div class="right-content" style="display:flex;">
    <div class="right-content-1" style="display:flex;">
      <i class="fa fa-phone mr-[12px] icon"></i>
      <p class="phon">9837093712</p>
    </div>
    <div class="right-content-1" style="display:flex;">
      <i class="fa fa-envelope mr-[12px] icon"></i>
      <a href="mailto:support@paperdeals.in">
        <p class="phon"> support@paperdeals.in</p>
      </a>
    </div>
  </div>
</section>


</div>

<link rel="styleSheet" href="resposnive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  /* Place your CSS styles in this file */



  .mmm-nav {
    background-color: #fff;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 5px 75px 5px 24px !important;
    gap: 100px;
    /* width:100%; */

  }

  .mmm-nav a {
    color: #000;
    border-radius: 20px;
  }

  .site-logo {
    width: 500px;
    height: 100%;

  }

  .site-logo>img {
    width: 60%;

    object-fit: contain;
  }

  nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    white-space: nowrap;
  }

  nav .mainMenu>li {
    display: inline-block;
    margin-left: -5px;
  }

  nav a {
    margin: 0;
    text-align: left;
    padding: 8px 15px;
    /* background-color:  */
    /* color:#000; */
    text-decoration: none;
    position: relative;
    display: block;
  }

  nav li:hover>a {
    background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);

    cursor: pointer;
    color: #fff;
  }

  nav .subMenu {
    position: absolute;
    z-index: 9999;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    display: none;
    border-radius: 10px;
    width: 206px;
    min-height: 200px;


  }

  nav .subMenuu {
    position: absolute;
    z-index: 9999;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    display: none;
    border-radius: 10px;
    width: 150px;
    overflow-y: auto;
    /* height: 300px; */


  }

  nav .subMenu a {
    color: #000;
    border-radius: 0px;
  }

  nav .subMenuu a {
    color: #000;
    border-radius: 0px;
  }

  #superSubMenu {
    position: absolute;
    display: none;
    z-index: 9999;
    width: 268px;
    min-height: 200px;
    overflow-y: auto;
    scrollbar-width: thin;
    /* For Firefox */
    scrollbar-color: #666666 #ebebeb;

  }

  #superSubMenuu {
    position: absolute;
    display: none;
    z-index: 9999;
    width: 268px;
    min-height: 200px;
    overflow-y: auto;
    scrollbar-width: thin;
    /* For Firefox */
    scrollbar-color: #666666 #ebebeb;

  }

  .subMenuu::-webkit-scrollbar,
  #superSubMenu::-webkit-scrollbar {
    width: 4px;

    height: 4px;

  }

  #superSubMenu::-webkit-scrollbar-thumb,
  .subMenuu::-webkit-scrollbar-thumb {
    background-color: #666666;

    border-radius: 2px;

    opacity: 0.7;

  }

  #superSubMenu::-webkit-scrollbar-track,
  .subMenuu::-webkit-scrollbar-track {
    background: #ebebeb;
    border-radius: 2px;

  }

  /* Remove the arrows */
  #superSubMenu::-webkit-scrollbar-button,
  .subMenuu::-webkit-scrollbar-button {
    display: none;

  }


  nav .mainMenu>li:hover .subMenu,
  nav .subMenu>li:hover>#superSubMenu {
    display: block;

  }

  nav .subMenu>li:hover>#superSubMenuu {
    display: block;

  }

  nav .mainMenu>li:hover>.subMenuu {
    display: block;
  }

  nav #superSubMenuu {
    top: 0;
    left: 53%;
    right: 0;
    z-index: 9999;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;

  }

  nav #superSubMenu {
    top: 0;
    left: 93%;
    right: 0;
    z-index: 9999;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 3px 8px;

  }
</style>
<header class="mmm-nav">
  <a href="./">
    <div class="site-logo">

      <img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/logo+(2).jpg" alt="">
      <div>hello</div>
    </div>
  </a>
  <div>
    <nav>
      <ul class="mainMenu">
        <li><a href="./">Home</a></li>
        <li><a href="spot_price.php">Live Stock</a></li>
        <li><a href="search.php?tab=buyer">Buyer</a></li>
        <li><a href="search.php?tab=seller">Seller</a></li>
        <li><a>Category <i class="fa-solid fa-angle-down"></i></a>
          <ul class="subMenu">
            <?php
            $query = "SELECT * FROM new_category WHERE status=1";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
              while ($category = mysqli_fetch_assoc($query_run)) {
            ?>
                <li><a href="search.php?tab=seller&category_id=<?= $category['name']; ?>"><?= $category['name']; ?></a>
                  <ul class="superSubMenu" id="superSubMenu">
                    <?php
                    $category_id = $category['id'];
                    $product_query = "SELECT pn.product_name 
                                          FROM product_new pn 
                                          JOIN new_category nc ON pn.category_id = nc.id 
                                          WHERE pn.status = 1 AND nc.status = 1 AND pn.category_id = $category_id";
                    $product_query_run = mysqli_query($conn, $product_query);
                    if (mysqli_num_rows($product_query_run) > 0) {
                      while ($product = mysqli_fetch_assoc($product_query_run)) {
                    ?>
                        <li><a href="search.php?tab=seller&p_name=<?php echo $product['product_name']; ?>&cate_id=<?= $category['name']; ?>"><?= $product['product_name']; ?></a></li>
                    <?php
                      }
                    } else {
                      echo "<li>No products found</li>";
                    }
                    ?>
                  </ul>
                </li>
            <?php
              }
            } else {
              echo "<li>No categories found</li>";
            }
            ?>
          </ul>
        </li>

        <li><a href="consultants.php">Consultant</a></li>
        <li><a href="news.php">News <i class="fa-solid fa-angle-down"></i></a>
          <ul class="subMenu">
            <li><a href="news.php">News</a>

            </li>
            <li><a href="#">Events</a>
              <ul class="superSubMenuu" id="superSubMenuu">
                <li><a href="image.php">Image</a></li>
                <li><a href="videos.php">Videos</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="./contact_us.php">Contact Us</a></li>
        <?php if (isset($_SESSION['id'])) {
          $loginid = $_SESSION['id'];

          $login_users = mysqli_query($conn, "select id,name from users where id ='$loginid'");
          $data_user = mysqli_fetch_assoc($login_users);

        ?>
          <li><a href="admin/index.php"><?php echo $data_user['name']; ?></a>
          <?php } else {  ?>
          <li><a href="#">Log In <i class="fa-solid fa-angle-down"></i></a>
            <ul class="subMenuu">

              <li><a href="login.php?userType=buyer">Buyer</a></li>
              <li><a href="login.php?userType=seller">Seller</a></li>

            <?php } ?>


            </ul>
          </li>
      </ul>



    </nav>
  </div>
</header>




<div class="mobile-navbar">
  <div class="mob-naav">
    <div class="mobile-img">
      <a href="./">
        <img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/logo+(2).jpg" alt=""></a>
    </div>
    <div class=" menu-btn" id="for-mobile">
      <i class="fas fa-bars"></i>
    </div>
  </div>
</div>


<div class="mine">
  <div class="side-barr">
    <header>
      <div class="close-btn">

        <i class="fas fa-times"></i>
      </div>

      <h1></h1>
    </header>
    <div class="menu">
      <div class="itemm"><a href="./"><i class="fa-solid fa-house"></i>Home</a></div>
      <div class="itemm"><a href="spot_price.php"><i class="fa-solid fa-arrow-up-wide-short"></i>Live Stock</a></div>
      <div class="itemm"><a href="search.php?tab=buyer"><i class="fa-solid fa-user"></i>Buyer</a></div>
      <div class="itemm"><a href="search.php?tab=seller"><i class="fa-solid fa-user"></i>Seller</a></div>
      <div class="itemm">
        <a class="sub-btnnn"><i class="fa-solid fa-list"></i>Category<i class="fas fa-angle-right dropdown"></i></a>
        <div class="sub-menu">
          <?php
          $query = "SELECT * FROM new_category WHERE status=1";
          $query_run = mysqli_query($conn, $query);
          if (mysqli_num_rows($query_run) > 0) {
            while ($category = mysqli_fetch_assoc($query_run)) {
          ?>
              <a href="search.php?tab=seller&category_id=<?= $category['name']; ?>" class="sub-btn"><i
                  class="fas fa-table"></i><?= $category['name']; ?><i class="fas fa-angle-right dropdown"></i></a>
              <div class="sub-menu">
                <?php
                $category_id = $category['id'];
                $product_query = "SELECT pn.product_name 
                                      FROM product_new pn 
                                      JOIN new_category nc ON pn.category_id = nc.id 
                                      WHERE pn.status = 1 AND nc.status = 1 AND pn.category_id = $category_id";
                $product_query_run = mysqli_query($conn, $product_query);
                if (mysqli_num_rows($product_query_run) > 0) {
                  while ($product = mysqli_fetch_assoc($product_query_run)) {
                ?>
                    <a href="search.php?tab=seller&product_name=<?php echo $product['product_name']; ?>" class="sub-btn"><i class="fas fa-table"></i><?= $product['product_name']; ?></a>
                <?php
                  }
                } else {
                  echo "<a class='sub-btn'>No products found</a>";
                }
                ?>
              </div>
          <?php
            }
          } else {
            echo "<a class='sub-btn'>No categories found</a>";
          }
          ?>
        </div>
      </div>

      <div class="itemm"><a href="consultants.php"><i class="fa-solid fa-user"></i></i>Consultant</a></div>
      <div class="itemm">
        <a class=" sub-btnnn"><i class="fa-solid fa-newspaper"></i>News<i class="fas fa-angle-right dropdown"></i></a>
        <div class="sub-menu">
          <a href="news.php" class="sub-itemm">News</a>
          <a href="image.php" class="sub-btn"><i class="fa-solid fa-vault"></i>Image<i
              class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="image.php" class="sub-btn"><i class="fa-solid fa-image"></i>Image</a>
            <a href="videos.php" class="sub-btn"><i class="fa-solid fa-video"></i>Video</a>

          </div>
        </div>
      </div>
      <div class="itemm"><a href="contact_us.php"><i class="fa-solid fa-address-book"></i>Contact Us</a></div>
      <div class="itemm">
        <a class="sub-btnnn"><i class="fa-solid fa-right-to-bracket"></i>Log In<i
            class="fas fa-angle-right dropdown"></i></a>
        <div class="sub-menu">
          <a href="login.php?userType=buyer" class="sub-itemm"><i class="fa-solid fa-user"></i> Buyer</a>
          <a href="login.php?userType=seller" class="sub-itemm"><i class="fa-solid fa-user"></i> Seller</a>

        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {

      // jQuery for toggle sub menus for sub-btnnn
      $('.sub-btnnn').click(function() {
        // Close other open sub-menus for sub-btnnn
        $('.sub-btnnn').not(this).next('.sub-menu').slideUp();
        $('.sub-btnnn').not(this).find('.dropdown').removeClass('rotate');

        // Toggle the clicked sub-menu
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });

      // jQuery for toggle sub menus for sub-btn
      $('.sub-btn').click(function() {
        // Close other open sub-menus for sub-btn
        $('.sub-btn').not(this).next('.sub-menu').slideUp();
        $('.sub-btn').not(this).find('.dropdown').removeClass('rotate');

        // Toggle the clicked sub-menu
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });

      // jQuery for expand and collapse the sidebar
      $('.menu-btn').click(function() {
        $('.side-barr').addClass('active');
        $('body').css({
          overflow: 'hidden',
          height: '100%'
        }); // Prevent body from scrolling
        $('.menu-btn').css("visibility", "hidden");
      });

      $('.close-btn').click(function() {
        // Reset sidebar to default state
        $('.side-barr').removeClass('active');
        $('body').css({
          overflow: 'auto',
          height: 'auto'
        }); // Allow body to scroll again
        $('.menu-btn').css("visibility", "visible");

        // Reset sub-menus
        $('.sub-menu').slideUp();
        $('.dropdown').removeClass('rotate');
      });
    });
  </script>




</div>
</div>
</nav>
<script src="slider.min-js.js"></script>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8CSS95B"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
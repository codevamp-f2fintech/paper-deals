<?php session_start();
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
    include ("connection/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone_number = $_POST["phone"];

        // Remove all characters except digits
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number);

        // Check if the phone number is exactly 10 digits
        if (strlen($phone_number) === 10) {
            echo "Phone number is valid: " . $phone_number;
        } else {
            echo "Please enter a valid 10-digit phone number.";
        }
    }


    ?>
    <title>Support-
        <?php echo site_name ?>
    </title>
</head>
<style>
    @media only screen and (min-width: 300px) and (max-width: 574px) {
        .contacta>h1 {
            font-size: 23px;
        }

        .contacta>p {

            width: 217px !important;
        }

        .contacta>p {
            font-size: 11px;
            text-wrap: wrap;
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

        .sign_upsctn>.container>.sgnupbx {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;

        }

        .sign_upsctn>.container>.sgnupbx>.sell {
            width: 97%;
            margin: auto;
            /* border: 1px solid; */
        }

        .sign_upsctn>.container>.sgnupbx>.sgn_frm {
            width: 100%;
            /* border: 1px solid red; */
            padding: 0 10px;
            height: 420px;

        }

        .sign_upsctn>.container>.sgnupbx>.sgn_frm>.head>h1 {
            font-size: 25px;

        }

        .content {
            width: 100%;
        }

        #contaact {
            width: 98%;
            margin: 4vh auto;
        }



        #contactt {
            /* border: 5px solid red; */
            width: 100%;
            height: 270px !important;
        }

        #con-sec {

            width: 100%;
            margin-bottom: 1%;
        }

        #immag {
            width: 270px;
            margin: auto;
        }
    }

    /* ============================================================== */
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

    @media only screen and (min-width: 576px) and (max-width: 990px) {
        .HeaderSearch__globalSearchLanding--ompUH {
            width: 100%;
        }

        #contaact {
            width: 98%;
            margin: auto;
            margin: 4vh auto;
        }

        #contactt {
            width: 98%;
        }

        #con-sec {
            width: 98%;
        }
    }

    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .HeaderSearch__globalSearchLanding--ompUH {
            width: 100%;
        }

        #contaact {
            width: 70%;
            margin: 4vh auto;

        }

        #main_cont {
            display: flex;
        }

        #immag {
            width: 260px;
            margin: auto;
        }
    }

    @media only screen and (min-width: 1200px) {
        .HeaderSearch__globalSearchLanding--ompUH {
            width: 100%;
        }

        #contact {
            border: 1px solid;
        }

        #contaact {
            width: 68%;
            display: flex;
            margin: 4vh auto;
        }

        #main_cont {
            margin: auto;
            display: flex;
        }
    }
</style>

<body>
    <?php include ('components/header.php') ?>

    <main class="md:mt-0">
        <!-- Page Header -->
        <section
            class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Disclaimer</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <p>Disclaimer</p>
                </ul>
            </div>
        </section>

       <div class="container mx-auto p-8 bg-white">
        <h1 class="text-3xl font-bold mb-6">Disclaimer</h1>
        <!--<h2 class="text-2xl font-semibold mb-4">Clarifying Information and Limiting Liability</h2>-->

        <p class="mb-4">Any participation in this site will constitute acceptance of this agreement. If you do not agree to abide by the below, please do not use this site. These terms of use (Terms of Use) constitute a legal and binding contract between you and the company (Kay Paper deals Pvt Ltd) with regard to the use of (a) Company's website (www.paperdeals.in); (b) any service that may be provided by the Company using the Website (a), (b) above collectively, the "Services").</p>
        <p class="mb-4">The company allows, amongst others, Buyers and Sellers to list their products on the website and use platform for process , documentation and business thereof .</p>
        <p class="mb-4">In these Terms of Use, references to "you" or "your" or "User" shall mean the user subscribing to or using the services and "we", "us", "our" or "Paper deals" shall mean the Company.</p>
        <p class="mb-4">These Terms of Use are applicable to all the services provided by the company. In addition to these Terms of Use and depending on the services opted for by the user, the user may be required to read and accept or may have read and accepted, additional terms and conditions of service (TOS) for each such service and/or may be required to execute or may have executed, additional agreements with the company (Additional Agreements).</p>
    </div>
        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div
                class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a solution
                    meeting your budget and requirement</p>
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
    <!-- ================= -->



    <script>
        function validateForm() {
            var phoneInput = document.getElementById("phone").value;
            var phonePattern = /^\d{10}$/; // Regular expression for 10-digit phone number

            if (!phonePattern.test(phoneInput)) {
                alert("Please enter a valid 10-digit phone number.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</body>
<?php include ('components/footer.php') ?>


</html>
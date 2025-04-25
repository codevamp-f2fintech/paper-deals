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

            width: 100% !important;
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
                <h1 class="text-2xl md:text-4xl font-bold text-white">Paper Deals Contact</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <p>Contact Us</p>
                </ul>
            </div>
        </section>

        <!-- Page Content -->
        <section class="my-20 mx-auto    min-h-[60vh] px-4 lg:px-0" id="contaact">
            <form action=" submit.php" method="POST" onsubmit="return validateForm()">
                <div class="w-full " id="main_cont">
                    <div class="content  p-5 bg-gradient-to-br from-blue-600 to-teal-400 text-white w-full md:w-[50%]  "
                        id="contactt">
                        <div class="sm:w-[80px]  md:w-[400px] mx-auto md:my-20 sm:my-2">
                            <img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/undraw_terms_re_6ak4+(1).svg" id="immag" alt="">
                        </div>
                    </div>

                    <div class="flex flex-col  min-h-[60vh]  p-5 w-full md:w-[50%] shadow-2xl  border overflow-hidden"
                        id="con-sec">
                        <!-- <i class="bi bi-person-fill-add text-5xl  "></i> -->
                        <!-- <i class="fa-duotone fa-address-book text-[#027ff0]"></i> -->
                        <!-- <i class="fa-duotone fa-address-book"></i> -->

                        <div class=" flex flex-col gap-1 contacta">
                            <h1 class=" font-semibold text-xl md:text-2xl pt-6" style="color: #1078FF;" ;><i
                                    class="fa-regular fa-address-book text-3xl text-[#027ff0]"></i> Contact Us </h1>
                            <p>For enquiry, complaint, deactivate or disable
                                account, remove or delete profile from mobile app and any other query submit your
                                request or message. our team will contact you soon and process your request.</p>
                        </div>
                        <!-- Alert Messages -->
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                            <div class="alert alert-success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                                <p class="mb-2"><strong>Message</strong></p>

                                <hr>
                                <p class="mt-2">You message has been recieved successfully, we will contact you soon.</p>

                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                            <div class="alert alert-danger">
                                <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                                <p class="mb-2"><strong>Message</strong></p>

                                <hr>
                                <p class="mt-2">Data Not inserted Due to some error</p>

                            </div>';
                        <?php } ?>
                        <!-- Form -->

                        <div class="  sm:mt-10 mt-8">

                            <div class="relative z-0 w-full mb-2">
                                <input type="text" name="name" id="name"
                                    class="rounded-xl border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label title="Full Name" for="name"
                                    class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Full
                                    Name</label>
                            </div>
                            <div class="relative z-0 w-full mb-2">
                                <input type="number" name="mobile_no" id="mobile_no"
                                    class="rounded-xl border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if(this.value.length==10) return false;" />
                                <label title="Phone Number" for="mobile_no"
                                    class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Enter
                                    your Register Mobile Number</label>
                            </div>
                            <div class="relative z-0 w-full mb-2">
                                <input type="email" name="email_id" id="floating_email"
                                    class="rounded-xl border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label title="Email" for="floating_email"
                                    class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Enter
                                    Your Email</label>

                            </div>

                            <div class="relative z-0 w-full">
                                <textarea type="text" name="message" id="message1"
                                    class="rounded-xl border-2 px-4 pt-5 pb-3 block h-[100px] resize-none w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" "></textarea>
                                <label title="Message"
                                    class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Message</label>
                            </div>

                        </div>
                        <!-- Submit button -->
                        <div class="text-center flex ml-[5px] mt-4  mb-4">
                            <button
                                class="py-2 w-full md:w-full rounded text-white border-[#027ff0] border hover:border hover:bg-white hover:text-[#000] duration-700"
                                type="submit" name="contact_us_submit" style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">Submit</button>
                        </div>
                    </div>
                </div>

            </form>

        </section>
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
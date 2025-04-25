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
    <title>Payment Policy

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
                <h1 class="text-2xl md:text-4xl font-bold text-white">Payment Policy</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <p>Payment Policy</p>
                </ul>
            </div>
        </section>

     <div class="max-w-7xl mx-auto bg-white p-6">
        <h1 class="text-2xl font-bold mb-4">Payments Policy Document</h1>

        <h2 class="text-lg font-semibold mb-2">Products and Services</h2>
        <p class="mb-4">
            In conformity with existing rules and policies, the Payment Gateway is used for subscription and booking of
            consultants only. PAPER DEALS, an online CRM platform, is used only for deal tracking and creating leads
            for sellers and buyers. There are no physical product deals through the payment gateway. Only services are
            used by the payment gateway; hence, no refund policy applies.
        </p>

        <h2 class="text-lg font-semibold mb-2">Privacy Policy</h2>
        <p class="mb-4">
            We at Paper deals understand the importance of protecting your private information and shall take
            necessary safeguards to protect your privacy. We recommend that all login details - User ID/Password, etc.
            made available to you from the portal - be kept confidential at your end. All policies related to privacy
            concerns are governed by the terms and conditions of the industries.
        </p>

        <h2 class="text-lg font-semibold mb-2">Payment Issues</h2>
        <h3 class="text-lg font-semibold mb-2">How to Pay</h3>
        <p class="mb-4">
            Online payments may be required for different activities like Profile buildup packages, Booking of
            consultants, etc. To make a payment, click on the payment button provided in the respective section. You
            will be directed to the payment gateway, where you can select various payment options like Debit Card,
            Credit Card, Net Banking, or Wallet/UPI from the bank where you hold your account. Choose the respective
            payment option and make your payment. Standard charges as per RBI guidelines will be deducted from the
            payer. Do not click the 'Refresh' or 'Cancel' buttons on the payment gateway.
        </p>
        <p class="mb-4">
            After a successful payment, a payment receipt shall be generated, which may be downloaded or printed. If
            the successful payment is not showing due to any reason like error in Internet connectivity or any other
            reason, please confirm with your bank account whether the amount has been deducted. Do not pay again
            immediately if there is any doubt, and check your bank account first to avoid double payment. If the
            payment has been deducted from your account but the receipt is not generated, please write an email to the
            Paper deals helpline email address or contact the authorities, specifying your registered mobile number,
            name, course, and date of payment.
        </p>

        <h3 class="text-lg font-semibold mb-2">Refund and Cancellation</h3>
        <p class="mb-4">
            Refunds/Cancellations: Our subscription is generally service based which includes display on user page
            (Premium or VIP) and is subscribed by user at his own will.. However, for booking consultation services,
            customer can seek consultation as per booking date and time. In case customer is not available as per his
            booking date and time, slot will not be transferrable and hence no refund will be given.
        </p>
        <p class="mb-4">
            However, if consultant is not available as per the booking time frame, the slot can be cancelled and
            customer will be refunded full amount. The amount will be credited back in 7 working days in customer bank
            account.
        </p>

        <h2 class="text-lg font-semibold mb-2">Payment Terms & Conditions</h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Amount is to be paid in Indian Rupees.</li>
            <li>Online payment on the payment gateway can be made using any available modes of online payment (Debit
                Card/Credit Card/Net Banking/Wallet/UPI, etc.) as per your convenience.</li>
            <li>It is the sole responsibility of the Users to ensure that payments for Booking/Profile Branding, as
                notified, are deposited within the stipulated time. Paper deals shall not be responsible for any delay
                in receipt of payment due to any reason.</li>
            <li>Payment gateway transaction charges are to be borne by the payee.</li>
            <li>In no event shall the Portal be liable for any damages whatsoever arising out of the use or inability
                to use the Online Payment System.</li>
            <li>Payment once paid will not be refunded under any circumstances. However, if there is any excess payment
                or multiple payment for any reason, the payer may file a claim for a refund with adequate proof of
                evidence. The final decision of settlement of any such claim shall rest with the authorities.</li>
            <li>Paper deals reserve the right to add or modify any of the above terms and conditions subsequently.</li>
        </ul>

        <h2 class="text-lg font-semibold mb-2">What to Do If Multiple Payments Are Made or Receipt Is Not Obtained</h2>
        <p class="mb-4">
            Users are advised to kindly check with their bank account in case of any doubt before making a second
            payment. Do not pay immediately for the second time if you have already done an online transaction and are
            unclear about the status of the payment.
        </p>
        <p>
            If the payment is successful but no receipt is obtained, or if, by mistake, a second or multiple payment
            has been made, the user can write to <a href="mailto:support@paperdeals.in"
                class="text-blue-500 underline">support@paperdeals.in</a>.
        </p>
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
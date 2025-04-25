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
    p{
        text-align: justify;

    }
</style>

<body>
    <?php include ('components/header.php') ?>

    <main class="md:mt-0">
        <!-- Page Header -->
        <section
            class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Privacy Policy</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <p>Privacy Policy</p>
                </ul>
            </div>
        </section>

       <div class="max-w-7xl mx-auto bg-white p-8">
        <h1 class="text-2xl font-bold mb-4">Introduction</h1>
        <p class="mb-4">
            This Policy is owned and operated by Kay Paper Deals Pvt Ltd henceforth referred to as “Paper deals” which includes its subsidiary, affiliates, successors and permitted assigns. In the course of using this website or availing the products and services via the online enquiry forms, Paper deals and its affiliates may become privy to the personal information of its users, including information that is of a confidential nature. Paper deals provides services to the users through the website and is committed to protecting and respecting the privacy of the users and has taken all necessary and reasonable measures to protect the confidentiality of the user information and its transmission through the World Wide Web. Paper deals shall not be held liable for disclosure of the confidential information if such disclosure is in accordance with this Privacy Policy (“Policy”) or in accordance with the terms of any agreements entered with the users. Paper deals also assures not to disclose all information that it learns during the transactions and payments made to the user’s account(s). “User(s)” shall mean and include all companies and private organizations that visit the website and provide information to Paper deals through any of the modes referred to in the clause on "Collection of Information" below. All words and expressions used in this policy shall have the meanings respectively assigned them in the prescribed Act.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Collection of Information</h2>
        <p class="mb-4">
            Paper deals shall obtain digital consent from the provider of the sensitive personal data or information regarding purpose of usage before collection of such information. During the use of the website, Paper deals may collect and process information from the users, including but not limited to the below mentioned:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>Information that the users provide to Paper deals by filling in enquiry forms on the website. This includes contact information such as name, email address, mailing address, phone number, financial information, Companies document, bank account number, password and preferences information such as favourites lists and transaction history;</li>
            <li>Information that the users provide when the users write directly to Paper deals (including by way of email, WhatsApp or messages);</li>
            <li>Information that the users provide to Paper deals over telephone;</li>
            <li>Paper deals may make and keep a record of the information shared by the users with Paper deals;</li>
            <li>When the user uses the website, Paper deals servers automatically record certain information that the user’s web browser sends whenever the user visits any website. These server logs may include information such as the user’s web request, Internet Protocol (IP) address, browser type, referring/exit pages and URLs, number of clicks, domain names, landing pages, pages viewed, and other such information. Paper deals uses this information, which may or may not identify users, to analyze trends, to administer the website, to track user’s movements around the website and to gather demographic information about the user base as a whole.</li>
        </ul>
        <p class="mb-4">
            While collecting information directly from the person concerned, Paper deals or any person on its behalf shall take such steps as are, in the circumstances, reasonable to ensure that the person concerned is having the knowledge of — (a) the fact that the information is being collected; (b) the purpose for which the information is being collected; (c) the intended recipients of the information. Paper deals or any person on its behalf shall, prior to the collection of information including sensitive personal data or information provide an option to the provider of the information to not to provide the data or information sought to be collected. The provider of information shall, at any time while availing the services or otherwise, also have an option to withdraw its consent given earlier to Paper deals. Such withdrawal of the consent shall be sent in writing to Paper deals. In the case of provider of information not providing or later on withdrawing his consent, Paper deals shall have the option not to provide goods or services for which the said information was sought.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Non-disclosure</h2>
        <p class="mb-4">
            Paper deals pledges that it shall not sell or rent users’ personal details to anyone. Paper deals will protect every bit of the users’ business or personal information and maintain the confidentiality of the same. Paper deals guarantees that it is going to keep all information confidential except in the following cases:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>Paper deals may disclose users’ information to governmental and other statutory bodies who have appropriate authorization to access the same for any specific legal purposes.</li>
            <li>Paper deals may disclose users’ information if it is under a duty to do so in order to comply with any legal obligation, or in order to enforce or apply the Terms of Use (displayed on the website), or to protect the rights, property or safety of Paper deals, its users or others. This includes exchanging information with other companies / agencies that work for fraud prevention and credit reference.</li>
            <li>Paper deals may disclose users’ information to its agents under a strict code of confidentiality.</li>
            <li>Paper deals may disclose users’ information to such third parties to whom it transfers its rights and duties under the customer agreement entered into with the users. In such an event, the said third parties’ use of the information will be subject to such confidentiality obligations as contained in this Policy.</li>
            <li>Paper deals may disclose users’ information to any member of its related or group companies including its subsidiaries, its ultimate holding company and its subsidiaries, as the case may be.</li>
            <li>In the event that Paper deals sells or buys any business or assets, it may disclose the users’ information to the prospective seller or buyer of such business or assets. User, email and visitor information are generally one of the transferred business assets in these types of transactions. Paper deals may also transfer or assign such information in the course of corporate divestitures, mergers or dissolution.</li>
        </ul>
        <p class="mb-4">
            Paper deals shall ensure that in case of disclosure of whole or part of the user’s information to a service provider or agent, within or outside India, the same shall be bound by obligations of confidentiality at least as strict as Paper deals’s obligations under this Privacy Policy and the information shall be accorded the same level of protection as provided by Paper deals under the terms of this Privacy Policy. Paper deals may store the user’s information in locations outside the direct control of Paper deals (for instance, on servers or databases co-located with hosting providers). Paper deals never will sell or rent personal information of its clients to anyone, at any time, for any reason. Paper deals may use the user’s personal information in the following ways, viz:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>Monitor, improve and administer the website and improve the quality of services; Analyze how website is used, diagnose service or technical problems, maintain security;</li>
            <li>Remember information to help the user effectively access the website;</li>
            <li>Monitor aggregate metrics such as total number of views, visitors, traffic and demographic patterns;</li>
            <li>To confirm the user’s identity in order to determine its eligibility to use the website and avail of the services;</li>
            <li>To notify the user about changes to the website;</li>
            <li>To enable Paper deals to comply with its legal and regulatory obligations;</li>
            <li>To help the user apply for certain products and services;</li>
            <li>For the purpose of sending administrative notices, service-related alerts and other similar communication with a view to optimizing the efficiency of the website;</li>
            <li>Doing market research, troubleshooting, protection against error, project planning, fraud and other criminal activity;</li>
            <li>For the purpose of initiating deals and subsequent processes thereof.</li>
            <li>To reinforce Paper deals’s Terms of Use.</li>
        </ul>
        <p class="mb-4">
            Access to personal information is strictly restricted and shared in accordance with certain specific internal procedures and safeguards that govern access. Certain features of the website are available for use without any need to provide details. Other features of the website may require users to provide details including but not limited to the user’s name, address, mobile number, email address, PAN No, GST, company details, employment & income details.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Security</h2>
        <p class="mb-4">
            The security of user’s personal information is important to Paper deals. Paper deals follows generally accepted industry standards to protect the personal information submitted to it, both during transmission and once Paper deals receives it. All information gathered on Paper deals is securely stored within the Paper deals controlled database. The database is stored on Cloud servers of AWS secured with highly secured layers and access to such servers is password protected and strictly limited based on need-to-know basis. However, as effective as security measures are, no security system is impenetrable. Paper deals cannot guarantee the security of its database, nor can Paper deals guarantee that information provided by users will not be intercepted while being transmitted to Paper deals over the internet. And, of course, any information users include in a posting to the discussion areas is available to anyone with internet access.
        </p>
        <p class="mb-4">
            Paper deals cannot ensure or warrant the security of any information the user transmits to Paper deals or guarantee that information on the website may not be accessed, disclosed, altered, or destroyed by breach of any of Paper deal’s physical, technical, or managerial safeguards.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Changes to this Policy</h2>
        <p class="mb-4">
            Paper deals reserves the right to update, modify and amend any terms of this Policy from time to time to reflect changes in the law, changes in Paper deal’s business practices, procedures and structure, and the community’s changing privacy expectations. When Paper deals posts changes to this Policy, Paper deals will revise the "last updated" date at the top of this Policy. Paper deals encourages users to periodically review this page for the latest information on Paper deal’s privacy practices. Any user who does not agree with any provision of this Policy is required to discontinue the use of the website immediately. The policy shall apply uniformly to Paper deal’s website and its mobile applications.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Contact Us</h2>
        <p class="mb-4">
            If you have any questions about this Policy, the practices of Paper deals or your dealings with the website, you can contact Paper deals at info@paperdeals.in or +911146351160.
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
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
                <h1 class="text-2xl md:text-4xl font-bold text-white">Terms & Conditions</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <p>Terms & Conditions</p>
                </ul>
            </div>
        </section>

       <div class="container mx-auto p-8 bg-white">
        <h1 class="text-3xl font-bold mb-4">Understand Our Guidelines and Agreements</h1>
        <p class="mb-4">
            PLEASE READ THESE WEBSITE TERMS OF USE CAREFULLY BEFORE USING THIS WEBSITE (HEREINAFTER 'WEBSITE'). THESE WEBSITE TERMS OF USE (HEREINAFTER 'TERMS OF USE') GOVERN YOUR ACCESS TO AND USE OF THE WEBSITE. THE WEBSITE IS AVAILABLE FOR YOUR USE ONLY ON THE CONDITION THAT YOU AGREE TO THE TERMS OF USE SET FORTH BELOW. IF YOU DO NOT AGREE TO ALL OF THE TERMS OF USE, DO NOT ACCESS OR USE THE WEBSITE. BY ACCESSING OR USING THE WEBSITE, YOU AND THE ENTITY YOU ARE AUTHORISED TO REPRESENT (HEREINAFTER 'YOU' OR 'YOUR') SIGNIFY YOUR AGREEMENT TO BE BOUND BY THE TERMS OF USE.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">User Eligibility</h2>
        <p class="mb-4">
            The Web Site is provided by Paper deals and available only to entities and persons who have reached the age of legal majority and are competent to enter into a legally binding agreement(s) under the applicable laws. If You do not qualify, you are not permitted to use the Web Site.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Scope of Terms of Use</h2>
        <p class="mb-4">
            These Terms of Use govern your use of the Website and all applications, software and services (collectively known as "Services") available via the Web Site, except to the extent that such Services are the subject of a separate agreement. Specific terms or agreements may apply to the use of certain Services and other items provided to You via the Web Site ("Service Agreement(s)"). Any such Service Agreements will accompany the applicable Services or are listed in association therewith or via a hyperlink associated therewith. You are prohibited from collecting email addresses or other contact information of other users, through any means whatsoever, without authorization from Paper deals; selling, cross-selling or distributing Services to any third party or allowing multi-user access to the Services by sharing your password and user identification; using any automated software, hardware or any other similar mechanism to use access, navigate or search the website and/or mobile application; and posting or transmitting any information on the website and/or mobile application including unauthorized or unsolicited advertising, promotional materials, or any other forms of unauthorized solicitation to other users (other than the information specifically permitted/ required to be posted or transmitted under these Terms of Use, TOS and/or Additional Agreements)
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Modifications / Amendments</h2>
        <p class="mb-4">
            We may, at any time, for any reason, without assigning such reason, without notice, make changes to the website, including its look, feel, format, and content (defined hereafter); the services provided through the website and the mobile application; and these Terms of Use. Any such modifications/amendments as provided for in clause above will take effect from the time they are posted on the website and/or the mobile application. By your continued usage of the website upon such changes being posted, to have accepted such changes.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Licence and Ownership</h2>
        <p class="mb-4">
            The website and each of its modules is the copyrighted property of Paper deals and/or its various third-party providers and distributors. The website contain material, which is protected by copyright and/or other intellectual property rights. Paper deals reserves all rights on the website and their content not specifically granted in TOS, additional agreements and/or these Terms of Use. Any software/ Document that is made available to download from the website is the copyrighted work of Paper deals and/or its various third-party providers and distributors. Your use of the software is governed by the terms of the end user license agreement, if any, which accompanies or is included with the software (License Agreement). You may not install or use any software that is accompanied by or includes a License Agreement unless you first agree to the License Agreement terms. For any software not accompanied by a License Agreement, Paper deals hereby grants to you, the User, a personal, non-exclusive, non-transferable, non-sublicensable, revocable license to use the Software for viewing and otherwise using the website and/or the mobile application in accordance with these Terms of Use and for no other purpose and such license may be terminated and revoked by Paper deals at any time for any reason. Please note that all software is owned by Paper deals and is protected by copyright laws and international treaty provisions. Any reproduction or redistribution of the software is expressly prohibited by law and may result in severe civil and criminal penalties “Paper deals.com”, and other Paper deals graphics, logos, taglines and service names are the intellectual property of Paper deals. Except as specifically permitted herein, these shall not be used by the user or any other person without the prior written permission from Paper deals. All other trademarks not owned by Paper deals that appear on the website are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by Paper deals. You may use and display any portion of the content available on the website (including without limitation text, graphics, software, audio and video files and photos) (Content) only on your personal computer, mobile phone, tablet or other similar personal device and only for personal use. You may print copies of the content and store the content on your personal computer, mobile phone, tablet or other similar personal device for your personal use. Paper deals grants you a limited, personal, non-exclusive non-transferable license only for such use. You shall not alter or modify the content in any way. You shall not use, reproduce, republish, distribute, prepare derivative works, or otherwise use the content (or any portion thereof) other than as explicitly permitted herein. You shall not remove any: (a) copyright, trade-mark or other intellectual property notices from any content (or from copies and/or printouts thereof); and/or (b) link to the website from any place, without our express written consent. You do not acquire any ownership rights to any content. Any unauthorized use of the content shall terminate the permission or license granted by Paper deals herein. You shall not transfer the content to any other person except with the prior written consent of the company. You agree to abide by all additional restrictions in relation to the content displayed on the website and/or mobile application, as may be updated from time to time. Notwithstanding the above, Paper deals does not represent or guarantee that it has any right (including intellectual property rights) on the content including the right to allow use thereof by the users.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Restrictions on Use of the Website</h2>
        <p class="mb-4">
            In addition to other restrictions set forth in these Terms of Use, you agree that:
        </p>
        <ul class="list-disc list-inside mb-4">
            <li>You shall not disguise the origin of information transmitted through the Web Site.</li>
            <li>You will not place false or misleading information on the Web Site.</li>
            <li>You will not use or access any service, information, application or software available via the Web Site in a manner not expressly permitted by Paper deals.</li>
            <li>You will not input or upload to the Web Site any information that may contain viruses, Trojan horses, worms, time bombs or other computer programming routines that are intended to damage, interfere with, intercept or expropriate any system, the Web Site or Information or that infringes the Intellectual Property rights of another.</li>
            <li>Certain areas of the Web Site are restricted to customers of Paper deals.</li>
            <li>You may not use or access the Web Site or the Paper deals Systems or Services in any way that, in Paper deals 's judgment, adversely affects the performance or function of the Paper deals Systems, Services or the Web Site or interferes with the ability of authorised parties to access the Paper deals Systems, Services or the Web Site.</li>
            <li>You may not frame or utilize framing techniques to enclose any portion or aspect of the Content or the Information, without the express written consent of Paper deals.</li>
        </ul>
        
        <h2 class="text-xl font-semibold mb-4">Communication Services and Your Information</h2>
        <p class="mb-4">
            Please note that in accordance with the Information Technology Act, 2000 and its amendment in 2008, and its applicable rules thereunder, in case of non-compliance with applicable law, these Terms of Use and/or the privacy policy of the website for access or usage in India, Paper deals has the right to terminate the access or usage rights of the users of the website and remove non-compliant information. Paper deals reserves the right to review and remove any information you provide, in whole or in part, that in Paper deal 's sole discretion is deemed to be illegal, offensive, or otherwise inappropriate. You acknowledge that we may or may not pre-screen information posted by users on the website and/or mobile application. To the extent permitted by applicable law, we may disclose any information, including personal data, about you, which we have collected through the website and/or mobile application, to third parties in accordance with our privacy policy as applicable to the website and/or mobile application. You acknowledge and agree that Paper deals may preserve any communication or information, personal data or otherwise, between you and Paper deals, which we have collected through the website and/or mobile application. You acknowledge that in accordance with the Information Technology Act, 2000 and its amendment in 2008, and its applicable rules thereunder, in case of non-compliance with applicable law, these Terms of Use and/or the privacy policy of the website for access or usage in India, Paper deals has the right to terminate the access or usage rights of the users of the website and remove non-compliant information. You further acknowledge that the website is provided for informational purposes only and may not be relied upon for any specific purpose or used in substitution for consultation with professional advisors. Paper deals accepts no responsibility for any errors or omissions or for any loss or damage resulting from reliance on any information presented on the website and/or mobile application. Paper deals makes no representations or warranties as to the accuracy, completeness or validity of the information presented on the website and/or mobile application.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Governing Law and Jurisdiction</h2>
        <p class="mb-4">
            These Terms of Use and your use of the Website are governed by and construed in accordance with the laws of India, and any disputes arising out of or relating to these Terms of Use or the Website shall be subject to the exclusive jurisdiction of the courts of India.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Disclaimer of Warranties</h2>
        <p class="mb-4">
            To the fullest extent permitted by applicable law, the Website and the Services are provided on an "as is" and "as available" basis. Paper deals disclaims all warranties, express or implied, including but not limited to, implied warranties of merchantability, fitness for a particular purpose, and non-infringement. Paper deals makes no representations or warranties that the Website or the Services will be uninterrupted, error-free, or completely secure. Paper deals is not responsible for any errors or omissions in the content or services provided through the Website. You assume total responsibility and risk for your use of the Website and the Services.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Limitation of Liability</h2>
        <p class="mb-4">
            To the fullest extent permitted by applicable law, Paper deals, its officers, directors, employees, agents, licensors, and suppliers shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to, loss of profits, data, use, or other intangibles, even if Paper deals has been advised of the possibility of such damages. In no event shall Paper deals's total liability to you for all damages, losses, and causes of action exceed the amount paid by you, if any, for accessing the Website or using the Services.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Indemnification</h2>
        <p class="mb-4">
            You agree to indemnify, defend, and hold harmless Paper deals, its officers, directors, employees, agents, licensors, and suppliers from and against all claims, losses, expenses, damages, and costs, including reasonable attorneys' fees, arising out of or relating to your use of the Website or the Services, your violation of these Terms of Use, or your violation of any rights of another.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Severability</h2>
        <p class="mb-4">
            If any provision of these Terms of Use is found to be unlawful, void, or for any reason unenforceable, then that provision shall be deemed severable from the remaining provisions and shall not affect the validity and enforceability of the remaining provisions.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Entire Agreement</h2>
        <p class="mb-4">
            These Terms of Use, together with any Service Agreements and the Privacy Policy, constitute the entire agreement between you and Paper deals with respect to your use of the Website and the Services, and supersede all prior or contemporaneous communications and proposals, whether oral or written, between you and Paper deals.
        </p>
        
        <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
        <p class="mb-4">
            If you have any questions or concerns about these Terms of Use or the Website, please contact us at:
        </p>
        <p class="mb-4">
            Paper deals<br>
            Email: <a href="mailto:info@paperdeals.in" class="text-blue-500">info@paperdeals.in</a><br>
            Phone: +911146351160
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
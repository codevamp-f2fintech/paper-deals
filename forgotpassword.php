<?php session_start();
  ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    require ('components/meta.php');
    require ('constants.php') ?>
    <title>Buyer Signup -
        <?php echo site_name ?>
    </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

</head>

<body>
    <?php include ('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section
            class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Forgot Password</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="forgotpassword.php">Forgot Password</a>

                </ul>
            </div>
        </section>
        <style>
            @media only screen and (max-width: 767px) {
                .frmm{
                    width:350px !important;
                    /*border:4px solid;*/
                }
                
            }
            
            
            
        </style>

        <!-- Page Content -->
        <section class="py-10 container " >
             <form class="flex bg-white rounded shadow-2xl shadow-gray-500 border w-80 md:w-xl w-[400px] mx-auto frmm" id="forgotPasswordForm">
        <div class="w-full flex flex-col divide-y">
            <div class="flex gap-5 items-center w-full p-5 text-white" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%)">
                <i class="bi bi-box-arrow-in-right text-5xl"></i>
                <div class="flex flex-col gap-1">
                    <h1 class="font-extrabold text-xl">Forgot Password</h1>
                    <p>For <b>Seller</b> and <b>Buyer</b></p>
                </div>
            </div>
            <div class="flex flex-col gap-5 p-5">
                <div class="relative z-0 w-full">
                    <select name="user_type" id="type" class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <option value="2">Seller</option>
                        <option value="3">Buyer</option>
                    </select>
                    <label for="type" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">I am</label>
                </div>
                <div class="relative z-0 w-full">
                    <input type="email" name="email" id="floating_email" class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_email" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email address</label>
                </div>
            </div>
            <div class="text-center gap-2 flex flex-col p-5">
                <button class="py-2 rounded text-white border-[#86776f] border-2" style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%)" type="submit">Reset Password</button>
                <a href="login.php" class="text-sm hover:text-blue-500 w-fit mx-auto">Login here</a>
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
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forgotPasswordForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'forgot_password.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response) {
                            alert("Confirmation Email Sent successfully");
                            $('#response').html(response);
                        } else {
                            alert("Failed to send confirmation email. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
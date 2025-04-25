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

<body>
    <?php include ('components/header.php') ?>

    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section
            class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Paper Deals Spot Price Enquiry</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                        class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="spot_price_enquiry.php">Spot Price Enquiry</a>

                </ul>
            </div>
        </section>
    <style>
        
         @media (max-width: 480px) {
             .forrrm{
                 width:95% !important;
                 margin:auto;
             }
             .pt-5 {
    padding-top: 2.25rem;
}
             
         }
        @media (max-width: 768px) {
             .forrrm{
                 width:95% !important;
                 margin:auto;
             }
        }
        @media (max-width: 1024px) {
             .forrrm{
                 width:95% !important;
                 margin:auto;
             }
        }
    </style>

        <!-- Page Content -->
        <section class="py-10">
            <form class="flex bg-white rounded shadow-2xl forrrm shadow-gray-500 border md:w-fit container mx-auto"
                action="spot_price_submit.php" method="POST" onsubmit="return validateForm()" style="width:40%;">
                <div class="w-full flex flex-col divide-y">
                    <div class="flex gap-5 items-center w-full p-5 p-5 text-white"
                        style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">
                        <i class="bi bi-person-fill-add text-5xl"></i>
                        <div class=" flex-col gap-1">
                            <h1 class="font-extrabold text-xl">Spot Price Enquiry</h1>
                            <p style="width:100%;">For enquiry, complaint, deactivate or disable
                                account, remove or delete profile from mobile app and any other query submit your
                                request or message. our team will contact you soon and process your request. </p>
                        </div>
                    </div>
                    

                    <div class="flex flex-col gap-5 p-5">
                        <?php if (isset($_GET['success']) && $_GET['success'] == 1) {
                            ?>
                    <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 " role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
     We have recieved your enquiry, we will contact you soon.
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5  text-green-500 rounded-lg focus:ring-2  p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8  dark:text-green-400 "  data-dismiss-target="#alert-border-3" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>                  <!--<div class="alert alert-success">-->
                            <!--    <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>-->
                            <!--    <p class="mb-2"><strong>Message</strong></p>-->

                            <!--    <hr>-->
                            <!--    <p class="mt-2">We have recieved your enquiry, we will contact you soon.</p>-->

                            <!--</div>-->
                            <?php
                        }
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                            ?>
                            <div class="alert alert-danger">
                                <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
                                <p class="mb-2"><strong>Message</strong></p>

                                <hr>
                                <p class="mt-2">Data Not inserted Due to some error</p>

                            </div>';
                        <?php } ?>

                        <div class="relative z-0 w-full">
                            <?php
                        
                            if ($_SESSION['role']==2 || $_SESSION['role']==3) {
                                
$id=$_SESSION['id'];
                                $sql = "SELECT users.name,users.email_address,users.phone_no,users.id,organization.user_id,organization.organizations FROM `users` LEFT JOIN organization ON users.id=organization.user_id WHERE users.id=$id";
// echo $sql;
// exit;
                                $query_run = mysqli_query($conn, $sql);
                                $users = mysqli_fetch_assoc($query_run);
                                $name = $users['name'];
                                $email_address = $users['email_address'];
                                $phone_no = $users['phone_no'];
                                $organizations = $users['organizations'];

                            }


                            if (isset($_GET['prod_id'])) {
                                $product_id = $_GET['prod_id'];
                                ?>
                                <input type="hidden" name="spot_price_id" value="<?= $product_id; ?>">
                                <?php
                            }
                            ?>
                            <input type="text" name="name" id="name"
                                class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required value="<?= $organizations; ?>" />
                            <label title="Full Name" for="name"
                                class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Full
                                Name</label>
                        </div>
                        <div class="relative z-0 w-full">
                            <input type="number" name="phone" id="phone"
                                class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==10) return false;" value="<?php if ($phone_no) {
                                    echo $phone_no;
                                } ?>" />
                            <label title="Phone Number" for="phone"
                                class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Enter
                                your Register Mobile Number</label>
                        </div>
                        <div class="relative z-0 w-full">
                            <input type="email" name="email_id" id="floating_email"
                                class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required value="<?php if ($email_address) {
                                    echo $email_address;
                                } ?>" />
                            <label title="Email" for="floating_email"
                                class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Enter
                                Your Email</label>

                        </div>

                        <div class="relative z-0 w-full">
                            <textarea type="text" name="message" id="message1"
                                class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" "></textarea>
                            <label title="Message"
                                class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5" >Message (Specify Quantity and Requirement)</label>
                        </div>

                    </div>

                    <div class="text-center gap-2 flex flex-col p-5">
                        <button class="py-2 rounded text-white bg-[#86776f] border-[#86776f] border-2 font-bold"
                            type="submit"
                            style="background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);">Submit</button>
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
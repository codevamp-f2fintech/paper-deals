<?php session_start();
  ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection/config.php");
// if (isset($_GET['state'])){
//     $state = $_GET['state'];
//     $search = $_GET['state'];
//     $sql = "SELECT * FROM state_list WHERE state_name LIKE '%$search%'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {   
//         while($row = $result->fetch_assoc()) {
//             echo   "State: " . $row["state_name"] . "<br>";
//         }
//     } else {
//         echo "No results found";
//        }   
// }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">


<head>
    <?php
    require('components/meta.php');
    require('constants.php');
    include('connection/config.php'); ?>
    <title>
        <?php echo (isset($search) ? $search . " - " : "") . site_name ?>
    </title>
</head>

<body>
    <?php include('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Search RESULTS -->
        <section class="srch_sectn">
            <style>
                .tab {
                    overflow: hidden;
                    border: 1px solid #ccc;
                    background-color: #f1f1f1;
                }

                /* Fade in tabs */
                @-webkit-keyframes fadeEffect {
                    from {
                        opacity: 0;
                    }

                    to {
                        opacity: 1;
                    }
                }

                @keyframes fadeEffect {
                    from {
                        opacity: 0;
                    }

                    to {
                        opacity: 1;
                    }
                }

                /* Style the buttons that are used to open the tab content */
                .tab button {
                    background-color: inherit;
                    float: left;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    padding: 14px 16px;
                    transition: 0.3s;
                }

                /* Change background color of buttons on hover */
                .tab button:hover {
                    background-color: #ddd;
                }

                /* Create an active/current tablink class */
                .tab button.active {
                    background-color: #ccc;
                }

                /* Style the tab content */
                .tabcontent {
                    display: none;
                    padding: 6px 12px;
                    border: 1px solid #ccc;
                    border-top: none;
                }
            </style>
            <style>
                /* CSS rules */
                .your-element {
                    width: 80%;
                    transform: translate(13%, 3%);
                    margin: 16px 6px;
                }

                .your-element:hover {
                    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                    background: #fdf8ed;
                }
            </style>
            <div class="container">
                <div class="head">
                    <h3>Search<span class="text-orange-600"> Result</span></h3>
                </div>
                <?php
                if (isset($_GET['user_type'])) {
                    $product_id = $_GET['user_type'];
                    $query = "SELECT users.*, organization.organizations, organization.address,organization.state,organization.production_specification,organization.organization_type,organization.verified,organization.vip
                FROM users 
                LEFT JOIN organization  ON users.id = organization.user_id where user_type='$product_id' ORDER BY users.active_status ASC";
                    $query_run = mysqli_query($conn, $query);
                    $Item = mysqli_num_rows($query_run) > 0;
                    if ($Item) {
                        while ($prod_item = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <div class="flex flex-col">
                                <div class="flex flex-col md:flex-row md:items-center rounded border gap-5 p-5 sell your-element">
                                    <img src="assets/papermill.jpg" alt="alt" class="p-1 border w-96 md:w-80">
                                    <div class="flex flex-col gap-2">
                                        <h3 class="text-lg md:text-xl font-bold">
                                            <?= $prod_item['organizations']; ?>
                                        </h3>
                                        <div class="flex gap-2 md:items-center text-sm">
                                            <?php if ($prod_item['verified'] == 1) {
                                                ?>
                                                <label class="bg-green-600 text-white font-bold rounded-full py-1 px-3"><i
                                                        class="bi bi-patch-check-fill"></i>
                                                    <?php echo " Verified"; ?>
                                                </label>
                                                <?php
                                            } else {

                                                ?><label
                                                    class="bg-red-600 text-white font-bold rounded-full py-1 px-3">
                                                    <?php echo "Not Verified"; ?>
                                                </label>
                                                <?php
                                            } ?>
                                            <?php if ($prod_item['vip'] == 1) {
                                                ?>
                                                <label class="bg-yellow-400 text-black font-bold rounded-full py-1 px-3
                                                ">
                                                    <?php echo " VIP"; ?>
                                                </label>
                                                <?php
                                            } ?>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">Business Area / Industry</h5>
                                                <p>
                                                    <?= $prod_item['address']; ?>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Sub Products</h5>
                                                <p>
                                                    <?= $prod_item['production_specification']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5">
                                            <div>
                                                <h5 class="font-semibold">Price Range</h5>
                                                <p>5K - 1L</p>
                                            </div>
                                            <div>
                                                <h5 class="font-semibold">Delivery</h5>
                                                <p>
                                                    <?= $prod_item['state']; ?>
                                                </p>
                                            </div>

                                        </div>
                                        <div>
                                            <h5 class="font-semibold">Type of Seller</h5>
                                            <p>
                                                <?= $prod_item['organization_type']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-8">
                                        <a href="enquiry.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                            class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">Enquiry
                                            Now</a>
                                        <a href="view_profle.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                            class="py-1 px-3 bg-[#86776f] text-white focus:bg-black hover:bg-black">View
                                            Profile</a>
                                    </div>


                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No record found";
                    }
                }
                ?>
            </div>
        </section>

        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div
                class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a solution
                    meeting your budget and requirement </p>
            </div>
        </section>

    </main>
    <?php include('components/footer.php') ?>
</body>

</html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['search']))
    $search = $_GET['search'];
if (isset($_GET['state']))
    $state = $_GET['state'];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require('components/meta.php');
    require('constants.php');
    include('connection/config.php');
    ?>
    <title>Images-
        <?php echo site_name ?>
    </title>
</head>
<body>
    <?php include('components/header.php') ?>
    <main class="mt-[70px] md:mt-0">
        <!-- Page Header -->
        <section class="bg-[url('assets/page.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
            <div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
                <h1 class="text-2xl md:text-4xl font-bold text-white">Image</h1>
                <ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
                    <a href="index.php">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="search.php">Search</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                    <a href="image.php">Image</a>
                </ul>
            </div>
        </section>

        <style>
        .drp{
           height: 40px;
    width: 21%;
    font-size: 19px;
    border-radius: 8px;
    margin: 0 auto;
    padding: 0 16px;
    position: relative;
    right: -40%;
        }
            .gallery {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                padding: 20px;
            }
            .card {
                flex: 1 1 calc(20% - 20px); /* 5 cards per row with spacing */
                box-sizing: border-box;
                margin: 10px;
                position: relative;
                cursor: pointer;
                overflow: hidden;
            }
            .card img {
                width: 100%;
                height: auto;
                transition: transform 0.3s ease-in-out;
            }
            .card img:hover {
                transform: scale(1.05);
            }
            .fullscreen {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.9);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }
            .fullscreen img {
                max-width: 90%;
                max-height: 90%;
            }
            .close, .prev, .next {
                position: absolute;
                top: 50%;
                font-size: 30px;
                color: white;
                cursor: pointer;
                z-index: 1001;
            }
            .close {
                top: 20px;
                right: 20px;
            }
            .prev, .next {
                transform: translateY(-50%);
            }
            .prev {
                left: 20px;
            }
            .next {
                right: 20px;
            }
            @media (max-width: 768px) {
                .card {
                    flex: 1 1 calc(50% - 20px); /* 2 cards per row on tablets */
                }
            }
            @media (max-width: 480px) {
                .card {
                    flex: 1 1 calc(100% - 20px); /* 1 card per row on phones */
                }
            }
        </style>
 <section class="sptsetcion">
        <div class="sptbx">
            <label>Events</label>
            <marquee id="marquee" behaviour="scroll" scrollamount="10" attribute_name="attribute_value" onmouseover="this.stop();" onmouseout="this.start();">
                <?php

                $query = "SELECT * From image";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    $i = 1;
                    foreach ($query_run as $prod_item) {
                ?>
                        <a  style="font-size:16px;">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <?php echo "$i."; ?>
                            <b>Event Name :</b>
                            <?php $sql = "Select * from image where id=$prod_item[id]";
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $item) {
                                    echo $item['title'];
                                }
                            }
                            ?>
                            &nbsp; &nbsp; &nbsp; &nbsp;
            
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <?php
                            $i++;
                            ?>
                        </a>
                    <?php

                    }
                } else {
                    ?>
                <?php } ?>
            </marquee>
        </div>
    </section>
        <div class="container-fluid bg-gray-100 py-4">
            <div class="select-box">
                <select id="product_title" class="drp">
                    <?php
                    // Your database connection and query
                    $query = "SELECT * FROM image";
                    $result = mysqli_query($conn, $query);
                    
                    // Check if query executed successfully
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    
                    $lastOption = true; // Flag to track the first option
                    
                    // Loop through the fetched data and populate the dropdown options
                    while ($data = mysqli_fetch_array($result)) {
                        // Check if it's the first option and add 'selected' attribute
                        $selected = $lastOption ? 'selected' : '';
                        
                        echo '<option value="' . $data['id'] . '" ' . $selected . '>' . $data['title'] . '</option>';
                        
                        $firstOption = false; // Set to false after first iteration
                    }
                    
                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </select>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
       <script>
       $(document).ready(function(){
    // Function to get the latest product ID
    function getLatestProductId() {
        return $.ajax({
            url: 'get_latest_product_id.php', // Endpoint to get the latest product ID
            type: 'GET',
            dataType: 'json'
        });
    }

    // Function to load data
    function loaddata(id) {
        $.ajax({
            url: 'get_products.php', 
            type: 'POST',
            data: { product_id: id },
            success: function(response) {
                $('#load-image').html(response);
            }
        });
    }

    // Initial load with the latest product ID
    getLatestProductId().done(function(latestProductId) {
        if (latestProductId) {
            loaddata(latestProductId);
        } else {
            console.error("No latest product ID found.");
        }
    });

    // Change product
    $('#product_title').on('change', function() {
        var id = this.value;
        loaddata(id);
    });
});
</script>


        <div id="images"></div>
        <div class="gallery" id="load-image"></div>

        <div class="fullscreen" id="fullscreen">
            <span class="close" id="close">&times;</span>
            <span class="prev" id="prev">&#10094;</span>
            <span class="next" id="next">&#10095;</span>
            <img id="fullscreenImg" src="" alt="Fullscreen Image">
        </div>

        <script>
            let currentIndex = 0;
            let cards;

            $(document).on('click', '.card img', function() {
                cards = document.querySelectorAll('.card img'); // Update the cards collection
                const src = $(this).attr('src');
                currentIndex = $(this).parent().index(); // Get the index of the clicked image
                $('#fullscreenImg').attr('src', src);
                $('#fullscreen').css('display', 'flex');
            });

            $('#close').click(function() {
                $('#fullscreen').css('display', 'none');
            });

            $('#fullscreen').click(function(e) {
                if (e.target === this) {
                    $(this).css('display', 'none');
                }
            });

            $('#prev').click(function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex - 1 + cards.length) % cards.length;
                $('#fullscreenImg').attr('src', $(cards[currentIndex]).attr('src'));
            });

            $('#next').click(function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex + 1) % cards.length;
                $('#fullscreenImg').attr('src', $(cards[currentIndex]).attr('src'));
            });

            $(document).keydown(function(e) {
                if ($('#fullscreen').css('display') === 'flex') {
                    if (e.key === 'ArrowLeft') {
                        $('#prev').click();
                    } else if (e.key === 'ArrowRight') {
                        $('#next').click();
                    } else if (e.key === 'Escape') {
                        $('#close').click();
                    }
                }
            });
        </script>

        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <!-- <h3 class="text-2xl md:text-3xl font-semibold">GET EXCITING OFFERS!</h3> -->
                <!-- <p class="text-base md:text-lg max-w-3xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda quibusdam perferendis ipsam minima, necessitatibus ea nesciunt molestiae dolorum.</p> -->
                <!-- <a href="contact.php" class="bg-primary hover:bg-transparent hover:border-primary text-white border hover:border-white py-2 px-8 rounded-lg duration-200">Contact Us</a> -->
            </div>
        </section>
    </main>
    <?php include('components/footer.php') ?>
</body>
</html>

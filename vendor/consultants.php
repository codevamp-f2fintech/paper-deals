<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection/config.php");
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
    <style>
        .trigger {
            text-align: center;
            padding: 7px 13px;
            background: #3e3e3e;
            color: #fff;
            font-size: 15px;
            outline: none;
            border: none;
            border-radius: 5px;
            font-family: cursive;
        }

        .modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem 1.5rem;
            width: 24rem;
            border-radius: 0.5rem;
        }

        .close-button {
            float: right;
            width: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            background-color: lightgray;
        }

        .close-button:hover {
            background-color: darkgray;
        }

        .show-modal {
            opacity: 1;
            visibility: visible;
            transform: scale(1.0);
            transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
        }
    </style>
</head>
<link rel="stylesheet" href="responsivve.css">
<body>
    <?php include('components/header.php') ?>
    <main >
        <!-- Search BOX -->
       <style>
 

        .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                height: 85vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
             
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

        .fixed-overlay h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }
/*====================================================================================*/
        @media (max-width: 767px) {
            #const-img{
                /*border:4px solid red;*/
                min-height:600px !important;
            }
             #const-img img{
                 height:220px !important;
                 margin:auto !important;
             }
             #constalant{
                 /*border:4px solid;*/
                 display:flex;
                 flex-direction:column !important;
                 align-items:start !important;
                 justify-content:start !important;
                 margin-left:2% !important;
             }
             #collll{
                 /*border:3px solid;*/
             }
               #collll a{
                   width:100% !important;
               }
            
            .slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    height: 44vh;
}
            .slider-slide {
    flex: 0 0 100%;
    max-width: 100%;
    position: relative;
    height: 44vh !important;
}

     .fixed-overlay h1 {
    font-size: 20px;
    font-weight:600;

}


.fixed-overlay p {
    font-size: 14px;
    margin-bottom: 2rem;
}


    .fixed-overlay form {
        display: flex;
        max-width: 356px;
        width: 100%;
        background: #fff;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        /* height: 48px; */
        width: 105%;
    }
    
 .fixed-overlay > form > i{
         font-size: 13px !important;
 }

.fixed-overlay input {
    flex: 1;
    padding: 10px 5px;
    border: none;
    outline: none;
    color: #000;
    font-size: 1rem;
    border-radius: 30px 0 0 30px;
    margin: 0 1% 0 0;
    /*border: 2px solid;*/
}
.fixed-overlay button {
    padding: 10px 15px;
    border: none;
    background: linear-gradient(90deg, #0078ff, #00d2ff);
    color: #fff;
    border-radius: 47px;
    cursor: pointer;
    font-size: 1rem;
    height: 42px;
    margin: 0.7%;
}}
@media only screen and (min-width: 768px) and (max-width: 1023px) {
        .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                   height: 44vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
                height: 44vh;
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

       .fixed-overlay h1 {
    font-size: 32px !important;
    margin-bottom: 1rem;
    font-weight: 600;
}

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }

        }
        @media only screen and (min-width: 1024px) and (max-width: 1440px) {
            
             .banner-main {
            position: relative;
            width: 100%;
            max-width: 100vw;
            overflow: hidden;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
                    height: 75vh;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
             
        }

        .slider-img {
            width: 100%;
            height: 100%;
            display: block;
        }

        .fixed-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 20px;
            pointer-events: none; /* Allow clicks to pass through */
        }

        .fixed-overlay * {
            pointer-events: auto; /* Allow interaction with child elements */
        }

           .fixed-overlay h1 {
        font-size: 45px;
        margin-bottom: 1rem;
        font-weight: 700;
    }

        .fixed-overlay p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .fixed-overlay form {
            display: flex;
            max-width: 500px;
            width: 100%;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .fixed-overlay input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            outline: none;
            color:#000;
            font-size: 1rem;
            border-radius: 30px 0 0 30px;
                margin: 0 3% 0 0;
        }

        .fixed-overlay input::placeholder {
            color: #aaa;
            font-size: 1rem;
        }

        .fixed-overlay button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(90deg, #0078ff, #00d2ff);
            color: #fff;
           border-radius: 47px;
            cursor: pointer;
            font-size: 1rem;
            height: 44px;
    margin: 0.5%;
        }
        }  
        }
        @media only screen and (min-width: 1441px) and (max-width: 1919px) {
            
            
            
            
        }
    </style>
</head>
<body>
    <div class="banner-main">
        <div class="slider-container">
            <div class="slider-wrapper" id="slider">
                <!-- Slider Items -->
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 1">
                </div>
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 2">
                </div>
                <div class="slider-slide">
                    <img class="slider-img" src="pd-banner.jpg" alt="Banner 3">
                </div>
            </div>
            <!-- Fixed Overlay -->
            <div class="fixed-overlay">
                <h1>India's Largest Marketplace for <span>PAPER DEALS</span></h1>
                <p>Stay up-to-date with the latest information on our selling, buying, offers, news, and spot prices.</p>
                <form action="search.php" method="POST">
                  <i class="fas fa-search text-black py-4 pl-4"></i>  <input type="text" name="search" placeholder="Search for Seller & Buyer" required>
                    <button type="submit" name="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.slider-slide');
        const totalSlides = slides.length;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            document.getElementById('slider').style.transform = `translateX(-${currentIndex * 100}%)`;
        }, 5000);
    </script>
   <div class="container mx-auto px-4 py-8">
  <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Experience Consultants</h2>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
     <?php $query = "SELECT users.*, consultant_pic.prof_pic , consultant_pic.description,consultant_pic.mills_supported,consultant_pic.years_of_experience
                    FROM users 
                    LEFT JOIN consultant_pic ON users.id = consultant_pic.user_id 
                    WHERE user_type = 5 
                    ORDER BY users.id DESC;
                    ";
                    $query_run = mysqli_query($conn, $query);
                    $Item = mysqli_num_rows($query_run) > 0;
                    if ($Item) {
                        while ($prod_item = mysqli_fetch_assoc($query_run)) {
                        ?>
    <!-- Doctor 1 -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden" style="border:2px dotted;">
      <img src="<?php if ($prod_item['prof_pic']) { ?>admin/<?= $prod_item['prof_pic']; ?> <?php } else { ?>logo.jpeg <?php } ?>" alt="<?php echo $prod_item['name']; ?>" class="w-full h-64 object-cover" style="width: 150px;
    height: 150px;
    border-radius: 100%;
    margin: 30px auto;
}">
      <div class="p-4">
        <h6 ><strong>Name :</strong> &nbsp;&nbsp;<?php echo $prod_item['name']; ?></h6>
       <h6 ><strong>Email :</strong> &nbsp;&nbsp;<?php echo $prod_item['email_address']; ?></h6>

        <h6><strong>years of experience :</strong> &nbsp;&nbsp;<?php echo $prod_item['years_of_experience']; ?></h6>
                <h6><strong>Mills Supported :</strong> &nbsp;&nbsp;<?php echo $prod_item['mills_supported']; ?></h6>
            <h6><strong>Description :</strong> &nbsp;&nbsp;<?php echo $prod_item['description']; ?></h6>


        <a href="view_profle.php?role=8&consult_id=<?php echo $prod_item['id']; ?>" >
                                                <button  style="background: linear-gradient(45deg, #1078FF 0%, #00DFDF 70%); padding:6px;font-size:16px;" id="const-buttn" class="mt-4 text-white focus:bg-black hover:bg-black">View
                                                Profile </button></a>
      </div>
    </div>
  
<?php } } ?>

  </div>
</div>
      

        <!-- Get Started -->
        <section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
            <div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
                <h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
                <p>Connect to us for your requirement and our solution architect can work with you to design a solution
                    meeting your budget and requirement </p>
            </div>
        </section>

    </main>
    <button class="trigger" style="display:none;">Click the modal!</button>
    <div class="modal">
        <div class="modal-content">
            <span class="close-button">×</span>

            <h1 style="font-size:20px;"> <i class="fa fa-check"></i> Your Slot Booked Successfully</h1>
        </div>
    </div>
    <?php include('components/footer.php') ?>
    <script>
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
        if (<?php echo $_GET['status']; ?> == true) {
            trigger.click();

        }

        setTimeout(() => {
            closeButton.click();
        }, 3000);
    </script>
</body>

</html>
<?php session_start();
  ?>
<?php
session_start();
if (isset($_SESSION["id"])) { ?>
	<script type="text/javascript">
		window.location.href = 'admin';
	</script>
<?php } ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
	<?php
	require('components/meta.php');
	require('constants.php') ?>
	<title>Buyer Signup -
		<?php echo site_name ?>
	</title>
	<link rel="stylesheet" href="./assets/css/UI.css" />
</head>
<style>

      .success-message {
          
        color: green;
        font-weight: bold;
        position: absolute;
        top: 89px;
       right: 45px;
       
         }

    .error-message {
        color: red;
        font-weight: bold;
        position: absolute;
        top: 89px;
        right: 45px;
        
      }
  
	@media only screen and (min-width: 300px) and (max-width: 574px) {









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
		        height: 630px;

		}

		.sign_upsctn>.container>.sgnupbx>.sgn_frm>.head>h1 {
			font-size: 25px;

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

	@media only screen and (min-width: 576px) and (max-width: 767px) {
		.HeaderSearch__globalSearchLanding--ompUH {
			width: 100%;
		}
	}

	@media only screen and (min-width: 992px) and (max-width: 1199px) {
		.HeaderSearch__globalSearchLanding--ompUH {
			width: 100%;
		}
	}

	@media only screen and (min-width: 1200px) {
		.HeaderSearch__globalSearchLanding--ompUH {
			width: 100%;
		}
		.cont-iner{
		    width:94% !important;
		}
		
	}
</style>


<body>
	<?php include('components/header.php') ?>

	<main class="" >
		<!-- Page Header -->
		<section class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit ">
			<div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
				<h1 class="text-2xl md:text-4xl font-bold text-white">Sign Up</h1>
				<ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
					<a href="index.php">Home</a>
					<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
						</path>
					</svg>
					<a href="signup.php">Sign Up</a>

				</ul>
			</div>
		</section>

		<!-- Page Content -->
		<section class="sign_upsctn mt-6">

			<div class="container mb-6 cont-iner">
				<div class="sgnupbx">
					<div class="sell sgndata" style="background:linear-gradient(259.26deg, #006efa, #07cdbe 84.05%)">
						<div class="media">
							<img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/undraw_online_stats_0g94+(2).svg" class="mx-auto  mt-20" alt="">
						</div>
						<div class=" head">
							<!-- <h1 id="head">Seller and Buyer</h1> -->
							<p id="par">Create new account for Seller and Buyer</p>
						</div>
					</div>
					<div class="sell sgn_frm">
						<div class="head">
							<h1>Sign Up</h1>
						</div>
						<form method="POST" id="signForm">
							<div class="sgnbx w-full flex flex-col divide-y">

						<div class="relative form-group">

									<select id="type" name="type" class="block w-full pl-[14px]  text-sm text-gray-900 border rounded border-2   bg-transparent  focus:ring-blue-500 focus:border-blue-500 dark:bg-transparent  dark:placeholder-gray-400 h-[56px] outline-none dark:focus:ring-blue-500 dark:focus:border-blue-500 peer">
										<option value="2" <?php if ($_REQUEST['userType'] == 'seller') {
																				echo 'selected';
																			} ?> style="font-size:18px;padding-bottom:5%">Seller
										</option>
										<option value="3" <?php if ($_REQUEST['userType'] == 'buyer') {
																				echo 'selected';
																			} ?> style="font-size:18px; padding-bottom:5%">Buyer
										</option>
									</select>

									<label for="type" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Join
										as</label>
								</div>
								<div class="relative form-group">
									<input type="text" name="name" id="name" class="form-control rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									<label title="Full Name" for="name" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Full
										Name</label>
									<span class="error">
										<?php echo $nameErr; ?>
									</span>
								</div>

								<div class="relative form-group">
									<input type="email" name="email" id="floating_email" class="form-control rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									<label title="Email" for="floating_email" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email
										address</label>
									<span class="error">
										<?php echo $emailErr; ?>
									</span>
								</div>

								<div class="relative">
									<input type="text" name="phone" id="phone" class="form-control rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " placeholder="Enter Mobile" maxlength="10" title="Please enter 10 digits Mobile No." pattern="\d{10}" required />
					  <button type="button" class="text-white bg-[#00DFDF] focus:outline-none hover:bg-[#1078FF]  rounded-full text-sm px-4 py-3 text-center mb-2  absolute top-[7px] right-[5px]" id="get_otp">GET OTP</button>

					   <div id="otpContainer" style="display:none;margin-top:12px;">
    <!-- Your OTP input and submit elements here -->
     <input type="text" id="otpInput" name="otpcode" class="form-control rounded border-2 px-4 pt-5 pb-3 block w-full" maxlength="4" placeholder="Enter OTP"/>
    <div style="margin:12px;"><span id="timer">30&nbsp;&nbsp; </span><span> &nbsp;&nbsp;OTP till valid</span></div>
   <p id="otpverified" style="padding: 4px;
    margin-top: 12px;
    width: 90px;
    position: absolute;
    top: 68px;
    right: 0%;
    color: green;
    font-size: 16px;
    font-weight: 600;
    display: block;"></p>
</div>


    
									<label title="Phone Number" for="phone" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Phone</label>
									<span class="error">
										<?php echo $phoneErr; ?>
									</span>
								</div>

								<div class="relative mt-3">
									<input type="password" name="password" id="password" class="form-control rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									    <div id="btnToggle" class="toggle absolute
									        right-4
									         " style="top:1.3rem;"><i id="eyeIcon" style="font-size:18px;" class="fa fa-eye"></i></div>
									<label title="Password" for="password" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Password</label>
									<span class="error">
										<?php echo $passwordErr; ?>
									</span>
								</div>

								<div class="form-button mb-10">
									<button class="btn" name="submit">Sign Up</button>
									<p>Already Registered ? <a href="login.php?userType=<?= $_REQUEST['userType'] ?>">Login here</a></p>

								</div>

							</div>
						</form>
					</div>
				</div>
			</div>




		</section>

		<!-- Get Started -->
		<section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
			<div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 pb-8 p-4 lg:px-24">
				<h3 class="text-2xl md:text-4xl font-bold">Get Started</h3>
				<p>Connect to us for your requirement and our solution architect can work with you to design a solution
					meeting your budget and requirement </p>
				<div class="flex gap-2">
					<a href="buyer" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-cart-check-fill"></i> Buyers</a>
					<a href="seller" class="bg-transparent text-white px-4 py-2 hover:bg-white hover:text-black border-2 border-white rounded transition-all"><i class="bi bi-shop-window"></i> Sellers</a>
				</div>
			</div>
		</section>

	</main>
	<?php include('components/footer.php') ?>
	
 <script>
        $(document).ready(function() {
            
        $('#otpInput').keyup(function() {
    var otp = $(this).val(); // Use $(this) instead of $('#otpInput')

    if (otp.length == 4) {
        $.ajax({
            type: 'POST',
            url: 'otp_veriyfy.php',
            data: { otp: otp },
            success: function(response) {
    
              const obj = JSON.parse(response);
                if (obj.status == 1) {
                    // Verification successful
                  $('#otpverified').css('display', 'block');

                    $('#otpverified').text(obj.message); // Add green border
                    // You can also add a checkmark icon inside the input if desired
                } else {
                    // Verification failed
                    $('#otpverified').css('display', 'block');

                    $('#otpverified').text(obj.message);// Remove green border
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    } else {
        // Reset styles if OTP length is not 4
        $('#otpInput').removeClass('border-green-500');
       
    }
});

        
              $('#signForm').on('submit', function(event) {
                event.preventDefault();
// alert($(this).serialize());
                $.ajax({
                    url: 'signup_process.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                       //alert(response);
                        const msg = JSON.parse(response);  
                    if(msg.status == 1){
                       
                       location.href = "login.php";

                    }else{
                            
                         alert(msg.message); 
                         
                        }
                        
                    }
                });
            });





       
$('#get_otp').on('click', function() {

    var phone = $('#phone').val();
    var text = $('#get_otp').text();
  

    if (phone.length == 10) {
        $.ajax({
            type: 'POST',
            url: 'sendsms.php',
            data: {phone: phone,type:text},
            success: function(response) {
			const myArr = JSON.parse(response);
			if (myArr.Success == 'True') {
                    $("#otpContainer").css("display", "block");
                    startTimer();
                    $('#get_otp').css("display", "none");
                    setTimeout(function() {
                        $('#get_otp').css("display", "block").text("Resend OTP");
                    }, 30000); // 60000 milliseconds = 60 seconds
                } else if(myArr.Success == false){
					alert(myArr.message);
				}
            }
        });
    } else {
        alert("Enter 10 digit number!")
    }
});



        

    function startTimer() {
        var counter = 30;
        var interval = setInterval(function() {
            counter--;
            $('#timer').text(counter);

            if (counter <= 0) {
                clearInterval(interval);
                $('#resetOtp').css("display", "block");
            }
        }, 1000);
    }

    $('#resetOtp').click(function() {
        // Reset OTP logic
        // You may want to call the sendsms.php again or handle as needed
        $(this).css("display", "none"); // Hide the reset button
        $('#otpContainer').css("display", "none"); // Hide the OTP container
        $('#phone').val(); // Clear the phone input
        $('#timer').text('30'); // Reset the timer display
        sendsms();
    });
        });
    </script>
    
    <script>
	    let passwordInput = document.getElementById('password'),
    toggle = document.getElementById('btnToggle'),
    icon =  document.getElementById('eyeIcon');

function togglePassword() {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.add("fa-eye-slash");
    //toggle.innerHTML = 'hide';
  } else {
    passwordInput.type = 'password';
    icon.classList.remove("fa-eye-slash");
    //toggle.innerHTML = 'show';
  }
}
toggle.addEventListener('click', togglePassword, false);
passwordInput.addEventListener('keyup', checkInput, false);
	</script>
</body>

</html>
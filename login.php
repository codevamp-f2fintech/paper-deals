<?php
// Set the session cookie parameters
// Set the session cookie parameters
session_set_cookie_params([
	'lifetime' => 3600, // Session will last for 1 hour
	'path' => '/',
	'domain' => 'paperdeals.in', // Set your domain here
	'secure' => true, // Use true if serving over HTTPS
	'httponly' => true, // Prevent JavaScript access to the session cookie
	'samesite' => 'Strict', // Choose between 'Lax' or 'Strict'
	'partitioned' => true, // This is a proposed attribute for partitioning; may not be supported in all PHP versions
	'cross-site' => true // This is also a proposed attribute; check PHP version compatibility
]);

// Start the session
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

	</title>
	<link rel="stylesheet" href="./assets/css/UI.css" />
</head>
<style>
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
			height: 470px;

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

		.admin {
			width: 68% !important;
		}
	}
</style>

<body>
	<?php include('components/header.php') ?>
	<main class="mt-[70px] md:mt-0">
		<!-- Page Header -->
		<section class="bg-[url('assets/herobg.jpg')] bg-cover lg:bg-fixed bg-no-repeat bg-bottom relative w-full h-fit">
			<div class="flex flex-col gap-2 items-center justify-center w-full bg-[#090909c4] px-4 py-16 md:py-24">
				<h1 class="text-2xl md:text-4xl font-bold text-white">Sign In</h1>
				<ul class="flex flex-row space-x-3 items-center justify-center text-white text-sm">
					<a href="index.php">Home</a>
					<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="font-bold bi bi-chevron-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
						</path>
					</svg>
					<a href="login.php">Sign In</a>

				</ul>
			</div>
		</section>





		<section class="sign_upsctn mt-10 mb-10">

			<div class="container admin">
				<div class="sgnupbx">

					<div class="sell sgn_frm">
						<div class="head">
							<h1>Sign In</h1>
						</div>

						<form class="" action="" method="POST">
							<div class="sgnbx w-full flex flex-col divide-y">

								<?php
								$message = $emailErr = $passwordErr = "";
								if (isset($_REQUEST['submit'])) {

									if (empty($_REQUEST['email'])) {
										$emailErr = "Email is required";
									} else {
										$email_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
										if (!filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
											$emailErr = "Invalid email format";
										}
									}

									if (empty($_REQUEST['password'])) {
										$passwordErr = "Password is required";
									} else {
										$password = stripslashes(md5($_REQUEST['password']));
									}

									$token = $_REQUEST['token'];

									$role = mysqli_real_escape_string($conn, stripslashes($_REQUEST['type']));

									$date = date('Y-m-d H:i:s');
									if ($emailErr == "" && $passwordErr == "") {
										$result = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '$email_id' AND password = '$password' AND user_type = '$role' AND  log_counter<5");

										$count_row = mysqli_num_rows($result);

										// Check if active_status is 0 and display a warning message
										if ($count_row > 0) {
											$row = mysqli_fetch_array($result);
											if ($row['active_status'] == 0) {
								?>
												<!--<div class="alert alert-danger">-->
												<!--	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>-->
												<!--	<p class="mb-2"><strong>Message</strong></p>-->
												<!--	<hr>-->
												<!--	<p class="mt-2">Your profile is not active yet. Thanks for showing interest. We will-->
												<!--		update you-->
												<!--		when your profile will be activated</p>-->
												<!--</div>-->
												<div id="alert-4" class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 text-yellow-300" role="alert">
													<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
														<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
													</svg>
													<span class="sr-only">Info</span>
													<div class="ms-3 text-sm font-medium">
														Your profile is not active yet. Thanks for
														showing interest. We will update you when your profile will be activated.
													</div>
													<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-300 dark:hover:bg-gray-700" data-dismiss-target="#alert-4" aria-label="Close">
														<span class="sr-only">Close</span>
														<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
															<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
														</svg>
													</button>
												</div>
												<?php
											} else {

												if ($row) {
													$_SESSION["id"] = $row['id'];
													$_SESSION["role"] = $row['user_type'];
													$_SESSION["name"] = $row['name'];
													$_SESSION["expire"] = time();

													$user_id = $row['id'];
													/* last login counter */

													$date = date('Y-m-d H:i:s');
													$update_counter = mysqli_query($conn, "UPDATE  users SET last_login ='$date',token ='$token', log_counter =0  WHERE id = $user_id");


													/* End of last login */
												} else {
												?>
													<!--<div class="alert alert-danger">-->
													<!--	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>-->
													<!--	<p class="mb-2"><strong>Message</strong></p>-->
													<!--	<hr>-->
													<!--	<p class="mt-2">Invalid Email Address or Password!</p>-->
													<!--</div>-->
													<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50  dark:text-red-400" role="alert">
														<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
															<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
														</svg>
														<span class="sr-only">Info</span>
														<div class="ms-3 text-sm font-medium">
															Invalid Email Address or Password!
														</div>
														<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8  dark:text-red-400 " data-dismiss-target="#alert-2" aria-label="Close">
															<span class="sr-only">Close</span>
															<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
																<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
															</svg>
														</button>
													</div>
												<?php
												}

												if (isset($_SESSION["id"])) { ?>
													<script type="text/javascript">
														window.location.href = 'admin';
													</script>
												<?php
												}
											}
										} else {
											$query = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '$email_id' AND user_type = '$role'");
											$result_user = mysqli_fetch_array($query);
											if (is_array($result_user)) {
												$counter = $result_user['log_counter'];
												$user_id = $result_user['id'];

												$new_counter = $counter + 1;

												if ($counter >= 5) {
													$update_counter = mysqli_query($conn, "UPDATE  users SET last_login ='$date' WHERE id = $user_id");

												?>
													<div class="alert alert-danger">
														<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
														<p class="mb-2"><strong>Message</strong></p>
														<hr>
														<p class="mt-2">Your Account has been Blocked. Please contact to Admin.</p>
													</div>
												<?php
												} else {
													$update_counter = mysqli_query($conn, "UPDATE  users SET last_login ='$date', log_counter ='$new_counter'  WHERE id = $user_id");

												?>
													<!--<div class="alert alert-danger">-->
													<!--	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>-->
													<!--	<p class="mb-2"><strong>Message</strong></p>-->
													<!--	<hr>-->
													<!--	<p class="mt-2">Invalid Email Address or Password!</p>-->
													<!--</div>-->
													<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50  dark:text-red-400" role="alert">
														<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
															<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
														</svg>
														<span class="sr-only">Info</span>
														<div class="ms-3 text-sm font-medium">
															Invalid Email Address or Password!
														</div>
														<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8  dark:text-red-400 " data-dismiss-target="#alert-2" aria-label="Close">
															<span class="sr-only">Close</span>
															<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
																<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
															</svg>
														</button>
													</div>
												<?php
												}
											} else {
												?>
												<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50  dark:text-red-400" role="alert">
													<svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
														<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
													</svg>
													<span class="sr-only">Info</span>
													<div class="ms-3 text-sm font-medium">
														Invalid Email Address or Password!
													</div>
													<button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8  dark:text-red-400 " data-dismiss-target="#alert-2" aria-label="Close">
														<span class="sr-only">Close</span>
														<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
															<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
														</svg>
													</button>
												</div>
								<?php
											}
										}
									}
								}


								?>

								<div class="relative form-group">

									<select id="type" name="type" class="block w-full pl-[14px] rounded text-sm text-gray-900 border   bg-transparent  focus:ring-blue-500 focus:border-blue-500 dark:bg-transparent  dark:placeholder-gray-400 h-[56px] outline-none dark:focus:ring-blue-500 dark:focus:border-blue-500 peer">
										<option value="2" <?php if ($_REQUEST['userType'] == 'seller') {
																echo 'selected';
															} ?> style="font-size:18px; padding-bottom:5%">Seller
										</option>
										<option value="3" <?php if ($_REQUEST['userType'] == 'buyer') {
																echo 'selected';
															} ?> style="font-size:18px; padding-bottom:5%">Buyer
										</option>
									</select>
									<label for="type" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Login
										as</label>
								</div>
								<div class="relative form-group">
									<input type="email" name="email" id="floating_email" class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									<label title="Email" for="floating_email" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Email
										address</label>
									<span class="error">
										<?php echo $emailErr; ?>
									</span>
								</div>
								<div class="relative form-group">
									<input type="password" name="password" id="password" class="rounded border-2 px-4 pt-5 pb-3 block w-full text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
									<div id="btnToggle" class="toggle absolute
									        right-4
									         " style="top:1.3rem;"><i id="eyeIcon" style="font-size:18px;" class="fa fa-eye"></i></div>
									<label title="Password" for="password" class="peer-focus:font-medium absolute duration-300 transform -translate-y-5 scale-75 left-5 peer-focus:left-5 top-5 -z-10 origin-[0]  peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-5">Password</label>
									<span class="error">
										<?php echo $passwordErr; ?>
									</span>
								</div>
								<div class="g-recaptcha relative form-group" data-sitekey="6LdQYVYqAAAAAGH1erJC7aUcrCa6D7ZYWtYgacZK"></div>

								<div class="relative form-group p-0">
									<a href="forgotpassword.php" class="text-sm  hover:text-blue-500 w-fit mx-auto">Forgot Password
										?</a>
								</div>

								<div class="form-button">
									<button class="btn" type="submit" name="submit">Signin</button>
									<p>New user? <a href="signup.php?userType=<?= $_REQUEST['userType'] ?>">Register
											here</a></p>
								</div>
							</div>

							<input type="hidden" id="token" name="token">

						</form>


					</div>
					<div class="sell sgndata rounded">

						<div class=" media">
							<img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/Privacy+policy-rafiki+(1).svg" style="width:70%;margin:auto;" alt="">
						</div><br><br>
						<div class="head ">
							<!-- <h1>Seller and Buyer</h1> -->
							<p id="sign_in-Para" style="font-size:18px;color:white;">Create new account for Seller and Buyer</p>
						</div>
					</div>
				</div>
			</div>




		</section>



		<!-- Page Content -->
		<!--<section class="py-10">-->


		</section>

		<!-- Get Started -->
		<section class="bg-[url('assets/contact.jpg')] bg-fixed bg-center bg-no-repeat bg-cover">
			<div class="flex flex-col space-y-5 justify-center text-center items-center text-white w-full bg-[#090909c4] w-full min-h-100 py-16 p-4 lg:px-24">
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
		let passwordInput = document.getElementById('password');
		let toggle = document.getElementById('btnToggle');
		let icon = document.getElementById('eyeIcon');

		function togglePassword() {
			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				icon.classList.remove("fa-eye");
				icon.classList.add("fa-eye-slash");
			} else {
				passwordInput.type = 'password';
				icon.classList.remove("fa-eye-slash");
				icon.classList.add("fa-eye");
			}
		}

		toggle.addEventListener('click', togglePassword, false);
	</script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>
<?php
session_start();
include_once "../connection/config.php";
// echo $_SESSION['id'];
// exit;
if (isset ($_SESSION['id'])) {
  $status = "Active Now";
  $sql2 = mysqli_query($conn, "UPDATE users SET status ='$status' WHERE id = $_SESSION[id]");
  header("location: users.php");
}

?>

<?php include_once ('header.php'); ?>
<body>
  
    <section class="form login">
      <header style="color:white">PD Chat Login</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label style="color:white">Email Address</label>
          <input type="text" name="email_address" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label style="color:white">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link" style="color:white">Not yet signed up? <a href="../index.php">Signup now</a></div>
    </section>


  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>

</html>
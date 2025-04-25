<?php
session_start();
include ('../connection/config.php');
$id = $_SESSION['id'];
if (isset ($_SESSION['id'])) {
  $status = "Active Now";
  $sql2 = mysqli_query($conn, "UPDATE users SET status ='$status' WHERE id = $_SESSION[id]");
  header("location: userchat.php");
}
include_once ('header.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="col-md-6" style="bottom: -245px;
    margin: auto;">
            <?php include ("message.php"); ?>
            <div class="card" style="background-color:#ea580c;">
              
                <div class="card-body">
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
  
  </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>
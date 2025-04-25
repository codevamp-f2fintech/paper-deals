<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
$ses_id = $_SESSION['id'];
include_once "../connection/config.php";
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = $ses_id");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <img src="php/images/1710323188OIP.jpg" alt="">
          <div class="details">
            <span style="color:white">
              <?php echo $row['name']; ?>
            </span>
            <p style="color:white">
              <?php echo $row['status']; ?>
            </p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text" style="color:white">Select
          <?php if ($_SESSION['role'] == 5) { ?>
            an Users
          <?php } else { ?>a Consultant
          <?php } ?>to start chat
        </span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>
<?php
session_start();
include_once "../connection/config.php";
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="contetn-wrapper">
    <section class="content">
      <div class="" style="width:60%;margin-left:40% ;height:93.7vh; overflow-y: auto;">

        <div class=" card">

          <div class=" card-body p-0">
            <section class="chat-area">
              <header style=" background:linear-gradient(259.26deg, #006efa, #07cdbe 84.05%)">
                <?php
                $user_id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                  $row = mysqli_fetch_assoc($sql);
                } else {
                  header("location: users.php");
                }
                ?>
                <a href=" userchat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/1710323188OIP.jpg" alt="">
                <div class="details">
                  <span style="color:white"><?php echo $row['name'] ?></span>
                  <p style="color:white"><?php echo $row['status']; ?></p>
                </div>
              </header>

              <div class="chat-box">


              </div>

              <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
              </form>
            </section>
          </div>
          <!--  -->
        </div>
      </div>

  </div>
  </div>
  <script src="javascript/chat.js"></script>

</body>

</html>
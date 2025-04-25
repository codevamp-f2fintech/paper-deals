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
include_once('header.php');
?>
<style>
  .conta {
    text-align: center;
    padding: 50px;
    height: 70%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .laptop-image {
    width: 300px;
    margin-bottom: 20px;
  }
</style>
<div style="display: flex; width: 100%;">

  <div class="content-wrapper" style="width: 20%; position: sticky; top: 0; z-index: 1000; background:#027ff0">
    <section class="sidebar"
      style="height: 100vh; position: sticky; top: 0; z-index: 1000; background:linear-gradient(259.26deg, #006efa, #07cdbe 84.05%) ">

      <div style=" width: 100%;">

        <div>
          <section class="users" style="height: 100%;">
            <header>
              <div class="content">
                <?php
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = $ses_id");
                if (mysqli_num_rows($sql) > 0) {
                  $row1 = mysqli_fetch_assoc($sql);
                }
                ?>
                <img src="consultant.jpg" alt="">
                <div class="details">
                  <span style="color:white">
                    <?php echo $row1['name']; ?>
                  </span>
                  <p style="color:white">
                    <?php //echo $row1['status']; 
                    ?>
                  </p>
                </div>
              </div>
            </header>
            <div class="search">
              <span class="text" style="color:white">Select

                to start chat
              </span>
              <input type="text" placeholder="Enter name to search...">
              <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>

          </section>
        </div>
      </div>
    </section>
  </div>

  <div style="width: 80%;">

    <div class="card-body p-0">
      <section class="chat-area">
        <header style="width: 100%; position: sticky; top: 0; z-index: 1000; background:#027ff0">
          <?php
          $user_id = mysqli_real_escape_string($conn, $_GET['id']);

          if ($_SESSION['role'] == 5) {

            $sqlq = mysqli_query($conn, "SELECT users.* FROM users WHERE users.id != '$ses_id' AND users.status = 'Active Now' AND users.user_type IN (2,3,6)");
          } else {
            $sqlq = mysqli_query($conn, "SELECT users.* FROM users WHERE users.id != '$ses_id' AND users.status = 'Active Now' AND users.user_type IN (5)");
          }

          $row2 = mysqli_fetch_assoc($sqlq);

          ?>
          <!--<a href="" class="back-icon"><i class="fas fa-arrow-left"></i></a>-->
          <!--<img src="php/images/1710323392OIP%20(1).jpg" alt="">-->
          <!--<div class="details">-->
          <!--  <span style="color:white"><?= $row2['name']; ?></span>-->
          <!--  <p style="color:white"><?= $row2['status']; ?></p>-->
    </div>

    </header>
    <?php if (isset($_GET['id'])) { ?>
      <div class="chat-box" style="overflow-y: auto;">

      </div>
      <div class="send" style="position: fixed; bottom: 0; z-index: 1000; background: #027ff0;width:70vw;">
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..."
            autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </div>
    <?php
    } else { ?>
      <div class="conta">
        <div class="content">
          <img src="logopd.jpg" style="border-radius: 0%;" alt="WhatsApp on Laptop" class="laptop-image">
          <h1>Welcome to Paper Deals</h1>
          <p>Our own Chat box where all message are privacy protected</p>
          <p class="encryption-notice">Your personal messages are end-to-end encrypted</p>
        </div>
      <?php } ?>

      </section>
      </div>

  </div>
</div>




<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ready to Leave?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Logout" below if you are ready to end your current session.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="javascript/users.js"></script>
<script src="javascript/chat.js"></script>
</body>

</html>
<?php
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

if (isset($_SESSION["id"])) {
  // Check if the session has expired (8 hours = 28,800 seconds)
  if (time() - $_SESSION["expire"] > 28800) {
    session_unset();   // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to the login page or homepage
    exit(); // Stop further script execution
  }
}

include_once('../connection/config.php');
if (!isset($_SESSION["id"])) {
?>
  <script type="text/javascript">
    window.location.href = '../admin_login.php';
  </script>
<?php
  mysqli_close($conn);
}



$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

function IsUser_Role($role_id)
{
  global $conn;
  $query = mysqli_query($conn, "Select name from roles where id = '" . $role_id . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['name'];
}

function IsUser_Name($id)
{
  global $conn;
  $query = mysqli_query($conn, "Select name from users where id = '" . $id . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['name'];
}

function IsUser_phone($id)
{

  global $conn;
  $query = mysqli_query($conn, "Select * from organization where user_id = '" . $id . "'");
  $get_data = mysqli_fetch_array($query);
  return $get_data['phone'];
}
function IsUser_email($id)
{

  global $conn;
  $query = mysqli_query($conn, "Select * from organization where user_id = '" . $id . "'");
  $get_data = mysqli_fetch_array($query);
  return $get_data['email'];
}
function IsOrganization_Name($user_id)
{
  global $conn;
  $query = mysqli_query($conn, "Select organizations, phone from organization where user_id = '" . $user_id . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['organizations'];
}

function IsDeal_Status($id)
{
  global $conn;
  $query = mysqli_query($conn, "Select deal_status from deals where id = '" . $id . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['deal_status'];
}

function IsDeal_PD_Status($id)
{
  global $conn;
  $query = mysqli_query($conn, "Select deal_status from pd_deals where id = '" . $id . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['deal_status'];
}

function Show_NumRecord($table_name, $status)
{
  global $conn;
  $query = mysqli_query($conn, "Select Count(*) as total from " . $table_name . " where status='" . $status . "'");
  $get_data = mysqli_fetch_array($query);

  return $get_data['total'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link rel="icon" type="image/x-icon" href="../components/fav.jpeg">
  <style>
    span {
      color: red;
      font-size: 22px;
    }

    .btn-secondary span {
      color: white;
      font-size: 16px;
    }
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="css/adminstyle.css">
  <link rel="stylesheet" href="style.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php if ($curPageName == "index.php" || $curPageName == "") { ?>
      <!--Preloader -->



      <!DOCTYPE html>

    <?php } ?>
    <?php include_once('navbar.php'); ?>

    <?php include_once('sidebar.php'); ?>
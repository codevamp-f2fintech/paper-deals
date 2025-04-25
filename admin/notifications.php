<?php

include_once ('../connection/config.php');
if($_POST['type']=="seller"){
$id = $_POST['login_id'];
$sql = "SELECT count(id) as count FROM `enquery_message` where seller_id = $id";
$query_run = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query_run);
echo $data['count'];
}

if($_POST['type']=="admin"){
  
  $sql = "SELECT count(id) as count FROM `enquery_message` where status = 1";
  $query_run = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($query_run);
  echo $data['count'];
  }
 


  ?>
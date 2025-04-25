<?php
include_once ('../connection/config.php');

$id = $_POST['id'];
$sql = "SELECT enquiry.*,users.email_address,users.phone_no,users.name as sname FROM `enquiry` join users on users.id=enquiry.user_id where enquiry.id = $id";
// echo $sql;

$query_run = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query_run);
echo json_encode($data);

  

?>
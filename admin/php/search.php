<?php
session_start();
include_once "../../connection/config.php";

$outgoing_id = $_SESSION['id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT id = {$outgoing_id} AND status='Active now' AND (name LIKE '%{$searchTerm}%' OR email_address  LIKE '%{$searchTerm}%')";
$output = "";
// echo $sql;
// exit; 
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;

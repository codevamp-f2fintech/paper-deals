<?php
session_start();
include_once "../../connection/config.php";
$outgoing_id = $_SESSION['id'];

date_default_timezone_set('Asia/Kolkata');
$current_time = date("h:i A");
$timeWithoutZeros = ltrim($current_time, '0');
$current_date = date("d-m-Y");
;
if ($_SESSION['role'] == 5) {

$sql = "SELECT users.id as user_id, users.name,users.user_type,consultant_slots.*,slot.* FROM users LEFT JOIN consultant_slots ON users.id = consultant_slots.book_id LEFT JOIN slot ON slot.id = consultant_slots.slot_id WHERE  users.id != '$outgoing_id' AND users.user_type IN (2,3,6) AND '$current_date' = consultant_slots.created_on AND '$current_time' BETWEEN slot.from_time AND slot.to_time AND consultant_slots.status=1";
// AND consultant_slots.to_date
    
    
} else {

    $sql = "SELECT users.id as user_id, users.name,users.user_type,consultant_slots.*,slot.* FROM consultant_slots LEFT JOIN users ON users.id = consultant_slots.consultant_id  LEFT JOIN slot ON consultant_slots.slot_id = slot.id WHERE consultant_slots.status=1 AND users.id != '$outgoing_id' AND users.user_type IN (5) AND '$current_date' = consultant_slots.created_on AND '$current_time' BETWEEN slot.from_time AND slot.to_time AND consultant_slots.status=1";
    //  AND '$current_time' BETWEEN slot.from_time AND slot.to_time AND consultant_slots.to_date

}
// echo $sql;
$query = mysqli_query($conn, $sql);
// print_r($query);
// exit;
$output = "";
if (!$query) {
    $output .= "Error: " . mysqli_error($conn);
} elseif (mysqli_num_rows($query) == 0) {
    //$output .= "No one is available to chat";
} else {
    include_once "data.php";
}
echo $output;
?>
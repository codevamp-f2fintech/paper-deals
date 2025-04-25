<?php
session_start();
include_once "../../connection/config.php";
$outgoing_id = $_SESSION['id'];

date_default_timezone_set('Asia/Kolkata');
$current_time = date("h:i A");
$timeWithoutZeros = ltrim($current_time, '0');
$current_date = date("d-m-Y");

if ($_SESSION['role'] == 5) {
    // $sql = "SELECT * FROM users WHERE not id=$outgoing_id AND status='Active Now' AND  user_type IN (2, 3,6)";

    $sql = "SELECT 
    users.*, 
    consultant_slots.created_on AS book_date,
    consultant_slots.to_date AS new_book_date,
    slot.from_time,
    slot.to_time 
FROM 
    users 
LEFT JOIN 
    consultant_slots ON users.id = consultant_slots.book_id 
LEFT JOIN 
    slot ON consultant_slots.slot_id = slot.id 
WHERE 
    users.id != $outgoing_id 
    AND users.status = 'Active Now' 
    AND users.user_type IN (2, 3, 6)
   AND '$current_date' BETWEEN consultant_slots.created_on AND consultant_slots.to_date
    AND TIME('$timeWithoutZeros') BETWEEN TIME(slot.from_time) AND TIME(slot.to_time)";

} else {
    // $sql = "SELECT * FROM users WHERE not id=$outgoing_id AND status='Active Now' AND  user_type IN (5)";

    $sql = "SELECT 
    users.*, 
    consultant_slots.created_on AS book_date,
    consultant_slots.to_date AS new_book_date,
    slot.from_time,
    slot.to_time 
FROM 
    users 
LEFT JOIN 
    consultant_slots ON users.id = consultant_slots.consultant_id 
LEFT JOIN 
    slot ON consultant_slots.slot_id = slot.id 
WHERE 
    users.id != $outgoing_id 
    AND users.status = 'Active Now' 
    AND users.user_type IN (5)
   AND '$current_date' BETWEEN consultant_slots.created_on AND consultant_slots.to_date
    AND TIME('$timeWithoutZeros') BETWEEN TIME(slot.from_time) AND TIME(slot.to_time)";

}

$query = mysqli_query($conn, $sql);
$output = "";
if (!$query) {
    $output .= "Error: " . mysqli_error($conn);
} elseif (mysqli_num_rows($query) == 0) {
    $output .= "No one is available to chat";
} else {
    include_once "data.php";
}
echo $output;
?>
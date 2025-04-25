<?php
session_start();
include_once "../../connection/config.php";
$email = mysqli_real_escape_string($conn, $_POST['email_address']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email_address = '{$email}' AND user_type IN (2, 3, 5,6)");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $user_pass = md5($password);
        $enc_pass = $row['password'];
        if ($user_pass === $enc_pass) {
            $status = "Active Now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE id = {$row['id']} AND user_type IN (2, 3, 5,6)");
            if ($sql2) {
                $_SESSION['id'] = $row['id'];
                echo "success";
            } else {
                echo "Something went wrong. Please try again!";
            }
        } else {
            echo "Email or Password is Incorrect!";
        }
    } else {
        echo "$email - This email not Exist!";
    }
} else {
    echo "All input fields are required!";
}
?>
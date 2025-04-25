<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "../../connection/config.php";
        $outgoing_id = $_SESSION['id'];
        if($_SESSION['role']==5){
        $consid = $_SESSION['id'];
        }else{
           $consid=""; 
        }
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,consultant_id)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$consid}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>
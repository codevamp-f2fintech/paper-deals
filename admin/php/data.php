<?php
    while($row = mysqli_fetch_assoc($query)){
    // print_r($row);
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_id']}
                OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="userchat.php?id='. $row['user_id'] .'">
                    <div class="content">
                    <img src="php/images/1710323392OIP (1).jpg" alt="">
                    <div class="details">
                        <span style="color:white">'. $row['name'].'</span>
                        <p style="color:#000">Chat Now</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'" style="color:green;"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>
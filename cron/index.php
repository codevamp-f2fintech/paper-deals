<?php   

include ('../connection/config.php');

$sql="SELECT * FROM `users` where token !='' AND msg_status = 1";
$run = mysqli_query($conn,$sql);
$msg = array(
    "body"=> "have a Enquery",
    "title"=>"New Message"
    );
while($data = mysqli_fetch_assoc($run)){ 
    
  $id=$data['id'];
  $to = $data['token'];  
  sendNotification($to,$msg);
   $sql="UPDATE `users` SET `msg_status` = '2' WHERE `users`.`id` = $id";
// echo $sql;
// exit;
    $result=mysqli_query($conn,$sql);
  
 }

function sendNotification($to ="",$data=array()){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
       
        "to"=>$to,
        "notification"=>$data
    );

    $headers=array(
        'Authorization: key=AAAAWNL8WGs:APA91bEwl4wcelSUWpITej5r7D_r1RVxQhS-J6N-fq2OUH4rIXxe6VMBuHdDZEXRYN3RHQ75xfTDTguyp7kedG0XqPgJBm-V8wSRJxNFFUTvbo9OKYf1JtA2dp9fNyC19gU7OyKCi3As',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    echo "<pre>";
    print_r($result);
    curl_close($ch);
}


?>










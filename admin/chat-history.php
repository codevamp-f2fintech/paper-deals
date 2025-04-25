<?php
include_once('header.php');
include('../connection/config.php');

$id = $_SESSION['id'];
?>

<style>

.chat {
    font-size: 1rem;
    background-color: #fff;
    /*padding: 5rem 2rem;*/
    /*display: flex;*/
    flex-direction: column;
    /*gap: 1.5rem;*/
    max-height: 439px;
    overflow: hidden;
}

.chat::-webkit-scrollbar {
    width: 0 !important;
}

.chat {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.chat:hover {
    overflow: hidden;
    overflow-y: scroll;
}
@media (max-width: 400px) {
    .chat {
        overflow: auto;
        -webkit-overflow-scrolling: touch;
    }
}

.userimg {
    width: 40px;
    height: 40px;

}

.santaSays {
    display: flex;
    align-items: end;
    gap: 1.3rem;
}

.text-box-santa>.text>p {
    background-color: #eff3f6;
    padding: 1.3rem;
    width: fit-content;
    max-width: 250px;
    border-radius: 1px;
}

.text-box-santa>.text>p:not(.text-box-santa>.text>p:nth-of-type(1)) {
    margin-top: 1.5rem;
}

.userSays {
    margin-top: 3rem;
}

.userSays>.text {
    display: flex;
    flex-direction: column;
    align-items: end;
}

.userSays>.text>p {
    background-color: #dff4fc;
    padding: 1.3rem;
    width: fit-content;
    max-width: 250px;
    border-radius: 1px;
}

.userSays>.text>p:not(.userSays>.text>p:nth-of-type(1)) {
    margin-top: 1.5rem;
}
</style>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                    Chat History
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
              <?php 
      
   
          $outgoing_id = $_GET['in'];
          $incoming_id = $_GET['out'];

          $output = "";
          $sql = "SELECT * FROM messages WHERE (outgoing_msg_id IN ($incoming_id,$outgoing_id) AND incoming_msg_id IN ($incoming_id,$outgoing_id))";
                   
                $sql1="SELECT name,id,user_type FROM `users` where id=$outgoing_id";  
                 $sql2="SELECT name,id,user_type FROM `users` where id=$incoming_id";
                
              
          $query = mysqli_query($conn, $sql);
                    $query1 = mysqli_query($conn, $sql1);
          $query2 = mysqli_query($conn, $sql2);
$row1 = mysqli_fetch_assoc($query1); 
$row2 = mysqli_fetch_assoc($query2); 

if($row2['user_type']==2){
    $user="Seller";
}else if($row2['user_type']==3){
        $user="Buyer";
}else if($row2['user_type']==6){
    $user="Guest";
}


?>
            
            <div style="display:flex;justify-content: space-between; margin-bottom:12px;">
             <div style="width:250px;height:50px;background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);padding:12px;color:white;border-radius:10px;">
                <?php  echo $row2['name']." (".$user.")";  ?> 
            </div>
             <div style="width:250px;height:50px;background:linear-gradient(45deg, #1078FF 0%, #00DFDF 70%);padding:12px;color:white;border-radius:10px;">
                <?php  echo $row1['name']." (Consultant)";  ?> 
            </div>
            </div>
     
            
<?php 
              while($row = mysqli_fetch_assoc($query)){
                 ?>
                <div class="chat" style="margin-bottom:16px">
                    
                           <?php if($row['outgoing_msg_id']==$incoming_id){ ?>
                           
                <div class="santaSays">
                    <div class="img-box">
                      
                        <img class="userimg" src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/consultant.jpg" alt="santaimg">
                    </div>
                    <div class="text-box-santa">
                        <div class="text">
                           <?php echo $row['msg']; ?><span style="font-size:18px;color:green;"> (<?php echo date("d M Y H:sa", strtotime($row['created_at'])); ?>
)</span>
                         
                        </div>
                    </div>
                </div>
                 <?php } ?>
                <?php if($row['outgoing_msg_id']==$outgoing_id){ ?>
                <div class="userSays">
                    <div class="text">
                        
                    <img class="userimg" src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/send.png" alt="santaimg">

                       <span style="font-size:18px;color:#1078FF;"><?php  echo "".$row['msg'];  ?> (<?php echo date("d M Y H:sa", strtotime($row['created_at'])); ?>
                       )</span>
                        
                    </div>
                </div>
                <?php } ?>
            </div>
                
          <?php    }
         
         
        ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>
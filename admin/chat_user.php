<?php
include_once('header.php');
include('../connection/config.php');

$id = $_SESSION['id'];
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                    Chat Users
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr style="text-align:center">
                                <th>ID</th>
                                   <th>Buyer/Seller/Guest</th>
                                <th>Consultant</th>
                             
                                <th>Message</th>
                                <!-- <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                       
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT *
FROM `messages`
WHERE `consultant_id` !=0
GROUP BY `consultant_id`";
                            } else {
                                $query = "SELECT * From messages where consultant_id=$id GROUP BY outgoing_msg_id  ORDER BY msg_id DESC";
                            }
                            //echo $query; die();
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                            ?>
                                    <tr style="text-align:center">
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                  
                                        <td>
                                            <?php $sql = "Select * from users where id = $prod_item[incoming_msg_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    echo $item['name'];
                                                }
                                            }
                                            ?>
                                        </td>
                                              <td>
                                            <?php $sql = "Select * from users where id = $prod_item[outgoing_msg_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    echo $item['name'];
                                                }
                                            }
                                            ?>
                                        </td>
                                         <td>

                                            <div class="modal fade" id="exampleModalToggle<?php echo $unique_identifier; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close" style="background:transparent;color:red; border:none; padding-bottom: 5px; font-size:16px; ;" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> Cancel message</button>
                                                            <hr>
                                                            <p class="mt-4"><?= $prod_item['msg']; ?></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <a href="chat-history.php?in=<?php echo $prod_item['outgoing_msg_id']; ?>&out=<?php echo $prod_item['incoming_msg_id']; ?>"><button style="border:none; background-color:transparent; color:#007BFF" data-bs-target="#exampleModalToggle<?php echo $unique_identifier; ?>" data-bs-toggle="modal">Read</button>
</a>
                                            <!-- <button style="border:none; background-color:transparent; color:#007BFF" data-bs-target="#exampleModalToggle<?php echo $unique_identifier; ?>" data-bs-toggle="modal">Read</button> -->
                                        </td>
                                        <!-- <td>
                                            <?php //echo $prod_item['created_at']; ?>
                                        </td> -->
                                    </tr>
                                <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="13" class="dataTables_empty">No Record found</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
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
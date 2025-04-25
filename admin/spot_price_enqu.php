<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:95%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                            View Spot Price Enquiry
                        </h4>

                    </div>
                    <div class="card">
<style>
    .card-body {
    overflow-x: auto;
}

.table th, .table td {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
</style>
  
                <div class="card-body " style="overflow-x:auto;">
                    <table class="table " id="example1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Seller Name</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email ID</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $query = "select * from  spot_price_enquiry";
                                    $query = "SELECT spot_price_enquiry.*, spot_price.product_id, spot_price.seller_id from spot_price_enquiry LEFT JOIN spot_price ON spot_price_enquiry.spot_price_id = spot_price.id ORDER By spot_price_enquiry.id DESC";

                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $prod_item) {
                                            // echo $row['name'];
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $prod_item['id']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    ini_set('display_errors', 1);
                                                    ini_set('display_startup_errors', 1);
                                                    error_reporting(E_ALL);
                                                    $sql = "Select * from product_new where id=$prod_item[spot_price_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['product_name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    ini_set('display_errors', 1);
                                                    ini_set('display_startup_errors', 1);
                                                    error_reporting(E_ALL);
                                                    $sql = "Select * from users where id=$prod_item[spot_price_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['name']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['phone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['email_id']; ?>
                                                </td>
                                                <td>

                   
                                      <button style="border:none; background-color:transparent; color:#007BFF" value="<?php echo $prod_item['message']; ?>" class="read-more">Read</button>
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($prod_item['status'] == 0) {
                                                    ?><a style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;" fffefca>Pending <i class="fa-regular fa-clock" style="color:#BC3803"></i></a>
                                                    <?php
                                                    } elseif ($prod_item['status'] == 1) {
                                                    ?><a style="width:100px ;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Completed <i class="fa-solid fa-check " style="color:#1C6C09"></i></a>
                                                    <?php
                                                    } else {
                                                    ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Rejected <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="spot_price_enquiry_edit.php?prod_id=<?php echo $prod_item['id']; ?>" class="">View</a>
                                                </td>
                                            </tr>
                                        <?php
                                           
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="colspan-8">No Record found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close text-center" style="background:transparent;color:red; border:none; padding-bottom: 5px; font-size:16px; ;" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> Cancel message</button>
                                                            <hr>
                                                            <p class="mt-4" id="message"></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
               

        $(".read-more").click(function(){
           
            var msg = $(this).val();
             $('#message').text(msg);
            $("#exampleModalToggle").modal('show');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>
<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div>
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                    Deal Process Report
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table  table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Buyer</th>
                                <th>Seller</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Product Description</th>

                                <th>Deal Size</th>

                                <?php if ($role == 1) { ?>
                                    <th>Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>

                                    <th>Remarks</th>
                                <?php } ?> <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From deals where deal_status=7 ORDER BY id DESC";
                            } else {
                                $query = "SELECT * FROM deals WHERE status=1 AND deal_status=7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "') ORDER BY id DESC";
                            }
                            //echo $query; die();
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['contact_person']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['mobile_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['email_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>


                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                        <?php if ($role == 1) { ?>
                                            <td>
                                                <?php echo $prod_item['commission']; ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                            <td>
                                                <?php echo $prod_item['buyer_commission']; ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                            <td>
                                                <?php echo $prod_item['seller_commission']; ?>
                                            </td>
                                        <?php } ?>
                                        <!-- <td>
                                          
                                        </td> -->
                                        <td>

                                            <div class="modal fade" id="exampleModalToggle<?php echo $unique_identifier; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close" style="background:transparent;color:red; border:none; padding-bottom: 5px; font-size:16px; ;" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> Cancel remark</button>
                                                            <hr>
                                                            <p class="mt-4"> <?php echo $prod_item['remarks']; ?></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button style="border:none; background-color:transparent; color:#007BFF" data-bs-target="#exampleModalToggle<?php echo $unique_identifier; ?>" data-bs-toggle="modal">Read</button>
                                        </td>
                                        <td>
                                            <?php if ($prod_item['status'] == 1) {
                                            ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active </a>
                                            <?php
                                            } else {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">inactive </a>
                                            <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <a style=" #width:95px;  padding:2% 4%;border-radius:6px;height:10px;" href="deal_process_report.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>">View</a>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
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
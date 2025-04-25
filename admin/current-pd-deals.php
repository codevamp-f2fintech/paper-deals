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
                    Current Deals
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table table-responsive" id="currentpddeal">
                        <thead>
                            <tr>
                                <th>Sr. NO.</th>
                                <th>Deal Id</th>
                                <th>PD Executive</th>
                                <th>Mobile No</th>
                                <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer</th>
                                    <th>Buyer No</th>
                                <?php } ?>
                                <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller</th>
                                    <th>Seller No</th>
                                <?php } ?>
                                <!-- <th>Email Id</th> -->

                                <th>Product</th>
                                <th>Category</th>

                                <th style="width:200px;">Deal Size (in ton)</th>
                                <th>Price Per Kg</th>

                                <th>Deal Amount</th>

                                <?php
                                if ($_SESSION['role'] == 1) { ?>
                                    <th>Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?>



                                <th>Remarks</th>
                                <th>Date</th>

                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From pd_deals where deal_status < 7 AND status=1 ORDER BY id ASC";
                            } else {
                                $query = "SELECT * FROM pd_deals WHERE status=1 AND deal_status<7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "') ORDER BY id ASC";
                            }
                            // echo $query;
                            // exit;
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                                    // print_r($prod_item);
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            000<?php echo $prod_item['deal_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['user_id']); ?>
                                        </td>
                                        <td>
                                            <?php $Id = $prod_item['user_id'];
                                            $query = mysqli_query($conn, "Select * from users where user_type=1 and active_status=1 AND id=$Id");
                                            $data1 = mysqli_fetch_assoc($query);
                                            echo $data1['phone_no'];
                                            ?>
                                        </td>
                                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                            <td>
                                                <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                            </td>
                                            <td>
                                                <?php echo IsUser_phone($prod_item['buyer_id']); ?>
                                            </td>
                                        <?php } ?>
                                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                            <td>
                                                <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                            </td>
                                            <td>
                                                <?php echo IsUser_phone($prod_item['seller_id']); ?>
                                            </td>
                                        <?php } ?>
                                        <!-- <td>
                                            <?php //echo $prod_item['email_id']; 
                                            ?>
                                        </td> -->

                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>
                                        <td>
                                            <?php

                                            if ($prod_item['category'] != 0) {
                                                $catid = $prod_item['category'];
                                            } else {
                                                $catid = "";
                                            }

                                            $sqlrun = mysqli_query($conn, "Select * from new_category where id='$catid'");
                                            echo mysqli_fetch_assoc($sqlrun)['name'];


                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['price_per_kg']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_amount']; ?>
                                        </td>
                                        <?php
                                        if ($_SESSION['role'] == 1) { ?>
                                            <td>
                                                <?php echo $prod_item['commission']; ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        if ($_SESSION['role'] == 1) { ?>
                                            <td>
                                                <?php echo $prod_item['buyer_commission']; ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        if ($_SESSION['role'] == 1) { ?>
                                            <td>
                                                <?php echo $prod_item['seller_commission']; ?>
                                            </td>
                                        <?php } ?>


                                        <style>
                                            #dropdownMenuButton1 {

                                                /* background-color: #F9FAFB; */
                                                text-align: center;

                                                background-size: 200% auto;
                                                color: #007BFF;
                                                /* box-shadow: 0 0 20px #eee; */
                                                border-radius: 4px;

                                                transition: all 0.3s;
                                            }

                                            #dropdownMenuButton1:hover {
                                                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
                                                color: #767676;
                                                text-decoration: none;
                                            }
                                        </style>


                                        <!-- =================== -->

                                        <!-- =========================================== -->
                                        <td>
                                            <?php echo $prod_item['remarks'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
                                        <td>
                                            <?php if ($prod_item['status'] == 1) {
                                            ?><a
                                                    style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active
                                                </a>
                                            <?php
                                            } else {
                                            ?><a
                                                    style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">inactive
                                                </a>
                                            <?php
                                            } ?>
                                        </td>
                                        <td style="text-align:center;  ">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                                    style="border:none;">

                                                    <li>
                                                        <a href="edit-pd-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?= htmlspecialchars($prod_item['id']); ?>"
                                                            class="dropdown-item">
                                                            <?php echo ($role == 1) ? 'Edit' : 'View'; ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>

                                <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="17">No Record or Data found</td>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js"
    integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>
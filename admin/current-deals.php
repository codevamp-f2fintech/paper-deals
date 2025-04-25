<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12 ">
            <?php include("message.php"); ?>
            <div>
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                    Current Deals
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table table-responsive" id="dataTable">
                        <thead>
                            <tr>

                                <th>Deal ID</th>
                                <th>Buyer</th>
                                <th>Seller</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Deal Size</th>
                                <th>Deal Amount</th>

                                <th>Product Description</th>

                                <th> Remarks</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * FROM deals WHERE deal_status < 7 ORDER BY deal_id ASC";
                            } else {
                                $query = "SELECT * FROM deals WHERE status = 1 AND deal_status < 7 AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') ORDER BY deal_id ASC";
                            }
                            // echo $query;
                            // die();
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                            ?>
                                    <tr>

                                        <td>
                                            <?php echo '000' . $prod_item['deal_id']; ?>
                                        </td>
                                        <td>
                                            <?php

                                            $b_id = $prod_item['buyer_id'];
                                            if ($b_id != 0) {
                                                $organization = "SELECT * FROM `organization` WHERE user_id='$b_id'";

                                                $organizationquery = mysqli_query($conn, $organization);
                                                $organizationqueryrow = mysqli_fetch_assoc($organizationquery);
                                                echo $organizationqueryrow['organizations'];
                                            } else {
                                                echo $prod_item['buyer'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $s_id = $prod_item['seller_id'];
                                            $sql = "SELECT * FROM `organization` WHERE user_id='$s_id'";

                                            $query = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                            echo $row['organizations'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $b_id = $prod_item['buyer_id'];
                                            $sql = "SELECT * FROM `organization` WHERE user_id='$b_id'";

                                            $query = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                            echo $row['organizations'];
                                            ?>
                                        </td>
                                        <td>

                                            <?php if ($_SESSION['role'] == 2) {
                                                echo substr($prod_item['mobile_no'], 0, 5) . "XXXXX";
                                            } else {
                                                echo $prod_item['mobile_no'];
                                            }   ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['role'] == 2) {
                                                echo substr($prod_item['email_id'], 0, 6) . "XXXXX";
                                            } else {
                                                echo $prod_item['email_id'];
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_amount']; ?>
                                        </td>


                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>

                                        <td style=" border-left:1px solid #dbdbdb;  border-bottom:1px solid #dbdbdb;">
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                        <td style=" border-left:1px solid #dbdbdb;  border-bottom:1px solid #dbdbdb;">
                                            <?php echo $prod_item['created_on']; ?>
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

                                        <!-- ============================================== -->
                                        <style>
                                            #dropdownMenuButton1 {

                                                background-color: #F9FAFB;
                                                text-align: center;

                                                background-size: 200% auto;
                                                color: #007BFF;
                                                box-shadow: 0 0 20px #eee;
                                                border-radius: 4px;

                                                transition: all 0.3s;
                                            }

                                            #dropdownMenuButton1:hover {
                                                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
                                                color: #767676;
                                                text-decoration: none;
                                            }
                                        </style>
                                        <td style="text-align:center">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <!-- <a class=" dropdown-item"
                                                    href="view-details.php?role=<?= $_SESSION['role']; ?>&user_type=2&prod_id=<?= $prod_item['id']; ?>">
                                                    Edit
                                                </a> -->
                                                    </li>

                                                    <?php if ($role == 1 || $role == 2 || $role == 3) { ?>

                                                        <li>
                                                            <a href="current-edit-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?= $prod_item['id']; ?>" name="change_password" class="dropdown-item"><?php if ($role == 1) {
                                                                                                                                                                                                                echo 'Edit';
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo 'View';
                                                                                                                                                                                                            } ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                </div>
                </td>


                </tr>

            <?php
                                    $i++;
                                }
                            } else {
            ?>
            <tr>
                <td colspan="24" class="dataTables_empty">No Record found</td>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>
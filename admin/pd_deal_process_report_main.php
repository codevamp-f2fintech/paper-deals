<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="card-header mt-4">
                <h4>
                    PD Deal Process Report
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
                                $query = "SELECT * From pd_deals where deal_status=7 ORDER BY id DESC";
                            } else {
                                $query = "SELECT * FROM pd_deals WHERE status=1 AND deal_status=7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "') ORDER BY id DESC";
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
                                        <td>
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                        <td>
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
                                        <td>
                                            <a style=" #width:95px;  padding:2% 4%;border-radius:6px;height:10px;" href="pd_deal_process_report.php?prod_id=<?php echo $prod_item['id']; ?>">View</a>
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
<?php
include("footer.php");
?>
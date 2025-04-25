<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include ("message.php"); ?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Target Deals
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Buyer</th>
                                <th>Seller</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Product Description</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Deal Size</th>
                                <th>Commission</th>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From deals where deal_status=7";
                            } else {
                                $query = "SELECT * From deals where status=1 AND deal_status=7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
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
                                            <?php if ($prod_item['status'] == 1) {
                                                ?><a class="badge badge-success">Active</a>
                                                <?php
                                            } else {
                                                ?><a class="badge badge-danger">Inactive</a>
                                                <?php
                                            } ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>

                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['commission']; ?>
                                        </td>
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
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Sampling
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Date of Sampling</th>
                                <th>Sampling Verfication</th>
                                <th>Lab Report</th>
                                <th>Remarks</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From sampling";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['dos']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['sample_verification']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['lab_report']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_doc']; ?>" alt="" width="100px" height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>

                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php
                                        $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Validation
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Date of Validation</th>
                                <th>Sample</th>
                                <th>Stock Approved</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From validation";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['dov']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['sample']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['stock_approve']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_docu']; ?>" alt="" width="100px" height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->
                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Clearance
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Clearance Date</th>
                                <th>Product</th>
                                <th>Remarks</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From clearance";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['doc']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['product']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_docum']; ?>" alt="" width="100px" height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Payment
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Transaction Date</th>
                                <th>Transaction Status</th>
                                <th>Detail</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From payment";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['transaction_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['product']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['details']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_docume']; ?>" alt="" width="100px" height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Transportation
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Transportation Date</th>
                                <th>Date</th>
                                <th>Mean Of Transport</th>
                                <th>Vehicle No.</th>
                                <th>Ammount Incured</th>
                                <th>Expected Date of Delivery</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From transportation";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['transportation_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['mot']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['vehicle_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['ammount_incured']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['edd']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_documen']; ?>" alt="" width="100px" height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Closed
                    </h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <!-- <th>Buyer</th>
                                <th>Seller</th> -->
                                <th>Closed Date</th>
                                <th>Product</th>
                                <th>Remarks</th>
                                <th>Product recd. by</th>
                                <th>Deal Size</th>
                                <th>Upload Document</th>
                                <th>Action</th>
                                <!-- <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                    <th>Buyer Commission</th>
                                <?php } ?>
                                <?php
                                if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                    <th>Seller Commission</th>
                                <?php } ?> -->
                                <!-- <th>Remarks</th>
                                <th>Date</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1) {
                                $query = "SELECT * From close";
                            } //else {
                            //     $query = "SELECT * From deals where status=1 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "')";
                            // }
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
                                            <?php echo $prod_item['close_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['product']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['product_recd']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                        <td>
                                            <img src="<?= $prod_item['upload_document']; ?>" alt="" width="100px"
                                                height="100px">
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->


                                                <form action="#" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                    <button type="submit" name="deactive_deal"
                                                        class="btn btn-danger">Delete</button>
                                                    <br>
                                                    <a href="current-edit-deal.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </form>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <?php $i++;
                                }
                                ?>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td class="colspan-13">No Record found</td>
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
include ("footer.php");
?>
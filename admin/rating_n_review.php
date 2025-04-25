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
                        Rating and Review
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Buyer Name</th>
                                <th>Seller Name</th>
                                <th>B.Id</th>
                                <th>S.Id</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Update</th>
                                <th>Action</th>
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
                                            <?php if ($prod_item['status'] == 1) {
                                                ?><a class="badge badge-success">Active</a>
                                                <?php
                                            } else {
                                                ?><a class="badge badge-danger">Inactive</a>
                                                <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="hide">
                                                <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->
                                                <a href="billing_detail.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">
                                                    <?php if ($role == 1) {
                                                        echo 'Edit';
                                                    } else {
                                                        echo 'View';
                                                    } ?>
                                                </a>
                                            </div>
                                            <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
include ("footer.php");
?>
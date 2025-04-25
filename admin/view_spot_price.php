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
                        <?php if ($role == 4) {
                            echo "Stock Price";
                        } else { ?> View Spot Price<?php } ?>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Seller Name</th>
                                <th>Name</th>
                                <th>Hsn no.</th>
                                <th>Quantity</th>
                                <th>Spot Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From product_detail  ORDER BY id DESC";
                            } else if ($_SESSION['role'] == 2) {
                                $query = "SELECT * FROM product_detail WHERE  status='1' and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                            }
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
                                            <?php $sql = "Select * from product where seller_id=$prod_item[product_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    echo $item['product_name'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php $sql = "Select * from users where id=$prod_item[seller_id]";
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
                                            <?php echo $prod_item['hsn_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['quantity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['spot_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_at']; ?>
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
                                                <?php if ($role == 1 || $role == 2) { ?><a
                                                        href="edit_mic_price.php?role=1&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a><?php } else { ?>
                                                    <a href="see_mic_price.php?role=1&prod_id=<?php echo $prod_item['id']; ?>"
                                                        class="btn btn-success">View</a>
                                                <?php } ?>
                                                <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                                    <hr><?php } ?>
                                                <?php if ($role == 1 || $role == 4 || $role == 2) { ?>
                                                    <?php if ($prod_item['status'] == '1') { ?>
                                                        <?php if ($role == 1 || $role == 2) { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <button type="submit" name="sp_deactive_user"
                                                                    class="btn btn-danger">Deactive</button>
                                                            </form> <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ($role == 1 || $role == 2) { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <button type="submit" name="sp_active_user"
                                                                    class="btn btn-danger">Active</button>
                                                            </form> <?php } ?>
                                                    <?php } ?>
                                                    <?php if ($role == 1 || $role == 2) { ?>
                                                        <hr><?php } ?>
                                                    <?php if ($role == 1 || $role == 2) { ?>
                                                        <form action="code.php" method="post">
                                                            <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                            <button type="submit" name="spot_price_delete_btn"
                                                                class="btn btn-danger">Delete</button>
                                                        </form> <?php } ?>
                                                </div>
                                                <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                                } else {
                                                    ?>
                                        <tr>
                                            <td colspan="13" class="dataTables_emaster_productty">No Record found</td>
                                        </tr>
                                        <?php
                                                }
                                }
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
<?php
include_once ('header.php');
include ('../connection/config.php');
$ss = $_SESSION['id'];
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Add Master Product
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?= $ss; ?>" name="product_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="product_name" class="form-control"
                                                placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="text-white">Save</label>
                                            <button type="submit" name="save_master_product"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                View Master Product
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1) {
                                        $query = "SELECT * From master_product where status=1";
                                    } else if ($_SESSION["role"] == 2) {
                                        $query = "SELECT * From master_product where status=1 AND product_id='" . $_SESSION["id"] . "'";
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
                                                    <?php echo ($prod_item['product_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['craeted_at']; ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <div class="hide">
                                                        <a href="edit_master_poduct.php?role=3&prod_id=<?php echo $prod_item['id']; ?>"
                                                            class="btn btn-success">Edit</a>
                                                        <hr>
                                                        <?php if ($role == 1 || $role == 2) { ?>
                                                            <?php if ($prod_item['status'] == '1') { ?>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="deactive_master"
                                                                        class="btn btn-danger">Deactive</button>
                                                                </form>
                                                            <?php } else { ?>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="active_master"
                                                                        class="btn btn-danger">Active</button>
                                                                </form>
                                                            <?php } ?>
                                                        </div>
                                                        <a href="#" class="action_div"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                                        } else {
                                                            ?>
                                                <tr>
                                                    <td colspan="13" class="dataTables_empty">No Record found</td>
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
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>
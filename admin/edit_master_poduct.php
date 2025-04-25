<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit Master Product
                            </h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php
                                    if (isset($_GET['prod_id'])) {
                                        $id = $_GET['prod_id'];
                                        $query = "SELECT * from master_product WHERE id=$id";
                                        $query_run = mysqli_query($conn, $query);
                                        $prodItem = mysqli_fetch_array($query_run);
                                        ?>
                                        <div class="col-md-6">
                                            <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="product_name"
                                                    value="<?= $prodItem['product_name']; ?>" class="form-control"
                                                    placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-white">ASve</label>
                                                <button type="submit" name="update_master_product"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </form>
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
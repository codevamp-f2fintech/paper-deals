<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="mt-4">
                    <h4 style="font-size:25px;color:#1C2434;margin:20px 0 20px 10px">
                        Edit Live Stock
                    </h4>
                </div>
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post">
                                <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                                <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $query = "SELECT * from spot_price where id='$id'";
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                    <div class="row">
                                        <input type="hidden" name="deal_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <select name="product_id" class="form-control">
                                                    <?php if ($_SESSION['role'] == 1) {
                                                        $query = mysqli_query($conn, "select * from product_new");
                                                    } elseif ($_SESSION['role'] == 2) {
                                                        $query = mysqli_query($conn, "SELECT * FROM product_new WHERE id='" . $_SESSION['id'] . "'");
                                                    };
                                                    foreach ($query as $row) { ?>
                                                        <option value="<?= $row["id"]; ?>" <?php if ($prodItem['product_id'] == $row['id']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                            <?= $row["product_name"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Seller Name</label>
                                                <select name="seller_id" class="form-control">
                                                    <?php if ($_SESSION['role'] == 1) {
                                                        $query = mysqli_query($conn, "select * from users where user_type=2");
                                                    } elseif ($_SESSION['role'] == 2) {
                                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE user_type=2 AND id='" . $_SESSION['id'] . "'");
                                                    }
                                                    foreach ($query as $row) { ?>
                                                        <option value="<?= $row["id"]; ?>" <?php if ($prodItem['seller_id'] == $row['id']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                            <?= $row["name"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>

                                                <input type="text" name="city" value="<?= $prodItem['city']; ?>" class="form-control" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mill</label>

                                                <input type="text" name="mill" value="<?= $prodItem['mill']; ?>" class="form-control" required placeholder="Mill">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shade</label>
                                                <input type="text" name="shade" value="<?= $prodItem['shade']; ?>" class="form-control" required placeholder="Shade">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gsm</label>
                                                <input type="text" name="gsm" value="<?= $prodItem['gsm']; ?>" class="form-control" required placeholder="Gsm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hsn No.</label>
                                                <input type="text" name="hsn_no" value="<?= $prodItem['hsn_no']; ?>" class="form-control" required placeholder="Hsn No.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input type="text" name="sizes" value="<?= $prodItem['sizes']; ?>" class="form-control" required placeholder="Shade">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="text" name="weights" value="<?= $prodItem['weights']; ?>" class="form-control" required placeholder="Weight">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock in Kg</label>
                                                <input type="text" name="stock_in_kg" value="<?= $prodItem['stock_in_kg']; ?>" class="form-control" required placeholder="Stock in Kg">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price Per Kg</label>
                                                <input type="text" name="price_per_kg" value="<?= $prodItem['price_per_kg']; ?>" class="form-control" required placeholder="Price Per Kg">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Quantity in Kg</label>
                                                <input type="text" name="quantity_in_kg" value="<?= $prodItem['quantity_in_kg']; ?>" class="form-control" required placeholder="Quantity in Kg">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="text-white">x</label>
                                                <button type="submit" name="new_spot_price" class="btn btn-primary btn-block float-right">Update Spot Price</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include("footer.php");
?>
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
                                Edit Spot Price
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">
                                <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                                <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $query = "SELECT * from product_details where id='$id'";
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                    ?>
                                    <div class="row">
                                        <input type="hidden" name="deal_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <select name="product_called" class="form-control" disabled>
                                                    <?php $query = mysqli_query($conn, "select * from master_product");
                                                    foreach ($query as $row) { ?>
                                                        <option value="<?= $row["id"]; ?>" <?php if ($prodItem['product_called'] == $row['id']) {
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
                                                <select name="seller_name" class="form-control" disabled>
                                                    <?php $query = mysqli_query($conn, "select * from users where user_type=2");
                                                    foreach ($query as $row) { ?>
                                                        <option value="<?= $row["id"]; ?>" <?php if ($prodItem['seller_name'] == $row['id']) {
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
                                                <label>State</label>
                                                <select name="states" class="form-control" disabled>
                                                    <option>
                                                        <?= $prodItem['states']; ?>
                                                    </option>
                                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="Uttarakhand">Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mill</label>

                                                <input type="text" name="mill" value="<?= $prodItem['mill']; ?>"
                                                    class="form-control" required placeholder="Mill" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shade</label>

                                                <input type="text" name="shade" value="<?= $prodItem['shade']; ?>"
                                                    class="form-control" required placeholder="Shade" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gsm</label>
                                                <input type="text" name="gsm" value="<?= $prodItem['gsm']; ?>"
                                                    class="form-control" required placeholder="Gsm" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size</label>
                                                <input type="text" name="sizes" value="<?= $prodItem['sizes']; ?>"
                                                    class="form-control" required placeholder="Size" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>weight</label>
                                                <input type="text" name="weights" value="<?= $prodItem['weights']; ?>"
                                                    class="form-control" required placeholder="weight" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price Per Kg</label>
                                                <input type="text" name="stock_in_kg"
                                                    value="<?= $prodItem['stock_in_kg']; ?>" class="form-control" required
                                                    placeholder="Price Per Kg" disabled>
                                            </div>
                                        </div>
                                        <?php if ($role == 1) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <br>
                                                    <button type="submit" name="new_spot_price"
                                                        class="btn btn-primary btn-block float-right">Update Spot Price</button>
                                                </div><?php } ?>
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
include ("footer.php");
?>
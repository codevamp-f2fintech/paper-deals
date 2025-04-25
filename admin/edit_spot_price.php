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
                                <a href="add_spot_price.php" class="btn btn-danger float-right">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">
                                <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                                <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $query = "SELECT * from add_spot_price";
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                    ?>
                                    <div class="row">
                                        <input type="hidden" name="deal_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Category</label>
                                                <select name="select_category" class="form-control">
                                                    <option><?= $prodItem['select_category']; ?></option>
                                                    <option>Yarn</option>
                                                    <option>Cotton</option>
                                                    <option>Seller</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Count</label>

                                                <input type="text" value="<?= $prodItem['count']; ?>" name="count"
                                                    class="form-control" required placeholder="Count">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CSP</label>

                                                <input type="text" value="<?= $prodItem['csp']; ?>" name="csp"
                                                    class="form-control" required placeholder="CSP">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gujarat</label>
                                                <input type="text" value="<?= $prodItem['gujarat']; ?>" name="gujarat"
                                                    class="form-control" required placeholder="Gujarat">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Madhya Pradesh</label>
                                                <input type="text" name="mp" value="<?= $prodItem['mp']; ?>"
                                                    class="form-control" required placeholder="Madhya Pradesh">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>South Zone</label>
                                                <input type="text" value="<?= $prodItem['north_zone']; ?>" name="north_zone"
                                                    class="form-control" required placeholder="South Zone">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>North Zone</label>
                                                <input type="text" value="<?= $prodItem['south_zone']; ?>" name="south_zone"
                                                    class="form-control" required placeholder="North Zone">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <br>
                                                <button type="submit" name="update_spot_price"
                                                    class="btn btn-primary btn-block float-right">Update Spot Price</button>
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
include ("footer.php");
?>
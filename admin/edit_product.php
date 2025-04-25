<?php
include_once ('header.php');
include ('../connection/config.php');
$pin=$_GET['role'];
$pop=$_GET['user_type'];
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php
            if (isset($_GET['prod_id'])) {
                $product_id = $_GET['prod_id'];
                $query = "select * from product_new where id='$product_id'";
                $query_run = mysqli_query($conn, $query);
                $prodItem = mysqli_fetch_array($query_run);
                ?>
                 <?php include ("message.php"); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Product <a class="btn btn-danger float-sm-right" onclick="history.go(-1)">Back</a></h4>
                    </div>

                    <div class="card-body">
                        <form action="code.php" method="post" enctype="multipart/form-data">
                        <?php  
                        $selid=$_SESSION['id'];
                        $return_url = "view-details.php?role=$pin&prod_id=$selid"; ?>
                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                            <div class="row">
                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="shade">Category</label>
                                                        <select name="category_id" class="form-control" <?= $class; ?>>
                                                            <option value="">--Select Category--</option>
                                                            <?php
                                                            $query = mysqli_query($conn, "Select * From new_category");
                                                            while ($data = mysqli_fetch_array($query)) { ?>
                                                                <option value="<?= $data['name'] ?>" <?php if ($prodItem["category_id"] == $data['id']) {
                                                                      echo 'Selected';
                                                                  } ?>>
                                                                    <?= $data['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="seller_id" value="<?= htmlspecialchars($product_id); ?>">
                                    <div class="form-group">
                                        <label for="product_name">Product</label>
                                        <input type="text" name="product_name" value="<?= $prodItem['product_name'];?>" id="product_name" class="form-control"
                                            placeholder="Enter Product" <?= $class; ?>>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sub_product">Sub Product</label>
                                        <input type="text" name="sub_product" value="<?= $prodItem['sub_product'];?>" id="sub_product" class="form-control"
                                            placeholder="Enter Sub Product" <?= $class; ?>>
                                    </div>
                                </div>
                                <?php if ($_GET['user_type'] == 2) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shade">Shade</label>
                                            <input type="text" name="shade" value="<?= $prodItem['shade'];?>" id="shade" class="form-control" placeholder="Shade"
                                                <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gsm">Gsm</label>
                                            <input type="text" name="gsm" value="<?= $prodItem['gsm'];?>" id="gsm" class="form-control" placeholder="Gsm"
                                                <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hsn_no">Hsn No.</label>
                                            <input type="text" name="hsn_no" value="<?= $prodItem['hsn_no'];?>" id="hsn_no" class="form-control" placeholder="Hsn No."
                                                <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="size">Size</label>
                                            <input type="text" name="size" value="<?= $prodItem['size'];?>" id="size" class="form-control" placeholder="Size"
                                                <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="size">Bf</label>
                                            <input type="text" name="bf" value="<?= $prodItem['bf'];?>" id="bf" class="form-control" placeholder="Bf">
                                               
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="weight">Weight</label>
                                            <input type="text" name="weight" value="<?= $prodItem['weight'];?>" id="weight" class="form-control"
                                                placeholder="Weight" <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_in_kg">Stock in Kg</label>
                                            <input type="text" name="stock_in_kg" value="<?= $prodItem['stock_in_kg'];?>" id="stock_in_kg" class="form-control"
                                                placeholder="Stock in Kg" <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price_per_kg">Price per Kg</label>
                                            <input type="text" name="price_per_kg"value="<?= $prodItem['price_per_kg'];?>"  id="price_per_kg" class="form-control"
                                                placeholder="Price per Kg" <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quantity_in_kg">Quantity in Kg</label>
                                            <input type="text" name="quantity_in_kg" value="<?= $prodItem['quantity_in_kg'];?>" id="quantity_in_kg" class="form-control"
                                                placeholder="Quantity in Kg" <?= $class; ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Upload Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['image']; ?>">
                                                    <?php if (!empty($prodItem['image'])) { ?>
                                                        <a href="download_new_product.php?prod_id=<?php echo $product_id; ?>">Download
                                                            Now</a> | <a href="<?= $prodItem['image']; ?>" target="_blank">View
                                                            Document</a>
                                                    <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="other">Other</label>
                                        <textarea name="other" id="other"  class="form-control"
                                            placeholder="Other"><?= $prodItem['other'];?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 float-right">
                                    <div class="form-group">
                                        <label class="text-white">x</label>
                                        <?php if ($_GET['user_type'] == 2) { ?>
                                            <button type="submit" name="new_product_edit"
                                                class="btn btn-primary btn-block float-right">Update</button>
                                        <?php } else { ?>
                                            <button type="submit" name="new_product_edit_buyer"
                                                class="btn btn-primary btn-block float-right">Update</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>
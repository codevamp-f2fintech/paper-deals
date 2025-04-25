<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from product_new where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
            ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include ("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Products -Edit
                                    <a href="product-add.php" class="btn btn-danger float-right">Back</a>
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="shade">Category</label>
                                                        <select name="category_id" class="form-control" <?= $class; ?>>
                                                            <option value="">--Select Category--</option>
                                                            <?php
                                                            $query = mysqli_query($conn, "Select * From new_category");
                                                            while ($data = mysqli_fetch_array($query)) { ?>
                                                                <option value="<?= $data['name'] ?>" <?php if ($prodItem["category_id"] == $data['name']) {
                                                                      echo 'Selected';
                                                                  } ?>>
                                                                    <?= $data['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <input type="hidden" name="seller_id"
                                                    value="<?= htmlspecialchars($product_id); ?>">
                                                <div class="form-group">
                                                    <label for="product_name">Product</label>
                                                    <input type="text" name="product_name"
                                                        value="<?= $prodItem['product_name']; ?>" id="product_name"
                                                        class="form-control" placeholder="Enter Product" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sub_product">Sub Product</label>
                                                    <input type="text" name="sub_product"
                                                        value="<?= $prodItem['sub_product']; ?>" id="sub_product"
                                                        class="form-control" placeholder="Enter Sub Product" <?= $class; ?>>
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="gsm">Gsm</label>
                                                        <input type="text" name="gsm" value="<?= $prodItem['gsm']; ?>" id="gsm"
                                                            class="form-control" placeholder="Gsm" <?= $class; ?>>
                                                    </div>
                                                </div>
 <div class="col-md-4">
                                        <div class="form-group">
                                            <label>BF</label>
                                            <input type="text" name="bf" class="form-control"
                                                value="<?php echo $prodItem['bf']; ?>" placeholder="BF">
                                        </div>
                                    </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="weight">Brightness</label>
                                                        <input type="text" name="weight" value="<?= $prodItem['weight']; ?>"
                                                            id="weight" class="form-control" placeholder="Brightness" <?= $class; ?>>
                                                    </div>
                                                </div>
                                            <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="shade">Shade</label>
                                                        <input type="text" name="shade" value="<?= $prodItem['shade']; ?>"
                                                            id="shade" class="form-control" placeholder="Shade" <?= $class; ?>>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="hsn_no">Hsn No.</label>
                                                        <input type="text" name="hsn_no" value="<?= $prodItem['hsn_no']; ?>"
                                                            id="hsn_no" class="form-control" placeholder="Hsn No." <?= $class; ?>>
                                                    </div>
                                                </div>
                                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Grain</label>
                                            <input type="text" name="grain" class="form-control"
                                                value="<?php echo $prodItem['grain']; ?>" placeholder="Grain">
                                        </div>
                                    </div>
<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sheet</label>
                                            <input type="text" name="sheet" class="form-control"
                                               value="<?php echo $prodItem['sheet']; ?>" placeholder="Sheet">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>W * L</label>
                                            <input type="text" name="w_l" class="form-control"
                                               value="<?php echo $prodItem['w_l']; ?>" placeholder="W * L">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No of Bundle</label>
                                            <input type="text" name="no_of_bundle" class="form-control"
                                                value="<?php echo $prodItem['no_of_bundle']; ?>" placeholder="No of Bundle">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No of Rim</label>
                                            <input type="text" name="no_of_rim" class="form-control"
                                                 value="<?php echo $prodItem['no_of_rim']; ?>" placeholder="No of Rim">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rim Weight</label>
                                            <input type="text" name="rim_weight" class="form-control"
                                               value="<?php echo $prodItem['rim_weight']; ?>" placeholder="Rim Weight">
                                        </div>
                                    </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="size">Size in inch</label>
                                                        <input type="text" name="size" value="<?= $prodItem['size']; ?>" id="size"
                                                            class="form-control" placeholder="Size" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="stock_in_kg">Stock in Kg</label>
                                                        <input type="text" name="stock_in_kg"
                                                            value="<?= $prodItem['stock_in_kg']; ?>" id="stock_in_kg"
                                                            class="form-control" placeholder="Stock in Kg" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="quantity_in_kg">Quantity in Kg</label>
                                                        <input type="text" name="quantity_in_kg"
                                                            value="<?= $prodItem['quantity_in_kg']; ?>" id="quantity_in_kg"
                                                            class="form-control" placeholder="Quantity in Kg" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="price_per_kg">Price in Kg</label>
                                                        <input type="text" name="price_per_kg"
                                                            value="<?= $prodItem['price_per_kg']; ?>" id="price_per_kg"
                                                            class="form-control" placeholder="Price per Kg" <?= $class; ?>>
                                                    </div>
                                                </div>
                                               
                                                <style>
                                                    #gmm>input {
                                                        border-radius: 4px;
                                                    }

                                                    #gmm>input::file-selector-button {
                                                        /* font-weight: bold; */
                                                        height: 35px;
                                                        color: #666666;
                                                        /* padding: 0.5em; */
                                                        border: thin solid grey;
                                                        border-radius: 3px;
                                                    }
                                                </style>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="gmm">
                                                        <label>Document</label>
                                                        <input type="file" name="image" class="border" style="width:100%">
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
                                                    <textarea name="other" id="other" class="form-control"
                                                        placeholder="Other"><?= $prodItem['other']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label class="text-white">x</label>
                                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                                        <button type="submit" name="product_update"
                                                            class="btn btn-primary btn-block float-right">Update</button>
                                                    <?php } else { ?>
                                                        <button type="submit" name="product_update_buyer"
                                                            class="btn btn-primary btn-block float-right">Update</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <?php
        } else {
            echo "No such products found.";
        }
    }
    ?>
</div>
<?php
include ("footer.php");
?>
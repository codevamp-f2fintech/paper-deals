<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%
        ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 style="font-size:32px">
                            Edit Stock
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="seller_id" value="<?= $_REQUEST['prod_id']; ?>">
                                <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $query = "SELECT * from product_new where id='$id'";
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                    <div class="row">

                                     


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category</label>

                                                <input type="text" name="sub_product" value="<?= $prodItem['category_id']; ?>" class="form-control" placeholder="Sub Product">
                                            </div>
                                        </div>
   <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input name="product_name" value="<?= $prodItem["product_name"]; ?>" class="form-control">



                                                </input>
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gsm</label>
                                                <input type="text" name="gsm" value="<?= $prodItem['gsm']; ?>" class="form-control"  placeholder="Gsm">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>BF</label>
                                                <input type="text" name="bf" value="<?= $prodItem['bf']; ?>" class="form-control" required placeholder="Weight">
                                            </div>
                                        </div>
                                             <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Brightness</label>
                                                <input type="text" name="weight" value="<?= $prodItem['weight']; ?>" class="form-control" required placeholder="Brightness">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shade</label>
                                                <input type="text" name="shade" value="<?= $prodItem['shade']; ?>" class="form-control"  placeholder="Shade">
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hsn No.</label>
                                                <input type="text" name="hsn_no" value="<?= $prodItem['hsn_no']; ?>" class="form-control" placeholder="Hsn No.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Grain</label>
                                                <input type="text" name="grain" value="<?= $prodItem['grain']; ?>" class="form-control" required placeholder="Price Per Kg">
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sheet</label>
                                                <input type="text" name="sheet" value="<?= $prodItem['sheet']; ?>" class="form-control" required placeholder="Quantity in Kg">
                                            </div>
                                        </div>
                                           <div class="col-md-4">
                                            <div class="form-group">
                                                <label>W * L</label>
                                                <input type="text" name="w_l" value="<?= $prodItem['w_l']; ?>" class="form-control" required placeholder="Stock in Kg">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No of Bundle</label>
                                                <input type="text" name="no_of_bundle" value="<?= $prodItem['no_of_bundle']; ?>" class="form-control" required placeholder="Price Per Kg">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No of Rim</label>
                                                <input type="text" name="no_of_rim" value="<?= $prodItem['no_of_rim']; ?>" class="form-control" required placeholder="Stock in Kg">
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Rim Weight</label>
                                                <input type="text" name="rim_weight" value="<?= $prodItem['rim_weight']; ?>" class="form-control" required placeholder="Weight">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size in inch</label>
                                                <input type="text" name="size" value="<?= $prodItem['size']; ?>" class="form-control" required placeholder="Size">


                                            </div>
                                        </div>
                                   
                             
        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price in kg</label>
                                                <input type="text" name="price_per_kg" value="<?= $prodItem['price_per_kg']; ?>" class="form-control" required placeholder="Quantity in Kg">
                                            </div>
                                        </div>
                                         <div class="col-md-4">

                                         
                                            <div class="form-group">
                                                <label>Request</label>
                                                <input type="checkbox" name="request" value="1" class="form-control"  style="width:40px;" <?php if($prodItem['request']==1){ ?>checked <?php  } ?>>
                                                
                                            </div>
                                        </div>
                                        <style>
                                            #fmm>input {
                                                border-radius: 4px;
                                            }

                                            #fmm>input::file-selector-button {
                                                /* font-weight: bold; */
                                                height: 35px;
                                                color: #666666;
                                                /* padding: 0.5em; */
                                                border: thin solid grey;
                                                border-radius: 3px;
                                            }
                                        </style>
                                  
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Other</label>
                                                <textarea type="text" name="other" class="form-control" required placeholder="Other" style="height:38px"><?= $prodItem['other']; ?></textarea>
                                            </div>
                                        </div>
                                         <div class="col-md-4"></div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="text-white">x</label>
                                                <button type="submit" name="update_stock" class="btn btn-primary btn-block float-right">Update Stock</button>
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
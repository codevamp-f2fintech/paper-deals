<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from subscription_plan where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Edit Subscription Plan
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" >
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                            
                                            
                                            
                                              <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Name</label>

                                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $prodItem['name']; ?>">
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Price</label>

                                           <input type="text" name="price" placeholder="Enter Price" class="form-control" value="<?php echo $prodItem['price']; ?>">
                                        </div>
                                    </div>
                                        

                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" name="plan_update" class="btn btn-primary btn-block">Update</button>
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
</div>
<?php
include("footer.php");
?>